class Inventory<T> {
    private iteams: T[] = [];

    addItem(item: T): void {
        this.iteams.push(item);
    }

    getItems(): T[] {
        return this.iteams;
    }
}

const charmInventory = new Inventory<string>();
charmInventory.addItem('Mothwing Cloak');
charmInventory.addItem('Crystal Heart');

const output05 = document.getElementById('output05');

if(output05) {
    output05.innerHTML = `
        <li><strong>Charms collected:</strong></li>
        <ul>${charmInventory.getItems().map(c => `<li>${c}</li>`).join('')}</ul>`
}

