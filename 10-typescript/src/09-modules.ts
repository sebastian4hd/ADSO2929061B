const output9 = document.getElementById('output9');

function multiplicar(a: number, b: number): number {
    return a * b;
}

let num1: number = Number(prompt('Vamos a realizar una multiplicación, ingresa el primer número: '));

let num2: number = Number(prompt('Ingresa el segundo número: '));

let resultado: number = multiplicar(num1, num2);

if(output9){
    output9.innerHTML = `<li>Número 1: ${num1}</li>
                         <li>Número 2: ${num2}</li>
                         <li>Resultado: ${resultado}</li>`
}