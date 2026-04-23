<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>BelajarLaravel</title>
</head>

<body class="container d-flex justify-content-center align-items-center vh-100 bg-primary-subtle ">
    <div class="row w-100">
        <div class="col-12 col-md-6 mx-auto">
            <div class="add-data bg-white rounded shadow-lg p-4">
                <h3 class="text-center text-primary">Tambah Data Siswa</h3>
                <form action="" method="post" class="row g-3">
                    <div class="input-wrapper col-12">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="number" class="form-control" id="nis" name="nis" maxlength="9" required>
                    </div>
                    <div class="input-wrapper col-12">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="input-wrapper col-12">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            <option value="" disabled selected hidden>Pilih Kelas</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                    <div class="input-wrapper col-12">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select name="jurusan" class="form-select" required>
                            <option value="" disabled selected hidden>Pilih Jurusan</option>
                            <option value="RPL">RPL</option>
                            <option value="BIDI">BIDI</option>
                            <option value="DKV">DKV</option>
                            <option value="TKJ">TKJ</option>
                        </select>
                    </div>
                    <div class="input-wrapper col-12">
                        <label for="nomer" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="nomer" name="nomer" maxlength="15" required>
                    </div>
                    <div class="btn-wrapper d-flex gap-2">
                        <button class="w-100 mt-4 bg-primary py-2 text-white fw-bold border-0 rounded"
                            type="submit">Submit</button>
                        <button class="px-3 mt-4 bg-danger py-2 text-white fw-bold border-0 rounded"
                            type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>