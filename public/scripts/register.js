const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");
const errorDiv = document.getElementById("passwordError");
const submitBtn = document.getElementById("submitBtn");

function validatePasswords() {
  if (password.value !== confirmPassword.value) {
    errorDiv.textContent = "Les mots de passe ne correspondent pas.";
    submitBtn.disabled = true;
  } else {
    errorDiv.textContent = "";
    submitBtn.disabled = false;
  }
}

password.addEventListener("input", validatePasswords);
confirmPassword.addEventListener("input", validatePasswords);
