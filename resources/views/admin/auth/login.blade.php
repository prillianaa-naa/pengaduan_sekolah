<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- ✅ Viewport optimized untuk mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#A87B6E">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Login Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* ===== DESAIN ASLI (TIDAK DIUBAH) ===== */
        body {
            background: linear-gradient(135deg, #d4c4b7 0%, #c9b8ac 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }
        .logo-container { text-align: center; margin-bottom: 24px; }
        .logo {
            width: 100px; height: 100px; margin: 0 auto 16px;
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .logo i { font-size: 40px; color: white; }
        .title { font-size: 24px; font-weight: 700; color: #1f2937; margin-bottom: 8px; }
        .subtitle { font-size: 14px; color: #6b7280; text-align: center; margin-bottom: 32px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px; }
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%); color: #9ca3af; font-size: 16px;
        }
        .form-input {
            width: 100%; padding: 12px 12px 12px 40px;
            border: 1px solid #d1d5db; border-radius: 8px;
            font-size: 14px; transition: all 0.3s;
        }
        .form-input:focus {
            outline: none; border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        .password-toggle {
            position: absolute; right: 12px; top: 50%;
            transform: translateY(-50%); color: #9ca3af;
            cursor: pointer; font-size: 16px;
        }
        .password-toggle:hover { color: #6b7280; }
        .remember-me { display: flex; align-items: center; margin-bottom: 24px; }
        .remember-me input[type="checkbox"] {
            width: 16px; height: 16px; margin-right: 8px; accent-color: #92400e;
        }
        .remember-me label { font-size: 14px; color: #374151; cursor: pointer; }
        .btn-login {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #a87b6e 0%, #92400e 100%);
            color: white; border: none; border-radius: 25px;
            font-size: 16px; font-weight: 600; cursor: pointer;
            transition: all 0.3s; box-shadow: 0 4px 12px rgba(146, 64, 14, 0.3);
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(146, 64, 14, 0.4); }
        .btn-login:active { transform: translateY(0); }
        .error-alert {
            background: #fee2e2; border: 1px solid #fecaca;
            color: #991b1b; padding: 12px 16px;
            border-radius: 8px; margin-bottom: 24px; font-size: 14px;
        }

        /* ===== 📱 MOBILE RESPONSIVE (TAMBAHAN) ===== */
        /* TIDAK MENGUBAH DESAIN, HANYA MENYESUAIKAN UKURAN */
        
        @media (max-width: 480px) {
            /* Body: padding lebih kecil, align ke atas */
            body {
                padding: 0.75rem;
                align-items: flex-start;
                padding-top: 1.5rem;
            }
            
            /* Card: padding mengecil, radius tetap */
            .login-card {
                padding: 32px 24px;
                border-radius: 16px; /* Tetap sama */
                max-width: 100%;
            }
            
            /* Logo: sedikit lebih kecil */
            .logo {
                width: 80px;
                height: 80px;
                margin-bottom: 12px;
            }
            
            /* Typography: scale down sedikit */
            .title { font-size: 22px; }
            .subtitle { font-size: 13px; margin-bottom: 24px; }
            
            /* Form: font 16px untuk hindari auto-zoom iOS */
            .form-input {
                padding: 12px 12px 12px 36px;
                font-size: 16px; /* ✅ Mencegah zoom otomatis di iOS */
            }
            
            /* Icon: adjust position */
            .input-icon { left: 10px; font-size: 14px; }
            .password-toggle { right: 10px; min-width: 44px; min-height: 44px; }
            
            /* Button: touch target minimal 44px */
            .btn-login {
                padding: 14px;
                font-size: 16px;
                border-radius: 24px;
                min-height: 48px; /* ✅ Mudah ditekan di HP */
            }
            
            /* Spacing: lebih rapat di mobile */
            .form-group { margin-bottom: 16px; }
            .remember-me { margin-bottom: 20px; }
            .error-alert {
                padding: 10px 14px;
                font-size: 13px;
                margin-bottom: 20px;
            }
        }
        
        /* ✅ Dark mode support (opsional) */
        @media (prefers-color-scheme: dark) {
            body { background: linear-gradient(135deg, #2d2420 0%, #3d342c 100%); }
            .login-card { background: #1f2937; box-shadow: 0 8px 32px rgba(0,0,0,0.3); }
            .title { color: white; }
            .subtitle, .form-label, .remember-me label { color: #9ca3af; }
            .form-input { background: #374151; border-color: #4b5563; color: white; }
            .form-input:focus { background: #1f2937; border-color: #f59e0b; }
            .error-alert { background: #7f1d1d; border-color: #991b1b; color: #fecaca; }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Logo -->
        <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('images/lg_musaba.png') }}" alt="Logo" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            <h1 class="title">Login Admin</h1>
            <p class="subtitle">Masuk ke panel administrasi</p>
        </div>

        <!-- Error Message -->
        @if($errors->any())
            <div class="error-alert">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            
            <!-- Email Field -->
            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="Email" 
                        required
                        value="{{ old('email') }}"
                        autocomplete="email"
                    >
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="form-input" 
                        placeholder="Password" 
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="password-toggle" id="togglePassword" aria-label="Toggle password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

    <script>
        // Toggle Password Visibility (lebih robust)
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            }
            
            // Auto-focus email on load (mobile friendly)
            const emailInput = document.querySelector('input[name="email"]');
            if (emailInput && !emailInput.value) {
                setTimeout(() => emailInput.focus(), 300);
            }
            
            // Loading state on submit
            const form = document.querySelector('form');
            const btn = document.querySelector('.btn-login');
            if (form && btn) {
                form.addEventListener('submit', function() {
                    btn.disabled = true;
                    const original = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                    setTimeout(() => { if (btn.disabled) { btn.disabled = false; btn.innerHTML = original; } }, 3000);
                });
            }
        });
    </script>
</body>
</html>