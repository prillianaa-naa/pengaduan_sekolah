<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#A87B6E">
    <title>@yield('title', 'Auth - Pengaduan Sarana Sekolah')</title>
    
    <!-- Tailwind & Font Awesome (sesuai desain asli) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* ===== BASE (Sesuai Desain Asli) ===== */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #d4c4b7 0%, #c9b8ac 100%);
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            margin: 0;
            -webkit-tap-highlight-color: transparent;
        }
        
        /* ===== CARD (Login & Register) ===== */
        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            animation: slideUp 0.4s ease;
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* ===== HEADER ===== */
        .logo-container { text-align: center; margin-bottom: 24px; }
        
        .logo {
            width: 100px; height: 100px;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        
        .logo img {
            width: 100%; height: 100%;
            object-fit: contain; padding: 8px;
        }
        
        .title {
            font-size: 24px; font-weight: 700;
            color: #1f2937; margin-bottom: 8px;
        }
        
        .subtitle {
            font-size: 14px; color: #6b7280;
            text-align: center; margin-bottom: 32px;
        }
        
        /* ===== FORM ===== */
        .form-group { margin-bottom: 20px; }
        
        .form-label {
            display: block; font-size: 14px; font-weight: 500;
            color: #374151; margin-bottom: 8px;
        }
        
        .input-wrapper { position: relative; }
        
        .input-icon {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%); color: #9ca3af;
            font-size: 16px; pointer-events: none;
        }
        
        .form-input {
            width: 100%; padding: 12px 12px 12px 40px;
            border: 1px solid #d1d5db; border-radius: 8px;
            font-size: 14px; transition: all 0.3s;
            background: #fff;
        }
        
        .form-input:focus {
            outline: none; border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        
        /* Password toggle */
        .password-toggle {
            position: absolute; right: 12px; top: 50%;
            transform: translateY(-50%); color: #9ca3af;
            cursor: pointer; font-size: 16px;
            background: none; border: none;
            padding: 4px; min-width: 32px; min-height: 32px;
            display: flex; align-items: center; justify-content: center;
        }
        .password-toggle:active { color: #6b7280; }
        
        /* Checkbox */
        .remember-me {
            display: flex; align-items: center;
            margin-bottom: 24px;
        }
        .remember-me input[type="checkbox"] {
            width: 16px; height: 16px;
            margin-right: 8px; accent-color: #92400e;
        }
        .remember-me label {
            font-size: 14px; color: #374151;
            cursor: pointer; user-select: none;
        }
        
        /* Button */
        .btn-auth {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #a87b6e 0%, #92400e 100%);
            color: white; border: none; border-radius: 25px;
            font-size: 16px; font-weight: 600;
            cursor: pointer; transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(146, 64, 14, 0.3);
            min-height: 48px;
        }
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(146, 64, 14, 0.4);
        }
        .btn-auth:active { transform: translateY(0); }
        .btn-auth:disabled { opacity: 0.7; cursor: not-allowed; }
        
        /* Alert */
        .error-alert {
            background: #fee2e2; border: 1px solid #fecaca;
            color: #991b1b; padding: 12px 16px;
            border-radius: 8px; margin-bottom: 24px;
            font-size: 14px;
        }
        .error-alert ul {
            list-style: none; padding: 0; margin: 0;
        }
        .error-alert li {
            display: flex; align-items: flex-start; gap: 8px;
        }
        .error-alert li + li { margin-top: 4px; }
        
        /* Links */
        .auth-links {
            text-align: center; margin-top: 24px;
        }
        .auth-links p {
            font-size: 14px; color: #64748B;
        }
        .auth-links a {
            color: #A87B6E; font-weight: 600;
            text-decoration: none;
        }
        .auth-links a:hover { text-decoration: underline; }
        .auth-links p + p { margin-top: 8px; }
        
        /* ===== MOBILE RESPONSIVE ===== */
        @media (max-width: 480px) {
            body {
                padding: 0.75rem;
                align-items: flex-start;
                padding-top: 1.5rem;
            }
            
            .auth-card {
                padding: 32px 24px;
                border-radius: 16px;
                max-width: 100%;
            }
            
            .logo {
                width: 80px; height: 80px;
                margin-bottom: 12px;
            }
            
            .title { font-size: 22px; }
            .subtitle { font-size: 13px; margin-bottom: 24px; }
            
            .form-input {
                padding: 12px 12px 12px 36px;
                font-size: 16px; /* Hindari auto-zoom iOS */
            }
            
            .input-icon { left: 10px; font-size: 14px; }
            .password-toggle { right: 10px; }
            
            .btn-auth {
                padding: 14px;
                font-size: 16px;
                border-radius: 24px;
            }
            
            .form-group { margin-bottom: 16px; }
            .remember-me { margin-bottom: 20px; }
            
            .error-alert {
                padding: 10px 14px;
                font-size: 13px;
                margin-bottom: 20px;
            }
        }
        
        /* ===== REGISTER SPECIFIC (Override) ===== */
        .auth-card.register {
            border-radius: 20px;
            padding: 48px 40px;
            max-width: 440px;
            box-shadow: 0 8px 32px rgba(139, 111, 94, 0.15);
        }
        
        .auth-card.register .title {
            font-size: 28px;
            text-align: center;
        }
        
        .auth-card.register .subtitle {
            margin-bottom: 32px;
        }
        
        .auth-card.register .form-input {
            border: 1.5px solid #E2E8F0;
            border-radius: 12px;
            background: #F8FAFC;
            padding: 12px 16px 12px 44px;
        }
        
        .auth-card.register .form-input:focus {
            border-color: #A87B6E;
            background: white;
            box-shadow: 0 0 0 4px rgba(168, 123, 110, 0.1);
        }
        
        .auth-card.register .input-icon {
            left: 16px; color: #94A3B8;
        }
        
        .auth-card.register .password-toggle {
            right: 16px; color: #94A3B8;
        }
        
        .auth-card.register .btn-auth {
            background: linear-gradient(135deg, #A87B6E 0%, #8B6F5E 100%);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(168, 123, 110, 0.3);
            margin-top: 8px;
        }
        
        .auth-card.register .btn-auth:hover {
            box-shadow: 0 6px 20px rgba(168, 123, 110, 0.4);
        }
        
        .auth-card.register .error-alert {
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
            border: 1px solid #FCA5A5;
            border-radius: 12px;
        }
        
        /* Register mobile */
        @media (max-width: 480px) {
            .auth-card.register {
                padding: 36px 20px;
                border-radius: 16px;
            }
            .auth-card.register .title { font-size: 24px; }
            .auth-card.register .form-input {
                padding: 12px 12px 12px 36px;
                font-size: 16px;
            }
            .auth-card.register .input-icon { left: 10px; }
            .auth-card.register .password-toggle { right: 10px; }
        }
        
        /* ===== DARK MODE (Optional) ===== */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #2d2420 0%, #3d342c 100%);
            }
            .auth-card {
                background: #1f2937;
                box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            }
            .title { color: white; }
            .subtitle, .form-label, .remember-me label, .auth-links p {
                color: #9ca3af;
            }
            .form-input {
                background: #374151;
                border-color: #4b5563;
                color: white;
            }
            .form-input:focus {
                background: #1f2937;
                border-color: #f59e0b;
            }
            .error-alert {
                background: #7f1d1d;
                border-color: #991b1b;
                color: #fecaca;
            }
        }
        
        /* ===== UTILITIES ===== */
        .sr-only {
            position: absolute; width: 1px; height: 1px;
            padding: 0; margin: -1px; overflow: hidden;
            clip: rect(0,0,0,0); border: 0;
        }
        .text-center { text-align: center; }
        .mt-6 { margin-top: 1.5rem; }
    </style>
    
    @stack('styles')
</head>
<body>
    <main class="auth-card @yield('card-class', '')" role="main">
        <!-- Header (bisa di-override) -->
        @section('auth-header')
        <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('images/lg_musaba.png') }}" alt="Logo" width="100" height="100">
            </div>
            <h1 class="title">@yield('page-title', 'Login')</h1>
            <p class="subtitle">@yield('page-subtitle', 'Masuk ke sistem')</p>
        </div>
        @show
        
        <!-- Content -->
        @yield('content')
        
        <!-- Footer Links (bisa di-override) -->
        @section('auth-footer')
        @show
    </main>
    
    <!-- Common Scripts -->
    <script>
        // Password toggle universal
        function togglePassword(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);
            const icon = toggle?.querySelector('i');
            
            if (input && toggle) {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon?.classList.replace('fa-eye', 'fa-eye-slash');
                    toggle.setAttribute('aria-label', 'Sembunyikan password');
                } else {
                    input.type = 'password';
                    icon?.classList.replace('fa-eye-slash', 'fa-eye');
                    toggle.setAttribute('aria-label', 'Tampilkan password');
                }
                input.focus();
            }
        }
        
        // Form loading state
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const btn = document.querySelector('.btn-auth');
            
            if (form && btn) {
                form.addEventListener('submit', function() {
                    btn.disabled = true;
                    const original = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                    
                    // Re-enable after 3s if page doesn't reload (error)
                    setTimeout(() => {
                        if (btn.disabled) {
                            btn.disabled = false;
                            btn.innerHTML = original;
                        }
                    }, 3000);
                });
            }
            
            // Auto-focus first input
            const firstInput = document.querySelector('.auth-card input:not([type="hidden"]):not([type="checkbox"])');
            if (firstInput && !firstInput.value) {
                setTimeout(() => firstInput.focus(), 300);
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>