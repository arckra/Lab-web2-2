<?= $this->include("template/header") ?>

<style>
    .loading {
        text-align: center;
        padding: 20px;
        background: #f0f0f0;
        border-radius: 8px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th {
        background: linear-gradient(135deg, #0b3b5f, #1a5a8b);
        color: white;
        padding: 12px;
        text-align: left;
    }

    table td {
        padding: 10px 12px;
        border-bottom: 1px solid #e2e8f0;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-edit {
        background: #ffc107;
        color: #333;
        border: none;
        padding: 5px 12px;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 5px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-add {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        margin-bottom: 20px;
    }

    .status {
        background: #d4edda;
        color: #155724;
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 12px;
    }
</style>

<h1><?= $title ?></h1>

<button class="btn-add" onclick="loadData()">🔄 Refresh Data</button>

<div class="table-responsive">
    <table id="artikelTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5" class="loading">Loading data...</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="<?= base_url("assets/js/jquery-4.0.0.min.js") ?>"></script>

<script>
// Fungsi untuk memuat data via AJAX
function loadData() {
    // Tampilkan loading
    $('#artikelTable tbody').html('<tr><td colspan="5" class="loading">Memuat data...</td></tr>');

    // Request AJAX ke server
    $.ajax({
        url: '<?= base_url("ajax/getData") ?>',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.length > 0) {
                var rows = '';
                for (var i = 0; i < data.length; i++) {
                    var row = data[i];
                    rows += '<tr>';
                    rows += '<td>' + row.id + '</td>';
                    rows += '<td><strong>' + escapeHtml(row.judul) + '</strong><br><small>' +
                            (row.isi ? row.isi.substring(0, 100) : '') + '...</small></td>';
                    rows += '<td>📁 ' + (row.nama_kategori || 'Tanpa Kategori') + '</td>';
                    rows += '<td><span class="status">' + (row.status == 1 ? '✅ Publish' : '📝 Draft') + '</span></td>';
                    rows += '<td>';
                    rows += '<a href="<?= base_url(
                        "admin/artikel/edit/",
                    ) ?>' + row.id + '" class="btn-edit">✏️ Edit</a>';
                    rows += '<button class="btn-delete" onclick="deleteData(' + row.id + ')">🗑️ Hapus</button>';
                    rows += '</td>';
                    rows += '</tr>';
                }
                $('#artikelTable tbody').html(rows);
            } else {
                $('#artikelTable tbody').html('<tr><td colspan="5" class="loading">Tidak ada data</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            $('#artikelTable tbody').html('<tr><td colspan="5" class="loading">Gagal memuat data</td></tr>');
        }
    });
}

// Fungsi untuk menghapus data via AJAX
function deleteData(id) {
    if (confirm('Yakin ingin menghapus artikel ini?')) {
        $.ajax({
            url: '<?= base_url("ajax/delete/") ?>' + id,
            method: 'DELETE',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    loadData(); // Refresh tabel
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Gagal menghapus data');
            }
        });
    }
}

// Fungsi untuk menghindari XSS
function escapeHtml(text) {
    if (!text) return '';
    return text
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

// Load data saat halaman dibuka
$(document).ready(function() {
    loadData();
});
</script>

<?= $this->include("template/footer") ?>
