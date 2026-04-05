@extends('siswa.layouts.auth')

@section('title', 'Registrasi Siswa - Pengaduan Sarana Sekolah')

@section('card-class', 'register')
@section('page-title', 'Registrasi Siswa')
@section('page-subtitle', 'Buat akun pengaduan sarana sekolah')

@section('content')
    @if($errors->any())
        <div class="error-alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.register') }}" method="POST">
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
            <label class="form-label">Nama Lengkap</label>
            <div class="input-wrapper">
                <i class="fas fa-user input-icon"></i>
                <input type="text" name="nama" class="form-input" 
                       placeholder="Masukkan nama lengkap" required
                       value="{{ old('nama') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Kelas</label>
            <div class="input-wrapper">
                <i class="fas fa-chalkboard input-icon"></i>
                <input type="text" name="kelas" class="form-input" 
                       placeholder="Contoh: X IPA 1" required
                       value="{{ old('kelas') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" id="password" 
                       class="form-input" placeholder="Minimal 6 karakter" required
                       autocomplete="new-password">
                <button type="button" class="password-toggle" 
                        id="togglePwd" onclick="togglePassword('password', 'togglePwd')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <div class="input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password_confirmation" id="confirmPwd" 
                       class="form-input" placeholder="Ulangi password" required
                       autocomplete="new-password">
                <button type="button" class="password-toggle" 
                        id="toggleConfirm" onclick="togglePassword('confirmPwd', 'toggleConfirm')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-auth">Daftar</button>
    </form>
@endsection

@section('auth-footer')
    <div class="auth-links">
        <p>Sudah punya akun? <a href="{{ route('siswa.login') }}">Login di sini</a></p>
    </div>
@endsection