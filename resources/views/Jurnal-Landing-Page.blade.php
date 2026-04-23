<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Ekskul Jurnalistik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">
    <header
        class="fixed top-0 left-0 w-full bg-blue-800/90 backdrop-blur-md text-white shadow-lg z-50 transition-all duration-500">
        <div class="container mx-auto flex items-center justify-between px-6 py-4">
            <h1 class="font-extrabold text-2xl tracking-wide hover:text-orange-300 transition duration-300">
                Jurnalistik
            </h1>
            <nav>
                <ul class="flex gap-6 font-medium">
                    <li>
                        <a href="#hero" class="hover:text-orange-400 transition">Beranda</a>
                    </li>
                    <li>
                        <a href="#tentangeskul" class="hover:text-orange-400 transition">Tentang Eskul</a>
                    </li>
                    <li>
                        <a href="#kegiatan" class="hover:text-orange-400 transition">Kegiatan</a>
                    </li>
                    <li>
                        <a href="#album" class="hover:text-orange-400 transition">Album</a>
                    </li>
                    <li>
                        <a href="#kontak" class="hover:text-orange-400 transition">Kontak</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-1 mt-24">
        <section id="hero" class="relative h-[85vh] overflow-hidden" data-aos="fade-up">
            <img src="/image/Jurnal10.jpg" alt="Hero Jurnalistik" class="w-full h-full object-cover brightness-90" />
            <div
                class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white px-4">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-4 drop-shadow-md animate-fadeInUp">
                    Ekskul Jurnalistik
                </h1>
                <p class="text-lg md:text-xl max-w-2xl leading-relaxed">
                    Mengasah kemampuan menulis, berpikir kritis, dan menyuarakan kebenaran
                    melalui karya jurnalistik siswa.
                </p>
                <a href="#tentangeskul"
                    class="mt-6 inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </section>

        <section id="tentangeskul" class="container mx-auto px-6 py-20">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-800" data-aos="fade-up">
                Tentang Kami
            </h2>

            <div class="grid md:grid-cols-2 gap-10 items-center mb-16" data-aos="fade-right">
                <img src="/image/idjurnal.png" alt="Tim Jurnalistik"
                    class="rounded-2xl shadow-lg w-full object-cover hover:scale-105 transition-transform duration-500" />
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Apa itu Ekskul Jurnalistik?</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Ekskul Jurnalistik adalah wadah bagi siswa untuk mengembangkan
                        kemampuan menulis, meliput berita, dan menyampaikan informasi yang
                        inspiratif. Kami belajar menjadi pewarta yang kritis, kreatif, dan
                        bertanggung jawab.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Tujuan utama kami adalah membangun literasi media di lingkungan
                        sekolah, menumbuhkan kepekaan terhadap isu sosial, dan mengasah
                        keterampilan komunikasi agar setiap anggota mampu menyuarakan
                        kebenaran dengan tulisan yang bermakna.
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-10 items-center mb-16" data-aos="fade-left">
                <div class="order-2 md:order-1">
                    <h3 class="text-2xl font-semibold mb-4">Pembina Kami</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Ekskul ini dibina oleh <strong>Bapak Komar</strong>, sosok yang
                        menjadi inspirasi sekaligus pendiri kegiatan Jurnalistik di sekolah
                        kami. Beliau tidak hanya membimbing, tetapi juga menanamkan nilai-nilai
                        integritas dan semangat berbagi pengetahuan kepada seluruh anggota.
                    </p>
                </div>
                <img src="/image/pakomar.jpg" alt="Pembina Jurnalistik"
                    class="rounded-2xl shadow-lg w-full object-cover hover:scale-105 transition-transform duration-500 order-1 md:order-2" />
            </div>

            <div class="grid md:grid-cols-2 gap-10 items-center" data-aos="fade-right">
                <img src="/image/Jurnal10.jpg" alt="Anggota Jurnalistik"
                    class="rounded-2xl shadow-lg w-full object-cover hover:scale-105 transition-transform duration-500" />
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Anggota Kami</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Kami terdiri dari siswa-siswi yang memiliki semangat tinggi untuk
                        menulis dan meliput berbagai kegiatan di sekolah. Dengan beragam latar
                        belakang dan gaya penulisan, kami bersama-sama menciptakan ruang
                        berekspresi untuk seluruh siswa melalui media sekolah.
                    </p>
                </div>
            </div>
        </section>

        <section id="kegiatan" class="bg-white py-20" data-aos="zoom-in-up">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12 text-blue-800">
                    Kegiatan Kami
                </h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <img src="/image/Jurnal10.jpg" alt="Kegiatan 1"
                        class="rounded-xl shadow-md hover:scale-105 transition-transform duration-500" />
                    <img src="/image/Jutnal11.jpg" alt="Kegiatan 2"
                        class="rounded-xl shadow-md hover:scale-105 transition-transform duration-500" />
                    <img src="/image/Jurnal12.jpg" alt="Kegiatan 3"
                        class="rounded-xl shadow-md hover:scale-105 transition-transform duration-500" />
                </div>
            </div>
        </section>

        <section id="album" class="bg-gray-100 py-20" data-aos="zoom-in-up">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12 text-blue-800">
                    Album
                </h2>
                <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-6">
                    <img src="/image/Jurnal10.jpg" alt="Album 1"
                        class="rounded-xl shadow-md hover:scale-105 transition-transform duration-500" />
                    <img src="/image/jurnal3.jpg" alt="Album 2"
                        class="rounded-xl shadow-md hover:scale-105 transition-transform duration-500" />
                    <img src="/image/Jutnal11.jpg" alt="Album 3"
                        class="rounded-xl shadow-md hover:scale-105 transition-transform duration-500" />
                    <img src="/image/Jurnal12.jpg" alt="Album 4"
                        class="rounded-xl shadow-md hover:scale-105 transition-transform duration-500" />
                </div>
            </div>
        </section>
    </main>

    <footer id="kontak"
        class="relative bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-white py-12 mt-auto overflow-hidden">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(59,130,246,0.2),transparent_70%)] animate-[spin_20s_linear_infinite]">
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid md:grid-cols-3 text-center md:text-left gap-8 mb-8 border-b border-blue-700 pb-8"
                data-aos="fade-up">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Ekskul Jurnalistik</h2>
                    <p class="text-gray-300 text-sm">
                        Menulis, meliput, dan menyuarakan kebenaran — kami belajar menjadi jurnalis muda yang
                        inspiratif.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-3">Kontak Kami</h3>
                    <p class="text-gray-300 text-sm">Ruang OSIS, SMK Contoh Sejahtera</p>
                    <p class="text-gray-300 text-sm">Email: jurnalistik@sekolah.sch.id</p>
                    <p class="text-gray-300 text-sm">Telepon: +62 812 3456 7890</p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-3">Ikuti Kami</h3>
                    <div class="flex justify-center md:justify-start gap-6 text-2xl">
                        <a href="https://www.instagram.com/namakamu" target="_blank"
                            class="hover:text-pink-400 transition-transform transform hover:scale-125"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="hover:text-green-400 transition-transform transform hover:scale-125"><i
                                class="fab fa-whatsapp"></i></a>
                        <a href="mailto:jurnalistik@sekolah.sch.id"
                            class="hover:text-yellow-300 transition-transform transform hover:scale-125"><i
                                class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center text-sm text-gray-400 mt-6" data-aos="fade-up">
                &copy; 2025 Ekskul Jurnalistik. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-in-out',
        });
    </script>
</body>

</html>