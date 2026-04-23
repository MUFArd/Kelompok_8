@extends('layouts.app')

@section('title', 'Pendaftaran')
@section('header-title', '📚 Pendaftaran Literasi Digital')
@section('header-subtitle', 'Silakan lengkapi formulir pendaftaran di bawah ini')

@section('styles')
<style>
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
        font-size: 14px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .radio-group {
        display: flex;
        gap: 30px;
        margin-top: 8px;
    }

    .radio-label {
        display: flex;
        align-items: center;
        font-weight: normal;
        cursor: pointer;
    }

    .radio-label input {
        width: auto;
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="nav-buttons">
    <a href="{{ route('pendaftaran.list') }}" class="btn btn-secondary">👥 Lihat Data Peserta</a>
</div>

<form action="{{ route('pendaftaran.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="nik">NIK (Nomor Induk Kependudukan) *</label>
        <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required maxlength="16" placeholder="16 digit angka">
    </div>

    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap *</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required placeholder="Masukkan nama lengkap">
    </div>

    <div class="form-group">
        <label>Jenis Kelamin *</label>
        <div class="radio-group">
            <label class="radio-label">
                <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required> Laki-laki
            </label>
            <label class="radio-label">
                <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required> Perempuan
            </label>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Kota kelahiran">
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="no_telepon">No. Telepon</label>
            <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="08xxxxxxxxxx">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="id_kelas">Kelas *</label>
            <select id="id_kelas" name="id_kelas" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ old('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                        Kelas {{ $k->nama_kelas }} ({{ $k->tingkat_kelas }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_jurusan">Jurusan *</label>
            <select id="id_jurusan" name="id_jurusan" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusan as $j)
                    <option value="{{ $j->id_jurusan }}" {{ old('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}>
                        {{ $j->nama_jurusan }} ({{ $j->kode_jurusan }})
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">
        📝 Daftar Sekarang
    </button>
</form>
@endsection