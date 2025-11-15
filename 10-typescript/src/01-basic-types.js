"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// Basic types: string, number, boolean
const characterName = "Hornet";
const health = 100;
const canDoubleJump = false;
const hobbies = ["Reading", "Running", "codigo"];
const personalData = ["Hornet", 100];
const dynamicVariable = "This can be anything";
// Display in browser
const output01 = document.getElementById('output01');
if (output01) {
    output01.innerHTML = `
        <p><strong>Character:</strong> ${characterName}</p>
        <p><strong>Health:</strong> ${health}</p>
        <p><strong>Can Double Jump:</strong> ${canDoubleJump}</p>
        <p><strong>Hobbies:</strong> ${hobbies}</p>
        <p><strong>Personal Data:</strong> ${personalData}</p>
        <p><strong>Dynamic Variable:</strong> ${dynamicVariable}</p>
    `;
}
//# sourceMappingURL=01-basic-types.js.map