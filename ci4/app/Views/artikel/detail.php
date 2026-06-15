<?= $this->include('template/header'); ?>

<article class="entry">
    <div class="article-header">
        <h2 class="article-title"><?= $artikel['judul']; ?></h2>

        <div class="article-meta">
            <span class="category">📁 Kategori: <?= $artikel['nama_kategori'] ?? 'Tanpa Kategori' ?></span>
            <span class="date">
                Dipublikasi: <?= date('d/m/Y', strtotime($artikel['created_at'])); ?>
            </span>
        </div>
        <div class="article-date">
            <?php if(isset($artikel['updated_at'])): ?>
                Diperbarui: <?= date('d/m/Y', strtotime($artikel['updated_at'])); ?>
            <?php elseif(isset($artikel['created_at'])): ?>
                Dipublikasi: <?= date('d/m/Y', strtotime($artikel['created_at'])); ?>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if($artikel['gambar']): ?>
        <img src="<?= base_url('/gambar/' . $artikel['gambar']); ?>" alt="<?= $artikel['judul']; ?>"style="width: 100%; max-width: 450px; height: auto; border-radius: 12px;">
    <?php endif; ?>
    
    <div class="content">
        <?= nl2br($artikel['isi']); ?>
    </div>
    
    <div class="navigation">
        <a href="<?= base_url('/artikel');?>">← Kembali ke daftar artikel</a>
    </div>
</article>

<?= $this->include('template/footer'); ?>