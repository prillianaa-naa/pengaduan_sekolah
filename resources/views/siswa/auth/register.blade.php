<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun - Pengaduan Sarana Sekolah</title>
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
        
        .register-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
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
            margin-bottom: 18px;
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
        
        .btn-register {
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
            margin-top: 8px;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(168, 123, 110, 0.4);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .login-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #6B5A4E;
        }
        
        .login-link a {
            color: #A87B6E;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .login-link a:hover {
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
        }
        
        .error-alert ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .error-alert li {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }
        
        .error-alert li:last-child {
            margin-bottom: 0;
        }
        
        .error-alert i {
            font-size: 16px;
        }
        
        .success-alert {
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
            border: 1px solid #6EE7B7;
            color: #065F46;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <!-- Logo -->
        <div class="logo-container">
            <div class="logo">
                <i class="fas fa-school"></i>
            </div>
            <h1 class="title">Create Account</h1>
            <p class="subtitle">Daftar akun pengaduan sekolah</p>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="error-alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="success-alert">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Register Form -->
        <form action="{{ route('siswa.register') }}" method="POST">
            @csrf
            
            <!-- Nama Field -->
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input 
                        type="text" 
                        name="nama" 
                        class="form-input" 
                        placeholder="Masukkan nama lengkap" 
                        required
                        value="{{ old('nama') }}"
                    >
                </div>
            </div>

            <!-- NIS Field -->
            <div class="form-group">
                <label class="form-label">NIS (Nomor Induk Siswa)</label>
                <div class="input-wrapper">
                    <i class="fas fa-id-card input-icon"></i>
                    <input 
                        type="text" 
                        name="nis" 
                        class="form-input" 
                        placeholder="Masukkan NIS" 
                        required
                        value="{{ old('nis') }}"
                    >
                </div>
            </div>

            <!-- Kelas Field -->
            <div class="form-group">
                <label class="form-label">Kelas</label>
                <div class="input-wrapper">
                    <i class="fas fa-chalkboard input-icon"></i>
                    <input 
                        type="text" 
                        name="kelas" 
                        class="form-input" 
                        placeholder="Contoh: X IPA 1" 
                        required
                        value="{{ old('kelas') }}"
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
                        placeholder="Minimal 6 karakter" 
                        required
                    >
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation"
                        class="form-input" 
                        placeholder="Ulangi password" 
                        required
                    >
                    <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn-register">
                Sign Up
            </button>
        </form>

        <!-- Login Link -->
        <div class="login-link">
            Sudah punya akun? <a href="{{ route('siswa.login') }}">Login di sini</a>
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

        // Toggle Confirm Password Visibility
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>