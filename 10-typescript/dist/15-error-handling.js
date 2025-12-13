"use strict";
const output15 = document.getElementById('output15');
const inputPassword = document.querySelector('#password');
function validatePassword(password) {
    if (password.length < 8)
        throw new Error('La contraseña es muy corta');
    if (output15) {
        output15.innerHTML = `<h2 class='text-green-500'>Contraseña válida</h2>`;
    }
}
if (inputPassword && output15) {
    inputPassword.addEventListener('input', e => {
        try {
            validatePassword(inputPassword.value);
        }
        catch (error) {
            output15.innerHTML = `<h2 class='text-red-400 text-sm'>La contraseña debe tener al menos 8 caracteres</h2>`;
        }
    });
}
