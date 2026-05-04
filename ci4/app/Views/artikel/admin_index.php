<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1><?= $title ?></h1>
    <div>
        <span>Halo, <?= session()->get('user_name'); ?> | </span>
        <a href="<?= base_url('/user/logout'); ?>" onclick="return confirm('Yakin ingin logout?')">Logout</a>
    </div>
</div>
<hr>

<a href="<?= base_url('/admin/artikel/add'); ?>" style="margin-bottom: 20px; display: inline-block;">
    <button>Tambah Artikel Baru</button>
</a>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Slug</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($artikel as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= esc($row['judul']) ?></td>
            <td><?= esc($row['slug']) ?></td>
            <td><?= $row['status'] == 1 ? 'Published' : 'Draft' ?></td>
            <td>
                <a href="<?= base_url('/admin/artikel/edit/' . $row['id']) ?>">Edit</a> |
                <a href="<?= base_url('/admin/artikel/delete/' . $row['id']) ?>" 
                   onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>