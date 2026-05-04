<?= $this->include('template/header'); ?>

<?php if($artikel): foreach($artikel as $row): ?>
<article class="entry">
    <div class="article-header">
        <h2 class="article-title">
            <a href="<?= base_url('/artikel/' . $row['slug']);?>"><?= $row['judul']; ?></a>
        </h2>
        <div class="article-date">
            <?php if(isset($row['updated_at'])): ?>
                Diperbarui: <?= date('d/m/Y', strtotime($row['updated_at'])); ?>
            <?php elseif(isset($row['created_at'])): ?>
                Dipublikasi: <?= date('d/m/Y', strtotime($row['created_at'])); ?>
            <?php endif; ?>
        </div>
    </div>
    
    <img src="<?= base_url('/gambar/' . $row['gambar']);?>" alt="<?= $row['judul']; ?>">
    <p><?= substr(strip_tags($row['isi']), 0, 200); ?>...</p>
    <a href="<?= base_url('/artikel/' . $row['slug']);?>" class="read-more">Baca Selengkapnya →</a>
</article>
<hr class="divider" />
<?php endforeach; else: ?>
<article class="entry">
    <h2>Belum ada data.</h2>
</article>
<?php endif; ?>

<?= $this->include('template/footer'); ?>