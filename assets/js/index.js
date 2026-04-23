  let scanner;

  function bukaScanner() {
    document.getElementById("scanner-modal").style.display = "block";
    scanner = new Html5Qrcode("reader");

    scanner.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: 300 },
      (kodeSiswa) => {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "proses/absen_proses.php";

        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "NISN";
        input.value = kodeSiswa;

        form.appendChild(input);
        document.body.appendChild(form);

        scanner.stop().then(() => {
          const scanSound = document.getElementById("scan-sound");
          scanSound.volume = 0.5;
          scanSound.play();
          document.getElementById("scanner-modal").style.display = "none";
          form.submit();
        });
      },
      (errorMessage) => {
        console.warn("QR scan error:", errorMessage);
      }
    ).catch(err => {
      alert("Gagal membuka kamera: " + err);
    });
  }

  function tutupScanner() {
    if (scanner) {
      scanner.stop().then(() => {
        document.getElementById("scanner-modal").style.display = "none";
      }).catch(err => {
        console.warn("Gagal menutup scanner:", err);
        document.getElementById("scanner-modal").style.display = "none";
      });
    } else {
      document.getElementById("scanner-modal").style.display = "none";
    }
  }