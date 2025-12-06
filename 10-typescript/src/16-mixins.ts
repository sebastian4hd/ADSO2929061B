type Constructor<T = {}> = new (...args: any[]) => T;

function Flying<TBase extends Constructor>(Base: TBase) {
  return class extends Base {
    takeOff() {
      return "El avión despega desde la pista ✈️";
    }
    land() {
      return "El avión aterriza suavemente 🛬";
    }
  };
}

function Navigation<TBase extends Constructor>(Base: TBase) {
  return class extends Base {
    setRoute() {
      return "Ruta establecida en el GPS 🗺️";
    }
    adjustAltitude() {
      return "Ajustando altitud de crucero 📈";
    }
  };
}

function Communication<TBase extends Constructor>(Base: TBase) {
  return class extends Base {
    contactTower() {
      return "Contactando con la torre de control 📡";
    }
  };
}


class AircraftBase {
  constructor(public model: string) {}
}

class Aircraft extends Communication(Navigation(Flying(AircraftBase))) {}


const output16 = document.getElementById("output17");

if (output16) {
  const plane = new Aircraft("Boeing 747");

  const actions = [
    plane.takeOff(),
    plane.setRoute(),
    plane.adjustAltitude(),
    plane.contactTower(),
    plane.land()
  ];

  output16.innerHTML = `
    <h2>${plane.model} — Operaciones de Vuelo</h2>
    <ul>
      ${actions.map(action => `<li>${action}</li>`).join("")}
    </ul>
  `;
}