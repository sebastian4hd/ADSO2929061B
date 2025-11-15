"use strict";
class Enemy {
    constructor(name, health) {
        this.name = name;
        this.health = health;
    }
    takeDamage(damage) {
        this.health -= damage;
    }
}
const mosskin = new Enemy('Mosskin', 30);
mosskin.takeDamage(10);
const output04 = document.getElementById('output04');
if (output04) {
    output04.innerHTML = `
        <li><stron>Enemy:</strong>${mosskin.name}</li>
        <li><strong>Health afeter attack:</strong>${mosskin.health}</li>`;
}
