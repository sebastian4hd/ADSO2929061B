class Enemy {
    name: string;
    health: number;

    constructor(name: string, health:number)
    {
        this.name = name;
        this.health = health;
    }
    takeDamage(damage: number): void {
        this.health -= damage;
    }
}

const mosskin = new Enemy('Mosskin', 30);
mosskin.takeDamage(10);

const output04 = document.getElementById('output04');

if(output04) {
    output04.innerHTML = `
        <li><stron>Enemy:</strong>${mosskin.name}</li>
        <li><strong>Health afeter attack:</strong>${mosskin.health}</li>`

}