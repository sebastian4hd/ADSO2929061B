"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const output9 = document.getElementById('output9');
function multiplicar(a, b) {
    return a * b;
}
let num1 = Number(prompt('Vamos a realizar una multiplicación, ingresa el primer número: '));
let num2 = Number(prompt('Ingresa el segundo número: '));
let resultado = multiplicar(num1, num2);
if (output9) {
    output9.innerHTML = `<li>Número 1: ${num1}</li>
                         <li>Número 2: ${num2}</li>
                         <li>Resultado: ${resultado}</li>`;
}
//# sourceMappingURL=09-modules.js.map