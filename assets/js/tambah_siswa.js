function nextForm() {
    document.getElementById("nama").value = document.getElementById("nama_input").value;
    document.getElementById("jenis_kelamin").value = document.getElementById("jenis_kelamin_input").value;
    document.getElementById("tanggal_lahir").value = document.getElementById("ttd_input").value;
    document.getElementById("nama_ibu").value = document.getElementById("nama_ibu_input").value;
    document.getElementById("nik").value = document.getElementById("nis_input").value;
    document.getElementById("nisn").value = document.getElementById("nisn_input").value;
    document.getElementById("kelas").value = document.getElementById("kelas_input").value; // pakai .value ✅
    document.getElementById("telepon").value = document.getElementById("telepon_input").value;

    document.getElementById('form1').classList.add('hidden');
    document.getElementById('form2').classList.remove('hidden');
}
