<?= $this->extend('template/admin_header') ?>

<?= $this->section('content') ?>

<style>
    /* ============ FORM TAMBAH ARTIKEL - BIRU & PUTIH ============ */
    .form-container {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .form-header h2 {
        color: #0b3b5f;
        font-size: 24px;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-header h2::before {
        content: "✏️";
        font-size: 24px;
    }
    
    .btn-back {
        background-color: #e2e8f0;
        color: #475569;
        padding: 8px 18px;
        border-radius: 40px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-back:hover {
        background-color: #cbd5e1;
        color: #0b3b5f;
        transform: translateY(-1px);
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1e293b;
        font-size: 14px;
    }
    
    .form-group label i {
        margin-right: 8px;
        color: #1a5a8b;
    }
    
    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.25s;
        outline: none;
        background-color: #fafcff;
        box-sizing: border-box;
    }
    
    .form-group input[type="text"]:focus,
    .form-group textarea:focus {
        border-color: #1a5a8b;
        box-shadow: 0 0 0 3px rgba(26, 90, 139, 0.1);
        background-color: white;
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 200px;
    }
    
    .required {
        color: #dc3545;
        margin-left: 4px;
    }
    
    small {
        display: block;
        margin-top: 6px;
        font-size: 12px;
        color: #64748b;
    }
    
    .form-actions {
        margin-top: 30px;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #1a5a8b, #0b3b5f);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.25s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 6px rgba(26, 90, 139, 0.2);
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(26, 90, 139, 0.3);
    }
    
    .btn-reset {
        background-color: #e2e8f0;
        color: #475569;
        border: none;
        padding: 12px 24px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-reset:hover {
        background-color: #cbd5e1;
        color: #0b3b5f;
        transform: translateY(-1px);
    }
    
    /* Alert */
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        border-left: 4px solid #dc3545;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        border-left: 4px solid #28a745;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .alert-error ul {
        margin: 0;
        padding-left: 20px;
    }
    
    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
            margin: 15px;
        }
        
        .form-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .btn-submit, .btn-reset {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2><?= $title; ?></h2>
        <a href="<?= base_url('/admin/artikel') ?>" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
    
    <!-- Pesan error dari validation -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert-error">
            <i class="fas fa-exclamation-triangle"></i>
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <!-- Pesan sukses -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    
    <form action="<?= base_url('/admin/artikel/add') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label><i class="fas fa-heading"></i> Judul Artikel <span class="required">*</span></label>
            <input type="text" name="judul" placeholder="Masukkan judul artikel..." value="<?= old('judul') ?>" required>
            <small>Judul akan otomatis dibuatkan slug (URL friendly)</small>
        </div>
        
        <div class="form-group">
            <label><i class="fas fa-align-left"></i> Isi Artikel <span class="required">*</span></label>
            <textarea name="isi" placeholder="Tulis isi artikel di sini..." required><?= old('isi') ?></textarea>
            <small>Anda bisa menulis konten panjang di sini.</small>
        </div>
        
        <div class="form-group">
            <label><i class="fas fa-image"></i> Gambar Artikel</label>
            <input type="file" name="gambar" accept="image/*">
            <small>Upload gambar dengan format JPG, PNG, atau JPEG (max 2MB)</small>
        </div>

        <div class="form-group">
            <label><i class="fas fa-folder-open"></i> Kategori <span class="required">*</span></label>
            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategoriModel->findAll() as $kategori): ?>
                    <option value="<?= $kategori['id_kategori'] ?>" <?= old('id_kategori') == $kategori['id_kategori'] ? 'selected' : '' ?>>
                        <?= $kategori['nama_kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small>Pilih kategori yang sesuai untuk artikel ini.</small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Kirim Artikel
            </button>
            <button type="reset" class="btn-reset">
                <i class="fas fa-undo-alt"></i> Reset
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>