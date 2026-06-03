import { useState } from "react";
import BtnBack from "../components/BtnBack";
import "./Example6ConditionalLists.css";

function Example6ConditionalLists() {
  const [pcBox, setPcBox] = useState([
    {
      id: 1,
      name: "Pidgey",
      level: 3,
      type: "Normal/Flying",
      image:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/16.png",
    },

    {
      id: 2,
      name: "Rattata",
      level: 2,
      type: "Normal",
      image:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/19.png",
    },

    {
      id: 3,
      name: "Zubat",
      level: 4,
      type: "Poison/Flying",
      image:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/41.png",
    },

    {
      id: 4,
      name: "Geodude",
      level: 5,
      type: "Rock/Ground",
      image:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/74.png",
    },
  ]);

  const [typeFilter, setTypeFilter] = useState("all");
  const [showOnlyHighLevel, setShowOnlyHighLevel] = useState(false);

  const releasePokemon = (id) => {
    setPcBox(pcBox.filter((pokemon) => pokemon.id !== id));
  };

  const addPokemon = () => {
    const newPokemon = [
      {
        name: "Caterpie",
        level: 2,
        type: "Bug",
        image:
          "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png",
      },

      {
        name: "Weedle",
        level: 2,
        type: "Bug/Poison",
        image:
          "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/13.png",
      },

      {
        name: "Pidgeotto",
        level: 8,
        type: "Normal/Flying",
        image:
          "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/17.png",
      },
    ];

    const random = newPokemon[Math.floor(Math.random() * newPokemon.length)];

    setPcBox([
      ...pcBox,

      {
        ...random,
        id: Date.now(),
      },
    ]);
  };

  const filteredPokemon = pcBox.filter((pokemon) => {
    if (
      typeFilter !== "all" &&
      !pokemon.type.toLowerCase().includes(typeFilter)
    ) {
      return false;
    }

    if (showOnlyHighLevel && pokemon.level < 4) {
      return false;
    }

    return true;
  });

  return (
    <div className="container">
      <BtnBack />

      <h2 className="example6-title">Example 6: Conditional Rendering</h2>

      <p className="example6-description">Show or hide UI elements based on state.</p>

      <h3>Filters:</h3>

      <div className="example6-filters">
        <select
          className="example6-select"
          value={typeFilter}
          onChange={(e) => setTypeFilter(e.target.value)}
        >
          <option value="all">All Types</option>
          <option value="normal">Normal</option>
          <option value="flying">Flying</option>
          <option value="poison">Poison</option>
          <option value="bug">Bug</option>
        </select>

        <label className="example6-checkbox">
          <input
            type="checkbox"
            checked={showOnlyHighLevel}
            onChange={(e) => setShowOnlyHighLevel(e.target.checked)}
          />
          Show only level 4+
        </label>

        <button className="example6-button" onClick={addPokemon}>
          Random Pokemon
        </button>
      </div>

      <p>
        <strong>
          Showing {filteredPokemon.length} of {pcBox.length} Pokémon
        </strong>
      </p>

      {filteredPokemon.length === 0 ? (
        <div className="example6-empty">
          <h2>No Pokémon found</h2>
          <p>Try changing filters</p>
        </div>
      ) : (
        <div className="example6-cards">
          {filteredPokemon.map((pokemon) => (
            <div key={pokemon.id} className="example6-card">
              <img
                src={pokemon.image}
                alt={pokemon.name}
                className="example6-img"
              />

              <h3>{pokemon.name}</h3>
              <p>Level: {pokemon.level}</p>
              <p>{pokemon.type}</p>

              <button
                className="example6-release-button"
                onClick={() => releasePokemon(pokemon.id)}
              >
                Release
              </button>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}

export default Example6ConditionalLists;

