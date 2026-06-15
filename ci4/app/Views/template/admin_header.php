<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Berita</title>
    
    <!-- Link ke file CSS utama -->
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }
        
        #container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
        }
        
        /* ============ HEADER (BIRU & PUTIH) ============ */
        header {
            background: linear-gradient(135deg, #0b3b5f 0%, #1a5a8b 100%);
            color: white;
            padding: 28px 32px;
            border-bottom: 4px solid #ffc107;
            position: relative;
        }
        
        header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        header h1::before {
            content: "📰";
            font-size: 32px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }
        
        header p {
            margin-top: 10px;
            opacity: 0.88;
            font-size: 14px;
            font-weight: 400;
        }
        
        /* Optional: efek garis bawah dekoratif */
        header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 80px;
            height: 4px;
            background-color: #ffc107;
            border-radius: 2px;
        }
        /* ============ AKHIR HEADER ============ */
        
        nav {
            background-color: #ffffff;
            border-bottom: 2px solid #e2e8f0;
            padding: 12px 28px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        nav a {
            display: inline-block;
            padding: 8px 18px;
            color: #1e4663;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-radius: 30px;
            transition: all 0.25s ease;
            background-color: #f1f5f9;
        }
        
        nav a:hover, nav a.active {
            background-color: #1a5a8b;
            color: white;
            box-shadow: 0 4px 8px rgba(26, 90, 139, 0.2);
            transform: translateY(-1px);
        }
        
        nav a[style*="float: right"] {
            margin-left: auto;
            background-color: #e9ecef;
        }
        
        #main {
            flex: 1;
            padding: 20px;
            min-height: 400px;
            background-color: #ffffff;
        }
        
                table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        
        table th {
            background: #f0f0f0;
        }
        
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 5px 0;
        }
        
        .btn-danger {
            background: #dc3545;
        }
        
        .btn-success {
            background: #28a745;
        }
        
        .alert {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .btn-add {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
            transition: all 0.25s;
        }
        
        .btn-add:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
        }
        
        .status-active {
            background-color: #d4edda;
            color: #155724;
            border-left: 3px solid #28a745;
        }
        
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 3px solid #dc3545;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            #container {
                width: 95%;
                margin: 15px auto;
            }
            header {
                padding: 20px;
            }
            header h1 {
                font-size: 22px;
            }
            nav {
                padding: 12px 20px;
            }
            nav a {
                padding: 6px 12px;
                font-size: 12px;
            }
            #main {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div id="container">
    <header>
        <h1>Admin Portal Berita</h1>
        <p>Kelola dan publikasikan berita dengan mudah</p>
    </header>
    
    <nav>
        <a href="<?= base_url('artikel') ?>" class="<?= uri_string() == 'artikel' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="<?= base_url('admin/artikel') ?>" class="<?= uri_string() == 'admin/artikel' ? 'active' : '' ?>"><i class="fas fa-newspaper"></i> Artikel</a>
        <a href="<?= base_url('admin/artikel/add') ?>" class="<?= uri_string() == 'admin/artikel/add' ? 'active' : '' ?>"><i class="fas fa-plus-circle"></i> Tambah Artikel</a>
        <a href="<?= base_url('/artikel') ?>" style="margin-left: auto;" target="_blank"><i class="fas fa-external-link-alt"></i> Lihat Website</a>
    </nav>

    <section id="wrapper">
        <section id="main">
            <?= $this->renderSection('content') ?>
        </section>
    </section>
</div>

</body>

    <footer>
        <p>&copy; 2026 - Universitas Pelita Bangsa</p>
    </footer>

</html>