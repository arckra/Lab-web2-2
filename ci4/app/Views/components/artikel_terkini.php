<!-- app/Views/components/artikel_terkini.php -->
<h3>Artikel Terkini</h3>
<ul>
    <?php if (!empty($artikel)): ?>
        <?php foreach ($artikel as $row): ?>
            <li style="margin-bottom: 15px;">
                <a href="<?= base_url('/artikel/' . $row['slug']) ?>">
                    <strong><?= esc($row['judul']) ?></strong>
                </a>
                <br>
                <small style="color: #666;">
                    📅 <?= date('d/m/Y', strtotime($row['created_at'])) ?>
                </small>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Belum ada artikel</li>
    <?php endif; ?>
</ul>