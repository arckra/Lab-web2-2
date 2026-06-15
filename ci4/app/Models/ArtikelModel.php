<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'isi', 'status', 'slug', 'gambar', 'id_kategori', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    
    // ============ METHOD BARU UNTUK PRAKTIKUM 6 ============
    
    // Method untuk mengambil artikel dengan nama kategori (untuk halaman public)
    public function getArtikelWithKategori()
    {
        return $this->db->table('artikel')
            ->select('artikel.*, kategori.nama_kategori, kategori.slug_kategori as kategori_slug')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
            ->orderBy('artikel.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
    
    // Method untuk admin dengan pagination dan filter kategori
    public function getArtikelAdminWithKategori($perPage = 10, $q = null, $kategori_id = null)
{
    // Mulai query dengan model (bukan builder)
    $this->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
    
    // Filter pencarian
    if ($q && $q != '') {
        $this->groupStart()
                ->like('artikel.judul', $q)
                ->orLike('artikel.isi', $q)
                ->groupEnd();
    }
    
    // Filter kategori
    if ($kategori_id && $kategori_id != '') {
        $this->where('artikel.id_kategori', $kategori_id);
    }
    
    // Urutkan dari terbaru
    $this->orderBy('artikel.created_at', 'DESC');
    
    // Paginate menggunakan model
    return [
        'artikel' => $this->paginate($perPage),
        'pager'   => $this->pager
    ];
}
    
    // Method untuk detail artikel dengan kategori
    public function getArtikelDetailWithKategori($slug)
    {
        return $this->db->table('artikel')
            ->select('artikel.*, kategori.nama_kategori, kategori.slug_kategori as kategori_slug')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
            ->where('artikel.slug', $slug)
            ->get()
            ->getRowArray();
    }
}