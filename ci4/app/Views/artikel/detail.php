<?= $this->include('template/header'); ?>

<article class="entry">
    <div class="article-header">
        <h2 class="article-title"><?= $artikel['judul']; ?></h2>
        <div class="article-date">
            <?php if(isset($artikel['updated_at'])): ?>
                Diperbarui: <?= date('d/m/Y', strtotime($artikel['updated_at'])); ?>
            <?php elseif(isset($artikel['created_at'])): ?>
                Dipublikasi: <?= date('d/m/Y', strtotime($artikel['created_at'])); ?>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if($artikel['gambar']): ?>
        <img src="<?= base_url('/gambar/' . $artikel['gambar']);?>" alt="<?= $artikel['judul']; ?>">
    <?php endif; ?>
    
    <div class="content">
        <?= nl2br($artikel['isi']); ?>
    </div>
    
    <div class="navigation">
        <a href="<?= base_url('/artikel');?>">← Kembali ke daftar artikel</a>
    </div>
</article>

<?= $this->include('template/footer'); ?>