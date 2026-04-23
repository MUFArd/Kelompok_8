@extends('layouts.app')

@section('title', 'Data Peserta')
@section('header-title', '👥 Data Peserta Literasi Digital')
@section('header-subtitle', 'Daftar peserta yang telah mendaftar')

@section('styles')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
    }

    tr:hover {
        background: #f8f9fa;
    }

    .badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-terdaftar { background: #cce5ff; color: #004085; }
    .badge-hadir { background: #d4edda; color: #155724; }
    .badge-tidak-hadir { background: #f8d7da; color: #721c24; }
    .badge-selesai { background: #d1ecf1; color: #0c5460; }

    .btn-small {
        padding: 6px 12px;
        font-size: 13px;
    }

    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }
        th, td {
            padding: 10px 8px;
        }
    }
</style>
@endsection

@section('content')
<div class="nav-buttons">
    <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">← Kembali ke Pendaftaran</a>
</div>

<div style="overflow-x: auto;">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peserta as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nik }}</td>
                <td>{{ $p->nama_lengkap }}</td>
                <td>{{ $p->jenis_kelamin }}</td>
                <td>{{ $p->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $p->jurusan->kode_jurusan ?? '-' }}</td>
                <td>{{ $p->no_telepon ?? '-' }}</td>
                <td>
                    @php
                        $badgeClass = [
                            'Terdaftar' => 'badge-terdaftar',
                            'Hadir' => 'badge-hadir',
                            'Tidak Hadir' => 'badge-tidak-hadir',
                            'Selesai' => 'badge-selesai'
                        ][$p->status_kehadiran] ?? 'badge-terdaftar';
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ $p->status_kehadiran }}</span>
                </td>
                <td>
                    <form action="{{ route('pendaftaran.updateStatus', $p->id_pendaftaran) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <select name="status_kehadiran" onchange="this.form.submit()" class="btn btn-small">
                            <option value="Terdaftar" {{ $p->status_kehadiran == 'Terdaftar' ? 'selected' : '' }}>Terdaftar</option>
                            <option value="Hadir" {{ $p->status_kehadiran == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Tidak Hadir" {{ $p->status_kehadiran == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                            <option value="Selesai" {{ $p->status_kehadiran == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; padding: 40px; color: #999;">
                    Belum ada peserta yang terdaftar
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection