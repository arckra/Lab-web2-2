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
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        
        #container {
            width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        header {
            background-color: #1f5faa;
            color: white;
            padding: 20px;
        }
        
        header h1 {
            margin: 0;
            font-size: 28px;
        }
        
        nav {
            background-color: #e9ecef;
            border-bottom: 2px solid #1f5faa;
            padding: 10px 20px;
        }
        
        nav a {
            display: inline-block;
            padding: 8px 15px;
            margin-right: 5px;
            color: #333;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-radius: 3px;
        }
        
        nav a:hover, nav a.active {
            background-color: #1f5faa;
            color: white;
        }
        
        #main {
            padding: 20px;
            min-height: 400px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        
        table th {
            background-color: #1f5faa;
            color: white;
            padding: 12px;
            text-align: left;
        }
        
        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
        }
        
        .btn {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 13px;
            margin-right: 5px;
        }
        
        .btn-edit {
            background-color: #ffc107;
            color: #212529;
        }
        
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-add {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            margin-bottom: 15px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-active {
            background-color: #28a745;
            color: white;
        }
        
        .status-inactive {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<div id="container">
    <header>
        <h1>Admin Portal Berita</h1>
    </header>
    
    <nav>
        <a href="<?= base_url('artikel') ?>" class="<?= uri_string() == 'arikel' ? 'active' : '' ?>">Dashboard</a>
        <a href="<?= base_url('admin/artikel') ?>" class="<?= uri_string() == 'admin/artikel' ? 'active' : '' ?>">Artikel</a>
        <a href="<?= base_url('admin/artikel/add') ?>" class="<?= uri_string() == 'admin/artikel/add' ? 'active' : '' ?>">Tambah Artikel</a>
        <a href="<?= base_url('/') ?>" style="float: right;" target="_blank">Lihat Website</a>
    </nav>

    <div id="main">