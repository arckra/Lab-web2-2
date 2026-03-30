<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
        }

        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-login {
            border-radius: 10px;
            background: #667eea;
            border: none;
        }

        .btn-login:hover {
            background: #5a67d8;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card login-card p-4" style="width: 400px;">
        
        <h3 class="text-center mb-4">🔐 Login</h3>

        <?php if(session()->getFlashdata('flash_msg')): ?>
            <div class="alert alert-danger text-center">
                <?= session()->getFlashdata('flash_msg') ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" 
                       class="form-control" 
                       placeholder="Masukkan email..."
                       value="<?= set_value('email') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" 
                       class="form-control" 
                       placeholder="Masukkan password..." required>
            </div>

            <button type="submit" class="btn btn-login w-100 text-white">
                Login
            </button>
        </form>

        <p class="text-center mt-3 text-muted" style="font-size: 14px;">
            © <?= date('Y') ?> - Sistem Login
        </p>

    </div>
</div>

</body>
</html>