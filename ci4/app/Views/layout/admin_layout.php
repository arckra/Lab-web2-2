<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin Panel' ?> - My Website</title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
    <style>
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
        
        header {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        nav {
            background: #444;
            padding: 10px;
            text-align: center;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
        }
        
        nav a:hover {
            background: #555;
        }
        
        #wrapper {
            display: flex;
            min-height: 500px;
        }
        
        #main {
            flex: 1;
            padding: 20px;
        }
        
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 15px;
            clear: both;
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
    </style>
</head>
<body>
    <div id="container">
        <header>
            <h1>Admin Panel</h1>
        </header>
        <nav>
            <a href="<?= base_url('/');?>">Home</a>
            <a href="<?= base_url('/admin/artikel');?>">Dashboard</a>
            <a href="<?= base_url('/artikel');?>">Artikel</a>
            <a href="<?= base_url('/user/logout');?>" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </nav>
        <section id="wrapper">
            <section id="main">
                <?= $this->renderSection('content') ?>
            </section>
        </section>
        <footer>
            <p>&copy; 2024 - Universitas Pelita Bangsa</p>
        </footer>
    </div>
</body>
</html>