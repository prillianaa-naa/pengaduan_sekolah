@extends('siswa.layouts.auth')

@section('title', 'Login Siswa - Pengaduan Sarana Sekolah')

@section('page-title', 'Login')
@section('page-subtitle', 'Masuk ke pengaduan sarana sekolah')

@section('content')
    @if($errors->any())
        <div class="error-alert">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form action="{{ route('siswa.login') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">NIS</label>
            <div class="input-wrapper">
                <i class="fas fa-id-card input-icon"></i>
                <input type="text" name="nis" class="form-input" 
                       placeholder="Masukkan NIS" required
                       value="{{ old('nis') }}" autocomplete="username">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" id="password" 
                       class="form-input" placeholder="Password" required
                       autocomplete="current-password">
                <button type="button" class="password-toggle" 
                        id="togglePwd" onclick="togglePassword('password', 'togglePwd')"
                        aria-label="Tampilkan password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember Me</label>
        </div>

        <button type="submit" class="btn-auth">Login</button>
    </form>
@endsection

@section('auth-footer')
    <div class="auth-links">
        <p>Belum punya akun? <a href="{{ route('siswa.register') }}">Daftar sekarang</a></p>
        <p><a href="{{ route('siswa.home') }}">Kembali ke Beranda</a></p>
    </div>
@endsection