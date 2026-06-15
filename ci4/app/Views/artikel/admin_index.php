<?= $this->extend('template/admin_header.php') ?>

<?= $this->section('content') ?>

<style>
    /* Reset dan Full Width */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    #main, .container, .content-wrapper {
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100% !important;
        width: 100% !important;
    }
    
    .admin-content {
        padding: 0 20px;
    }
    
    /* Header Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .header-section h1 {
        color: #0b3b5f;
        font-size: 24px;
        font-weight: 600;
        margin: 0;
    }
    
    .user-info {
        background: linear-gradient(135deg, #0b3b5f, #1a5a8b);
        padding: 8px 20px;
        border-radius: 40px;
        color: white;
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 14px;
    }
    
    .user-info a {
        color: #ffc107;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 30px;
        background: rgba(255,255,255,0.1);
    }
    
    .user-info a:hover {
        background: #ffc107;
        color: #0b3b5f;
    }
    
    hr {
        border: none;
        height: 2px;
        background: linear-gradient(90deg, #1a5a8b, #ffc107, #e9ecef);
        margin: 15px 0 20px 0;
    }
    
    /* Tombol */
    .btn-add {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        text-decoration: none;
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40,167,69,0.3);
    }
    
    /* Filter Section */
    .filter-section {
        background: #f8fafc;
        padding: 15px 20px;
        border-radius: 60px;
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
    }
    
    .filter-form {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .filter-group {
        flex: 1;
        min-width: 200px;
    }
    
    .filter-group input, .filter-group select {
        width: 100%;
        padding: 12px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 40px;
        font-size: 14px;
        outline: none;
        background: white;
    }
    
    .filter-group input:focus, .filter-group select:focus {
        border-color: #1a5a8b;
    }
    
    .btn-search {
        background: #1a5a8b;
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 40px;
        font-weight: bold;
        cursor: pointer;
    }
    
    .btn-search:hover {
        background: #0e4164;
    }
    
    /* Loading */
    .loading-spinner {
        text-align: center;
        padding: 40px;
        display: none;
    }
    
    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #1a5a8b;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* TABEL FULL WIDTH */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }
    
    table th {
        background: linear-gradient(135deg, #0b3b5f, #1a5a8b);
        color: white;
        padding: 14px 16px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
    }
    
    table td {
        padding: 14px 16px;
        border-bottom: 1px solid #edf2f7;
        vertical-align: middle;
        font-size: 14px;
    }
    
    table tr:hover {
        background: #f8fafc;
    }
    
    /* Thumbnail gambar */
    .thumbnail {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .no-image {
        color: #94a3b8;
        font-size: 12px;
    }
    
    /* Status badge */
    .badge-published {
        background: #d4edda;
        color: #155724;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    
    .badge-draft {
        background: #fff3cd;
        color: #856404;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    
    /* Kategori badge */
    .kategori-badge {
        background: #e2e8f0;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
    }
    
    /* Tombol aksi */
    .btn-edit {
        background: #ffc107;
        color: #2d2a1e;
        padding: 6px 14px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-right: 5px;
    }
    
    .btn-edit:hover {
        background: #e0a800;
    }
    
    .btn-delete {
        background: #dc3545;
        color: white;
        padding: 6px 14px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        border: none;
    }
    
    .btn-delete:hover {
        background: #c82333;
    }
    
    /* Pagination */
    .pagination-container {
        margin-top: 30px;
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .pagination-container a, .pagination-container span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        padding: 0 12px;
        background: white;
        color: #1a5a8b;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        cursor: pointer;
    }
    
    .pagination-container a:hover {
        background: #1a5a8b;
        color: white;
        border-color: #1a5a8b;
    }
    
    .pagination-container .active {
        background: linear-gradient(135deg, #0b3b5f, #1a5a8b);
        color: white;
        border-color: #1a5a8b;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .admin-content {
            padding: 0 15px;
        }
        
        .filter-form {
            flex-direction: column;
        }
        
        .filter-group {
            width: 100%;
        }
        
        .btn-search {
            width: 100%;
        }
        
        table, thead, tbody, th, td, tr {
            display: block;
        }
        
        table th {
            display: none;
        }
        
        table tr {
            margin-bottom: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 10px;
        }
        
        table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: none;
            padding: 8px 10px;
        }
        
        table td::before {
            content: attr(data-label);
            font-weight: bold;
            width: 100px;
            color: #0b3b5f;
        }
    }
</style>

<div class="admin-content">
    <!-- Header -->
    <div class="header-section">
        <h1><?= $title ?></h1>
        <div class="user-info">
            <span><i class="fas fa-user-circle"></i> Halo, <?= session()->get('user_name'); ?></span>
            <a href="<?= base_url('/user/logout'); ?>" onclick="return confirm('Yakin ingin logout?')">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
    
    <hr>
    
    <!-- Tombol Tambah -->
    <a href="<?= base_url('/admin/artikel/add'); ?>" class="btn-add">
        <i class="fas fa-plus-circle"></i> Tambah Artikel Baru
    </a>
    
    <!-- Filter -->
    <div class="filter-section">
        <div class="filter-form">
            <div class="filter-group">
                <input type="text" id="search-box" placeholder="🔍 Cari judul atau isi artikel...">
            </div>
            <div class="filter-group">
                <select id="category-filter">
                    <option value="">📁 Semua Kategori</option>
                    <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button id="search-btn" class="btn-search">🔍 Cari Sekarang</button>
            </div>
        </div>
    </div>
    
    <!-- Loading -->
    <div id="loading" class="loading-spinner">
        <div class="spinner"></div>
        <p>Memuat data...</p>
    </div>
    
    <!-- Container Tabel -->
    <div id="article-container"></div>
    
    <!-- Container Pagination -->
    <div id="pagination-container" class="pagination-container"></div>
</div>

<script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>

<script>
$(document).ready(function() {
    function fetchData(page = 1) {
        var q = $('#search-box').val();
        var kategori_id = $('#category-filter').val();
        
        $('#loading').show();
        $('#article-container').hide();
        $('#pagination-container').hide();
        
        $.ajax({
            url: '<?= base_url("/admin/artikel") ?>',
            type: 'GET',
            data: { q: q, kategori_id: kategori_id, page: page },
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                renderArticles(response.artikel);
                renderPagination(response.pager);
                $('#loading').hide();
                $('#article-container').show();
                $('#pagination-container').show();
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                $('#loading').hide();
                $('#article-container').html('<div style="text-align:center;padding:40px;">❌ Gagal memuat data</div>').show();
            }
        });
    }
    
    function renderArticles(artikel) {
        if (!artikel || artikel.length === 0) {
            $('#article-container').html(`
                <div style="text-align:center;padding:40px;background:white;border-radius:12px;">
                    <i class="fas fa-inbox" style="font-size:48px;color:#cbd5e0;"></i><br>
                    📭 Belum ada artikel atau hasil tidak ditemukan.
                </div>
            `);
            return;
        }
        
        var html = `<div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>`;
        
        for (var i = 0; i < artikel.length; i++) {
            var row = artikel[i];
            var statusHtml = (row.status == 1) 
                ? '<span class="badge-published">✅ Published</span>' 
                : '<span class="badge-draft">📝 Draft</span>';
            
            var gambarHtml = (row.gambar && row.gambar != '') 
                ? `<img src="<?= base_url('/gambar/') ?>${row.gambar}" class="thumbnail">`
                : '<span class="no-image">Tidak ada</span>';
            
            html += `
                <tr>
                    <td data-label="ID">${row.id}</td>
                    <td data-label="Judul"><strong>${escapeHtml(row.judul)}</strong></td>
                    <td data-label="Gambar">${gambarHtml}</td>
                    <td data-label="Kategori"><span class="kategori-badge">📁 ${escapeHtml(row.nama_kategori || 'Tanpa Kategori')}</span></td>
                    <td data-label="Slug"><small>${escapeHtml(row.slug)}</small></td>
                    <td data-label="Status">${statusHtml}</td>
                    <td data-label="Aksi">
                        <a href="<?= base_url('/admin/artikel/edit/') ?>${row.id}" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                        <button onclick="deleteArtikel(${row.id})" class="btn-delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                    </td>
                </tr>
            `;
        }
        
        html += `</tbody></table></div>`;
        $('#article-container').html(html);
    }
    
    function renderPagination(pager) {
        if (!pager || pager.total_pages <= 1) {
            $('#pagination-container').empty();
            return;
        }
        
        var currentPage = pager.current_page || 1;
        var totalPages = pager.total_pages || 1;
        var html = '';
        
        // Prev
        if (currentPage > 1) {
            html += `<a href="#" data-page="${currentPage - 1}">« Prev</a>`;
        } else {
            html += `<span class="disabled">« Prev</span>`;
        }
        
        // Numbers
        for (var i = 1; i <= totalPages; i++) {
            if (i == currentPage) {
                html += `<span class="active">${i}</span>`;
            } else {
                html += `<a href="#" data-page="${i}">${i}</a>`;
            }
        }
        
        // Next
        if (currentPage < totalPages) {
            html += `<a href="#" data-page="${currentPage + 1}">Next »</a>`;
        } else {
            html += `<span class="disabled">Next »</span>`;
        }
        
        $('#pagination-container').html(html);
        
        $('.pagination-container a').on('click', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            if (page) fetchData(page);
        });
    }
    
    window.deleteArtikel = function(id) {
        if (confirm('Yakin ingin menghapus artikel ini?')) {
            $.ajax({
                url: '<?= base_url("/admin/artikel/delete/") ?>' + id,
                type: 'GET',
                success: function() { fetchData(1); },
                error: function() { alert('Gagal menghapus'); }
            });
        }
    };
    
    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }
    
    $('#search-btn').on('click', function() { fetchData(1); });
    $('#search-box').on('keypress', function(e) { if (e.which === 13) fetchData(1); });
    $('#category-filter').on('change', function() { fetchData(1); });
    
    fetchData(1);
});
</script>

<?= $this->endSection() ?>