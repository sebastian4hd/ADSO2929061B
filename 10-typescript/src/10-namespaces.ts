// --- Declaración del namespace ---
namespace Calculator {

    // Función dentro del namespace
    export function calcularPerimetro(lado: number): number {
        return lado * 4;
    }

    // Clase dentro del namespace
    export class Square {
        constructor(public side: number) {}

        perimeter() {
            return `El perímetro del cuadrado es: ${this.side * 4}`;
        }
    }
}

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