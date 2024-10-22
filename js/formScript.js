// Habilitar o deshabilitar el campo de contraseña
document.getElementById('resetPassword').addEventListener('change', function () {
    var passwordField = document.getElementById('password');
    if (this.checked) {
        passwordField.disabled = false;
    } else {
        passwordField.disabled = true;
    }
});

// Mostrar u ocultar la contraseña
document.getElementById('showPassword').addEventListener('change', function () {
    var passwordField = document.getElementById('password');
    if (this.checked) {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
});