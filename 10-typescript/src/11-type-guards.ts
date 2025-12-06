const output11 = document.getElementById('output11');

// Typeof guard
function formatLevel(level: string | number): string {
    if (typeof level === 'string') {
        return 'Nivel: ' + level.toUpperCase();
    } else {
        return 'Nivel ' + level + ' completado';
    }
}

// instanceof guard
class Vehicle {
    public describe(vehicle: Car | Motorcycle): string {
        if (vehicle instanceof Car) {
            return 'Tiene 4 ruedas';
        }
        if (vehicle instanceof Motorcycle) {
            return 'Tiene 2 ruedas';
        }
        return 'Vehículo desconocido';
    }
}

class Car extends Vehicle {}
class Motorcycle extends Vehicle {}

let car = new Car();
let motorcycle = new Motorcycle();

// Type predicate functions
interface Netflix {
    company: string;
    price: number;
    content: 'Series y Películas';
}

interface Spotify {
    company: string;
    price: number;
    content: 'Música y Podcasts';
}

function isSpotify(service: Netflix | Spotify): service is Spotify {
    return (service as Spotify).content === 'Música y Podcasts';
}

let netflix: Netflix = {
    company: 'Netflix Inc',
    price: 15,
    content: 'Series y Películas'
};

let spotify: Spotify = {
    company: 'Spotify AB',
    price: 10,
    content: 'Música y Podcasts'
};

function renderService(service: Netflix | Spotify): void {
    if (isSpotify(service)) {
        if (output11) {
            for (let k in service) {
                const key = k as keyof typeof service;
                output11.innerHTML += `<li class="w-full border m-auto p-5 rounded-sm text-xl"><span class='badge badge-success'>${key}</span> ${service[key]}</li>`;
            }
        }
    }
}

if (output11) {
    output11.innerHTML += `
    <h3 class='mb-2'>typeof Guard</h3>
    <li class="border m-auto p-5 rounded-sm text-xl"><span class='badge badge-primary'>${typeof formatLevel('Elite')}</span> ${formatLevel('Elite')}</li>
    <li class="border m-auto p-5 rounded-sm text-xl"><span class='badge badge-primary'>${typeof formatLevel(42)}</span> ${formatLevel(42)}</li>
    
    <h3 class='mb-2'>instanceof Guard</h3>
    <li class="border m-auto p-5 rounded-sm text-xl"><span class='badge badge-primary'>Auto</span> ${car.describe(car)}</li>
    <li class="border m-auto p-5 rounded-sm text-xl"><span class='badge badge-primary'>Moto</span> ${motorcycle.describe(motorcycle)}</li>
    
    <h3 class='mb-2'>type predicate / type assertion</h3>
    `;
    renderService(spotify);
}