"use strict";
const output12 = document.getElementById('output12');
// Partial type - hace todas las propiedades opcionales
let macbookPro = {
    brand: 'Apple',
    ram: 16,
    storage: 512,
    gpu: 'AMD'
};
let chromebook = {
    brand: 'HP',
    ram: 8,
    storage: 128
};
let scoreBoard = {
    'Mario': 9500,
    'Luigi': 8700,
    'Peach': 9200
};
let gameBasicInfo = {
    title: 'The Legend of Zelda',
    genre: 'Adventure'
};
// Omit - excluye propiedades específicas
let gameWithoutDev = {
    title: 'Metroid Prime',
    genre: 'Action',
    year: 2002
};
if (output12) {
    output12.innerHTML += `
    <h3 class='mb-2'>Partial</h3>
    <li class="border m-auto p-5 rounded-sm text-xl w-full">
        <h2>MacBook Pro</h2>
        <h6 class='text-sm indent-4'>Marca: ${macbookPro.brand}</h6>
        <h6 class='text-sm indent-4'>RAM: ${macbookPro.ram}GB</h6>
        <h6 class='text-sm indent-4'>Almacenamiento: ${macbookPro.storage}GB</h6>
        <h6 class='text-sm indent-4'>GPU: ${macbookPro.gpu}</h6>

        <h2 class='mt-3'>Chromebook</h2>
        <h6 class='text-sm indent-4'>Marca: ${chromebook.brand}</h6>
        <h6 class='text-sm indent-4'>RAM: ${chromebook.ram}GB</h6>
        <h6 class='text-sm indent-4'>Almacenamiento: ${chromebook.storage}GB</h6>
    </li>`;
    output12.innerHTML += `<h3 class='mb-2'>Record</h3>`;
    for (let player in scoreBoard) {
        output12.innerHTML += ` <li class="border m-auto px-5 my-1 rounded-sm text-xl w-full">Jugador: ${player} | Puntuación: ${scoreBoard[player]} </li> `;
    }
    output12.innerHTML += `<h3 class='mb-2'>Pick</h3>
        <li class="border m-auto px-5 my-1 rounded-sm text-xl w-full">
            Juego: ${gameBasicInfo.title} - Género: ${gameBasicInfo.genre}
        </li>
    `;
    output12.innerHTML += `<h3 class='mb-2'>Omit</h3>
        <li class="border m-auto px-5 my-1 rounded-sm text-xl w-full">
            ${gameWithoutDev.title} (${gameWithoutDev.year}) - ${gameWithoutDev.genre}
        </li>
    `;
}
