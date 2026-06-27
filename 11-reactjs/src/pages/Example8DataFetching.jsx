import { useState, useEffect } from "react";
import BtnBack from "../components/BtnBack";
import "./Example8DataFetching.css";

const TYPE_COLORS = {
  normal: "#A8A878",
  fire: "#F08030",
  water: "#6890F0",
  grass: "#78C850",
  electric: "#F8D030",
  ice: "#98D8D8",
  fighting: "#C03028",
  poison: "#A040A0",
  ground: "#E0C068",
  flying: "#A890F0",
  psychic: "#F85888",
  bug: "#A8B820",
  rock: "#B8A038",
  ghost: "#705898",
  dragon: "#7038F8",
  dark: "#705848",
  steel: "#B8B8D0",
  fairy: "#F0B6BC",
};

const POKEMON_PER_PAGE = 20;

function Example8DataFetching() {
  const [pokemonList, setPokemonList] = useState([]);
  const [selected, setSelected] = useState(null);
  const [detail, setDetail] = useState(null);
  const [page, setPage] = useState(1);
  const [totalCount, setTotalCount] = useState(0);
  const [loading, setLoading] = useState(true);
  const [detailLoading, setDetailLoading] = useState(false);

  useEffect(() => {
    setLoading(true);
    setSelected(null);
    setDetail(null);
    const offset = (page - 1) * POKEMON_PER_PAGE;
    fetch(
      `https://pokeapi.co/api/v2/pokemon?limit=${POKEMON_PER_PAGE}&offset=${offset}`,
    )
      .then((r) => r.json())
      .then((data) => {
        setTotalCount(data.count);
        const list = data.results.map((p) => ({
          id: parseInt(p.url.split("/").filter(Boolean).pop()),
          name: p.name,
        }));
        setPokemonList(list);
        setLoading(false);
        loadDetail(list[0]);
      });
  }, [page]);

  const loadDetail = async (poke) => {
    if (!poke) return;
    setSelected(poke.id);
    setDetailLoading(true);
    const data = await fetch(
      `https://pokeapi.co/api/v2/pokemon/${poke.id}`,
    ).then((r) => r.json());
    setDetail({
      id: data.id,
      name: data.name,
      image: data.sprites?.other?.["official-artwork"]?.front_default,
      height: (data.height / 10).toFixed(1) + " m",
      weight: (data.weight / 10).toFixed(1) + " kg",
      types: data.types.map((t) => t.type.name),
      abilities: data.abilities.map((a) => a.ability.name).join(", "),
    });
    setDetailLoading(false);
  };

  const totalPages = Math.ceil(totalCount / POKEMON_PER_PAGE);

  return (
    <div className="example8-page">
      <div className="example8-card">
        <BtnBack />
        <h2 className="example8-title">Example 8: Data Fetching</h2>
        <p className="example8-description">
          Connect with external APIs to get real data.
        </p>

        <div className="example8-body">
          <div className="example8-list-panel">
            <div className="example8-list-header">
              <span className="example8-page-label">Pokémon (Page {page})</span>
              <div className="example8-page-controls">
                <button
                  className={`example8-page-btn ${page === 1 ? "is-disabled" : ""}`}
                  disabled={page === 1}
                  onClick={() => setPage((p) => p - 1)}
                >
                  ←
                </button>
                <button
                  className={`example8-page-btn ${page === totalPages ? "is-disabled" : ""}`}
                  disabled={page === totalPages}
                  onClick={() => setPage((p) => p + 1)}
                >
                  →
                </button>
              </div>
            </div>

            <div className="example8-scroll-area">
              {loading ? (
                <p className="example8-msg">Loading Pokémon...</p>
              ) : (
                <div className="example8-grid">
                  {pokemonList.map((poke) => {
                    const isSel = selected === poke.id;
                    return (
                      <button
                        key={poke.id}
                        onClick={() => loadDetail(poke)}
                        className={`example8-poke-btn ${isSel ? "is-selected" : ""}`}
                      >
                        <span className="example8-poke-num">
                          #{String(poke.id).padStart(3, "0")}
                        </span>
                        <span className="example8-poke-name">{poke.name}</span>
                      </button>
                    );
                  })}
                </div>
              )}
            </div>
          </div>

          <div className="example8-detail-panel">
            <span className="example8-detail-title">Details</span>
            <div className="example8-detail-box">
              {detailLoading ? (
                <p className="example8-msg">Loading...</p>
              ) : !detail ? (
                <p className="example8-msg">Select a Pokémon</p>
              ) : (
                <>
                  <img
                    src={detail.image}
                    alt={detail.name}
                    className="example8-detail-img"
                  />
                  <p className="example8-detail-name">{detail.name}</p>
                  {[
                    { label: "Height:", value: detail.height },
                    { label: "Weight:", value: detail.weight },
                    { label: "Types:", value: detail.types.join(", ") },
                    { label: "Abilities:", value: detail.abilities },
                  ].map(({ label, value }) => (
                    <div key={label} className="example8-info-row">
                      <span className="example8-info-label">{label}</span>
                      <span className="example8-info-value">{value}</span>
                    </div>
                  ))}
                  <div className="example8-badges">
                    {detail.types.map((t) => (
                      <span
                        key={t}
                        className="example8-badge"
                        style={{ "--type-color": TYPE_COLORS[t] || "#888" }}
                      >
                        {t}
                      </span>
                    ))}
                  </div>
                </>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Example8DataFetching;