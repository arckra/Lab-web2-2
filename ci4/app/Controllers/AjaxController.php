<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class AjaxController extends BaseController
{
    // Halaman utama AJAX
    public function index()
    {
        $title = "AJAX Data Artikel";
        return view("ajax/index", compact("title"));
    }

    // Mengambil data via AJAX (JSON response)
    public function getData()
    {
        $model = new ArtikelModel();

        // Ambil semua artikel dengan join kategori
        $artikel = $model
            ->select("artikel.*, kategori.nama_kategori")
            ->join(
                "kategori",
                "kategori.id_kategori = artikel.id_kategori",
                "left",
            )
            ->orderBy("artikel.created_at", "DESC")
            ->findAll();

        // Return response dalam format JSON
        return $this->response->setJSON($artikel);
    }

    // Hapus artikel via AJAX
    public function delete($id)
    {
        $model = new ArtikelModel();

        // Cek artikel
        $artikel = $model->find($id);
        if (!$artikel) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Artikel tidak ditemukan",
            ]);
        }

        // Hapus gambar jika ada
        if (
            $artikel["gambar"] &&
            file_exists(ROOTPATH . "public/gambar/" . $artikel["gambar"])
        ) {
            unlink(ROOTPATH . "public/gambar/" . $artikel["gambar"]);
        }

        // Hapus artikel
        $model->delete($id);

        return $this->response->setJSON([
            "status" => "success",
            "message" => "Artikel berhasil dihapus",
        ]);
    }

    // Tambah artikel via AJAX
    public function save()
    {
        $model = new ArtikelModel();

        $data = [
            "judul" => $this->request->getPost("judul"),
            "isi" => $this->request->getPost("isi"),
            "slug" => url_title($this->request->getPost("judul"), "-", true),
            "id_kategori" => $this->request->getPost("id_kategori"),
            "status" => 0,
        ];

        // Upload gambar jika ada
        $file = $this->request->getFile("gambar");
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaGambar = $file->getRandomName();
            $file->move(ROOTPATH . "public/gambar", $namaGambar);
            $data["gambar"] = $namaGambar;
        }

        if ($model->insert($data)) {
            return $this->response->setJSON([
                "status" => "success",
                "message" => "Artikel berhasil ditambahkan",
            ]);
        } else {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Gagal menambahkan artikel",
            ]);
        }
    }
}
