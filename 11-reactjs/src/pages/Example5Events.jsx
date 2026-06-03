import { useState } from "react";
import BtnBack from "../components/BtnBack";
import "../components/CardPokemon.css";

function Example5Events() {
  const [chosenPokemon, setChosenPokemon] = useState(null);
  const [hoveredPokemon, setHoveredPokemon] = useState(null);
  const [inputRange, setInputRange] = useState(50);

  const handleChoice = (name) => {
    setChosenPokemon(name);
  };

  const handleMouseEnter = (name) => {
    setHoveredPokemon(name);
  };

  const handleMouseLeave = () => {
    setHoveredPokemon(null);
  };

  const handleInput = (e) => {
    setInputRange(e.target.value);
  };

  return (
    <div className="container">
      <BtnBack />

      <h2 className="event-page-title">Example 5: Event Handling</h2>

      <p className="event-page-description">
        Respond to user interactions (click, hover, input, submit).
      </p>

      <div className="event-container">
        <h3 className="event-section-title">Click Event:</h3>

        <div className="event-group">
          <button
            className="event-card-button"
            onClick={() => handleChoice("Bulbasaur")}
          >
            🌱 Bulbasaur
            <img
              width="170"
              src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png"
              alt="Bulbasaur"
            />
          </button>

          <button
            className="event-card-button"
            onClick={() => handleChoice("Charmander")}
          >
            🔥 Charmander
            <img
              width="170"
              src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png"
              alt="Charmander"
            />
          </button>

          <button
            className="event-card-button"
            onClick={() => handleChoice("Squirtle")}
          >
            💧 Squirtle
            <img
              width="170"
              src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png"
              alt="Squirtle"
            />
          </button>
        </div>

        <div className="event-chosen-box">
          {chosenPokemon
            ? `You chose ${chosenPokemon}!`
            : "Please choose a pokemon!"}
        </div>

        <h3 className="event-section-title">MouseEnter / MouseLeave:</h3>

        <div className="event-group">
          <button
            className="event-card-button"
            onMouseEnter={() => handleMouseEnter("Pikachu")}
            onMouseLeave={handleMouseLeave}
          >
            Hover Here
            <img
              width="170"
              src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png"
              alt="Pikachu"
            />
          </button>

          <button
            className="event-card-button"
            onMouseEnter={() => handleMouseEnter("Eevee")}
            onMouseLeave={handleMouseLeave}
          >
            Hover Here Too
            <img
              width="170"
              src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/133.png"
              alt="Eevee"
            />
          </button>
        </div>

        {hoveredPokemon && (
          <div className="event-chosen-box">
            You are viewing: {hoveredPokemon}
          </div>
        )}

        <h3 className="event-section-title">Input Event:</h3>

        <input
          type="range"
          min="0"
          max="100"
          value={inputRange}
          onInput={handleInput}
          className="event-range"
        />

        <span className="event-label">Power:</span>

        <div className="event-output">{inputRange}</div>
      </div>
    </div>
  );
}

export default Example5Events;