    const levelselected = document.getElementById('level')
    const kelasselected = document.getElementById('kelas')
    const jurusanselected = document.getElementById('jurusan')
    const jurusanInput = document.querySelector('select[name="jurusan"]');
    const kelasInput = document.querySelector('select[name="kelas"]');

levelselected.addEventListener('change', function () {
    const levelvalue = levelselected.value;

    if (levelvalue === 'walikelas') {
        kelasselected.style.height = '5vh';
        kelasselected.style.display = 'block';
        kelasselected.style.opacity = '1';
        jurusanselected.style.height = '5vh';
        jurusanselected.style.display = 'block';
        jurusanselected.style.opacity = '1';
        jurusanInput.setAttribute('required', 'required');
        kelasInput.setAttribute('required', 'required');
    }else if (levelvalue === 'kabid') {
        jurusanselected.style.height = '5vh';
        jurusanselected.style.display = 'block';
        jurusanselected.style.opacity = '1';
        kelasselected.style.height = '0';
        kelasselected.style.display = 'none';
        kelasselected.style.opacity = '0';
        jurusanInput.setAttribute('required', 'required');
        kelasInput.removeAttribute('required');
    }
    else {
        kelasselected.style.height = '0';
        kelasselected.style.display = 'none';
        kelasselected.style.opacity = '0';
        jurusanselected.style.height = '0';
        jurusanselected.style.display = 'none';
        jurusanselected.style.opacity = '0';
        jurusanInput.removeAttribute('required');
        kelasInput.removeAttribute('required');
    }
});