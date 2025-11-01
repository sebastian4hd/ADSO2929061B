// Basic types: string, number, boolean
const characterName: string = "Hornet";
const health:        number = 100;
const canDoubleJump: boolean = false;
const hobbies:       string[] = ["Reading", "Running", "codigo"];
const personalData:  [string, number] = ["Hornet", 100];
const dynamicVariable: any = "This can be anything";

// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <p><strong>Character:</strong> ${characterName}</p>
        <p><strong>Health:</strong> ${health}</p>
        <p><strong>Can Double Jump:</strong> ${canDoubleJump}</p>
        <p><strong>Hobbies:</strong> ${hobbies}</p>
        <p><strong>Personal Data:</strong> ${personalData}</p>
        <p><strong>Dynamic Variable:</strong> ${dynamicVariable}</p>
    `;
}