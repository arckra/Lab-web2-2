<?php
namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    // ============ HALAMAN DEPAN (PUBLIC) ============
    public function index()
    {
        $title = "Daftar Artikel";
        $model = new ArtikelModel();

        // UBAH: Gunakan method getArtikelWithKategori()
        $artikel = $model->getArtikelWithKategori();

        return view("artikel/index", compact("artikel", "title"));
    }

    public function view($slug)
    {
        $model = new ArtikelModel();

        // Ambil artikel berdasarkan slug dengan join kategori
        $artikel = $model->getArtikelDetailWithKategori($slug);

        // Cek apakah artikel ditemukan
        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }

        $title = $artikel["judul"];

        // Kirim variabel artikel ke view
        return view("artikel/detail", [
            "artikel" => $artikel,
            "title" => $title,
        ]);
    }

    // ============ HALAMAN ADMIN ============
    public function admin_index()
    {
        $title = 'Daftar Artikel (Admin)';
        $model = new ArtikelModel();
        $kategoriModel = new KategoriModel();
        
        // Ambil parameter
        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        $page = $this->request->getVar('page') ?? 1;
        
        // Gunakan Model (bukan Query Builder) untuk pagination
        $model->select('artikel.*, kategori.nama_kategori')
              ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
        
        // Filter pencarian
        if ($q != '') {
            $model->groupStart()
                  ->like('artikel.judul', $q)
                  ->orLike('artikel.isi', $q)
                  ->groupEnd();
        }
        
        // Filter kategori
        if ($kategori_id != '') {
            $model->where('artikel.id_kategori', $kategori_id);
        }
        
        // Urutkan
        $model->orderBy('artikel.created_at', 'DESC');
        
        // Pagination (pakai model, bukan builder)
        $artikel = $model->paginate(5, 'default', $page);
        $pager = $model->pager;
        
        // Data untuk response
        $data = [
            'title'       => $title,
            'q'           => $q,
            'kategori_id' => $kategori_id,
            'artikel'     => $artikel,
            'pager'       => $pager
        ];
        
        // Jika AJAX request, return JSON
        if ($this->request->isAJAX()) {
            // Buat links pagination manual
            $currentPage = $pager->getCurrentPage();
            $totalPages = $pager->getPageCount();
            $links = [];
            
            for ($i = 1; $i <= $totalPages; $i++) {
                $links[] = [
                    'page'   => $i,
                    'active' => ($i == $currentPage),
                    'label'  => $i
                ];
            }
            
            return $this->response->setJSON([
                'artikel' => $artikel,
                'pager'   => [
                    'current_page' => $currentPage,
                    'total_pages'  => $totalPages,
                    'links'        => $links
                ]
            ]);
        }
        
        // Non-AJAX: tampilkan view biasa
        $data['kategori'] = $kategoriModel->findAll();
        return view('artikel/admin_index', $data);
    }

    // ============ TAMBAH ARTIKEL ============
    public function add()
    {
        $kategoriModel = new KategoriModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            "judul" => "required",
            "id_kategori" => "required|integer",
            "gambar" =>
                "uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png]",
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $artikel = new ArtikelModel();

            // Ambil file gambar
            $fileGambar = $this->request->getFile("gambar");

            // Generate nama file yang unik (opsional)
            $namaGambar = $fileGambar->getRandomName();

            // Pindahkan file ke folder public/gambar
            $fileGambar->move(ROOTPATH . "public/gambar", $namaGambar);

            $artikel->insert([
                "judul" => $this->request->getPost("judul"),
                "isi" => $this->request->getPost("isi"),
                "slug" => url_title(
                    $this->request->getPost("judul"),
                    "-",
                    true,
                ),
                "id_kategori" => $this->request->getPost("id_kategori"),
                "status" => 0, // Default draft
                "gambar" => $namaGambar, // Simpan nama file gambar
            ]);

            session()->setFlashdata("success", "Artikel berhasil ditambahkan!");
            return redirect()->to("/admin/artikel");
        }

        $title = "Tambah Artikel";
        return view("artikel/form_add", compact("title", "kategoriModel"));
    }

    // ============ EDIT ARTIKEL ============
    public function edit($id)
    {
        $artikelModel = new ArtikelModel();
        $kategoriModel = new KategoriModel(); // <-- TAMBAHKAN INI

        $data = $artikelModel->find($id);

        if (empty($data)) {
            session()->setFlashdata("error", "Artikel tidak ditemukan!");
            return redirect()->to("/admin/artikel");
        }

        $title = "Edit Artikel";
        // TAMBAHKAN: Kirim data kategori ke view
        return view(
            "artikel/form_edit",
            compact("title", "data", "kategoriModel"),
        );
    }

    public function update($id)
    {
        $artikelModel = new ArtikelModel();

        // Validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            "judul" => "required|min_length[3]",
            "isi" => "required|min_length[10]",
            "gambar" =>
                "is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png]",
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata("errors", $validation->getErrors());
            return redirect()->back()->withInput();
        }

        $data = [
            "judul" => $this->request->getPost("judul"),
            "isi" => $this->request->getPost("isi"),
            "slug" => url_title($this->request->getPost("judul"), "-", true),
        ];

        // Proses upload gambar baru jika ada
        $file = $this->request->getFile("gambar");
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus gambar lama
            $oldArtikel = $artikelModel->find($id);
            if (
                $oldArtikel["gambar"] &&
                file_exists(ROOTPATH . "public/gambar/" . $oldArtikel["gambar"])
            ) {
                unlink(ROOTPATH . "public/gambar/" . $oldArtikel["gambar"]);
            }

            // Generate nama unik dan upload gambar baru
            $namaGambar = $file->getRandomName();
            $file->move(ROOTPATH . "public/gambar", $namaGambar);
            $data["gambar"] = $namaGambar;
        }

        $artikelModel->update($id, $data);
        session()->setFlashdata("success", "Artikel berhasil diupdate!");

        return redirect()->to("/admin/artikel");
    }

    public function delete($id)
    {
        $artikelModel = new ArtikelModel();

        $artikel = $artikelModel->find($id);
        if (empty($artikel)) {
            session()->setFlashdata("error", "Artikel tidak ditemukan!");
            return redirect()->to("/admin/artikel");
        }

        // Hapus file gambar jika ada
        if (
            $artikel["gambar"] &&
            file_exists(ROOTPATH . "public/gambar/" . $artikel["gambar"])
        ) {
            unlink(ROOTPATH . "public/gambar/" . $artikel["gambar"]);
        }

        $artikelModel->delete($id);
        session()->setFlashdata("success", "Artikel berhasil dihapus!");

        return redirect()->to("/admin/artikel");
    }
}
