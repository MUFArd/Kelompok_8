document.addEventListener("DOMContentLoaded", function () {
  const formLogin = document.getElementById("formlogin");
  const formLupa = document.getElementById("form-lupa-password");
  const btnLupa = document.getElementById("bttn-lupa-password");
  const btnLogin = document.getElementById("bttn-login");
  const seePassword = document.getElementById("seepassword");
  const passwordInput = document.getElementById("password-input");

  // Tombol "Lupa Password"
  if (btnLupa) {
    btnLupa.addEventListener("click", function () {
      formLogin.classList.add("hidden");
      formLupa.classList.remove("hidden");
    });
  }

  // Tombol "Kembali"
  if (btnLogin) {
    btnLogin.addEventListener("click", function () {
      formLupa.classList.add("hidden");
      formLogin.classList.remove("hidden");
    });
  }

  // Toggle Lihat Password
  if (seePassword) {
    seePassword.addEventListener("click", function () {
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
      this.classList.toggle("fa-eye-slash");
    });
  }
});
