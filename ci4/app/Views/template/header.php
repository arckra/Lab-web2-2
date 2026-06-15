<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="container">
    <header>
        <h1>Layout Sederhana</h1>
    </header>
    <nav>
        <?php 
        // Ambil URI saat ini
        $current_uri = uri_string();
        
        // Definisikan menu
        $menus = [
            'Home' => ['url' => '/', 'segment' => ''],
            'Artikel' => ['url' => '/artikel', 'segment' => 'artikel'],
            'About' => ['url' => '/about', 'segment' => 'about'],
            'AJAX' => ['url' => '/ajax', 'segment' => 'ajax'],
            'Admin' => ['url' => '/admin/artikel', 'segment' => 'admin/artikel']
        ];
        ?>
        
        <?php foreach($menus as $name => $menu): ?>
            <?php 
            $is_active = false;
            if ($menu['segment'] === '' && $current_uri === '') {
                $is_active = true;
            } elseif ($menu['segment'] !== '' && strpos($current_uri, $menu['segment']) === 0) {
                $is_active = true;
            }
            ?>
            <a href="<?= base_url($menu['url']);?>" <?= $is_active ? 'class="active"' : ''; ?>>
                <?= $name; ?>
            </a>
        <?php endforeach; ?>
    </nav>
    <section id="wrapper">
        <section id="main">