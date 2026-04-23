<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    // Tampilkan form pendaftaran
    public function index()
    {
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('pendaftaran.index', compact('jurusan', 'kelas'));
    }

    // Proses simpan pendaftaran
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:pendaftaran,nik',
            'nama_lengkap' => 'required|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|max:50',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'no_telepon' => 'nullable|max:15',
            'email' => 'nullable|email|max:100',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ], [
            'nik.required' => 'NIK wajib diisi',
            'nik.digits' => 'NIK harus 16 digit',
            'nik.unique' => 'NIK sudah terdaftar',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'id_kelas.required' => 'Kelas wajib dipilih',
            'id_jurusan.required' => 'Jurusan wajib dipilih',
        ]);

        Pendaftaran::create($validated);

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil! Data Anda telah tersimpan.');
    }

    // Tampilkan daftar peserta
    public function list()
    {
        $peserta = Pendaftaran::with(['jurusan', 'kelas'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pendaftaran.list', compact('peserta'));
    }

    // Update status kehadiran
    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status_kehadiran = $request->status_kehadiran;
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Status kehadiran berhasil diupdate');
    }
}