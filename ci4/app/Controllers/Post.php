<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    protected $format = 'json';

    // GET /post
    public function index()
    {
        $model = new ArtikelModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond([
            'status' => true,
            'data' => $data
        ]);
    }

    // GET /post/5
    public function show($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }
        return $this->respond([
            'status' => true,
            'data' => $data
        ]);
    }

    // POST /post
    public function create()
    {
        $model = new ArtikelModel();
        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi'   => $this->request->getVar('isi')
        ];
        $model->insert($data);
        return $this->respondCreated([
            'status'  => true,
            'message' => 'Data artikel berhasil ditambahkan'
        ]);
    }

    // PUT /post/5
    // PUT /post/5
    public function update($id = null)
    {
        $model = new ArtikelModel();
        $artikel = $model->find($id);
    
        if (!$artikel) {
            return $this->failNotFound('Data tidak ditemukan');
        }
    
        $data = [
            'judul'  => $this->request->getVar('judul')  ?? $artikel['judul'],
            'isi'    => $this->request->getVar('isi')    ?? $artikel['isi'],
            'status' => $this->request->getVar('status') ?? $artikel['status']
        ];
    
        $model->update($id, $data);
    
        return $this->respond([
            'status'  => true,
            'message' => 'Data berhasil diupdate'
        ]);
    }

    // DELETE /post/5
    public function delete($id = null)
    {
        $model = new ArtikelModel();
        $artikel = $model->find($id);

        if (!$artikel) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $model->delete($id);
        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}