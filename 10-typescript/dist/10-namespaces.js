"use strict";
// --- Declaración del namespace ---
var Calculator;
(function (Calculator) {
    // Función dentro del namespace
    function calcularPerimetro(lado) {
        return lado * 4;
    }
    Calculator.calcularPerimetro = calcularPerimetro;
    // Clase dentro del namespace
    class Square {
        constructor(side) {
            this.side = side;
        }
        perimeter() {
            return `El perímetro del cuadrado es: ${this.side * 4}`;
        }
    }
    Calculator.Square = Square;
})(Calculator || (Calculator = {}));
// Usando el namespace
const perimeter = Calculator.calcularPerimetro(6);
const square = new Calculator.Square(5);
// Mostrar en HTML
const output10 = document.getElementById("output10");
if (output10) {
    output10.innerHTML = `
        <li><strong>Namespace Function:</strong> Perímetro calculado = ${perimeter}</li>
        <li><strong>Namespace Class:</strong> ${square.perimeter()}</li>
    `;
}
