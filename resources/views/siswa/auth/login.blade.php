<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - Pengaduan Sarana Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #E8DDD5 0%, #D4C4B7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 32px rgba(139, 111, 94, 0.15);
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 24px;
        }
        
        .logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
        }
        
        .logo i {
            font-size: 32px;
            color: white;
        }
        
        .title {
            font-size: 26px;
            font-weight: 700;
            color: #5D4E45;
            margin-bottom: 8px;
        }
        
        .subtitle {
            font-size: 14px;
            color: #8B7355;
            text-align: center;
            margin-bottom: 32px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #5D4E45;
            margin-bottom: 8px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #A87B6E;
            font-size: 16px;
        }
        
        .form-input {
            width: 100%;
            padding: 13px 14px 13px 44px;
            border: 1.5px solid #E8DDD5;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s;
            background: #FAF7F5;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #A87B6E;
            background: white;
            box-shadow: 0 0 0 4px rgba(168, 123, 110, 0.1);
        }
        
        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #A87B6E;
            cursor: pointer;
            font-size: 16px;
            transition: color 0.3s;
        }
        
        .password-toggle:hover {
            color: #8B6F5E;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 13px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6B5A4E;
        }
        
        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #A87B6E;
            cursor: pointer;
        }
        
        .forgot-link {
            color: #A87B6E;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .forgot-link:hover {
            color: #8B6F5E;
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #A87B6E 0%, #8B6F5E 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(168, 123, 110, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(168, 123, 110, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .register-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #6B5A4E;
        }
        
        .register-link a {
            color: #A87B6E;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .register-link a:hover {
            color: #8B6F5E;
            text-decoration: underline;
        }
        
        .error-alert {
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
            border: 1px solid #FCA5A5;
            color: #991B1B;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .error-alert i {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Logo -->
        <div class="logo-container">
            <div class="logo">
                <i class="fas fa-school"></i>
            </div>
            <h1 class="title">Login</h1>
            <p class="subtitle">Masuk ke pengaduan sarana sekolah</p>
        </div>

        <!-- Error Message -->
        @if($errors->any())
            <div class="error-alert">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('siswa.login') }}" method="POST">
            @csrf
            
            <!-- Username/NIS Field -->
            <div class="form-group">
                <label class="form-label">Username</label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input 
                        type="text" 
                        name="nis" 
                        class="form-input" 
                        placeholder="NIS atau Username" 
                        required
                        value="{{ old('nis') }}"
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
                    >
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>
                <a href="#" class="forgot-link">Lupa password?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

        <!-- Register Link -->
        <div class="register-link">
            Belum punya akun? <a href="{{ route('siswa.register') }}">Daftar sekarang</a>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>