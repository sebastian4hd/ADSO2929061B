import { useEffect, useState } from "react";
import BtnBack from "../components/BtnBack";
import "./Example8DataFetching.css";

function Example8DataFetching() {
    const [pokemonList, setPokemonList] = useState([]);
    const [selectedName, setSelectedName] = useState("");
    const [selectedDetails, setSelectedDetails] = useState(null);
    const [page, setPage] = useState(1);
    const [isListLoading, setIsListLoading] = useState(false);
    const [isDetailsLoading, setIsDetailsLoading] = useState(false);
    const [error, setError] = useState(null);

    const limit = 20;

    const capitalize = (value) => {
        return value.charAt(0).toUpperCase() + value.slice(1);
    };

    const fetchPokemonList = async (pageNumber) => {
        setIsListLoading(true);
        setError(null);

        try {
            const offset = (pageNumber - 1) * limit;
            const response = await fetch(`https://pokeapi.co/api/v2/pokemon?offset=${offset}&limit=${limit}`);
            if (!response.ok) {
                throw new Error("No se pudo cargar la lista de Pokémon.");
            }

            const data = await response.json();
            const list = data.results.map((pokemon, index) => ({
                id: offset + index + 1,
                name: pokemon.name,
                url: pokemon.url,
            }));

            setPokemonList(list);
            if (!selectedName && list.length > 0) {
                setSelectedName(list[0].name);
            }
        } catch (fetchError) {
            setError(fetchError.message);
        } finally {
            setIsListLoading(false);
        }
    };

    const fetchPokemonDetails = async (name) => {
        if (!name) return;

        setIsDetailsLoading(true);
        setError(null);

        try {
            const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${name}`);
            if (!response.ok) {
                throw new Error("No se pudo cargar la información del Pokémon seleccionado.");
            }

            const data = await response.json();
            setSelectedDetails(data);
        } catch (fetchError) {
            setError(fetchError.message);
            setSelectedDetails(null);
        } finally {
            setIsDetailsLoading(false);
        }
    };

    useEffect(() => {
        fetchPokemonList(page);
    }, [page]);

    useEffect(() => {
        if (selectedName) {
            fetchPokemonDetails(selectedName);
        }
    }, [selectedName]);

    const handleCardClick = (name) => {
        setSelectedName(name);
    };

    const handlePreviousPage = () => {
        if (page > 1) {
            setPage((prevPage) => prevPage - 1);
            setSelectedDetails(null);
            setSelectedName("");
        }
    };

    const handleNextPage = () => {
        setPage((prevPage) => prevPage + 1);
        setSelectedDetails(null);
        setSelectedName("");
    };

    return (
        <div className="container example8-container">
            <BtnBack />
            <h2 className="example8-header">Example 8: Data Fetching</h2>
            <p>Conecta con una API externa para obtener datos reales de Pokémon.</p>

            <div className="example8-grid">
                <section className="example8-list-section">
                    <div className="example8-pagination">
                        <div>
                            <h3>Pokémon (Página {page})</h3>
                            <p>Selecciona un Pokémon para ver sus detalles.</p>
                        </div>
                        <div className="example8-button-group">
                            <button onClick={handlePreviousPage} disabled={page === 1 || isListLoading}>
                                ←
                            </button>
                            <button onClick={handleNextPage} disabled={isListLoading}>
                                →
                            </button>
                        </div>
                    </div>

                    <div className="example8-card-grid">
                        {isListLoading && <p>Cargando lista...</p>}
                        {error && <p style={{ color: "red" }}>{error}</p>}
                        {!isListLoading && !error && pokemonList.map((pokemon) => {
                            const isSelected = pokemon.name === selectedName;
                            return (
                                <button
                                    key={pokemon.id}
                                    onClick={() => handleCardClick(pokemon.name)}
                                    className={`example8-card ${isSelected ? 'selected' : ''}`}
                                >
                                    <strong>#{pokemon.id}</strong>
                                    <span>{capitalize(pokemon.name)}</span>
                                </button>
                            );
                        })}
                    </div>
                </section>

                <aside className="example8-details-panel">
                    <h3>Details</h3>
                    {isDetailsLoading && <p>Cargando detalles...</p>}
                    {error && <p style={{ color: "#ffb3b3" }}>{error}</p>}
                    {!isDetailsLoading && !error && selectedDetails && (
                        <div className="example8-details-list">
                            <div style={{ textAlign: "center" }}>
                                <img
                                    src={selectedDetails.sprites?.other?.['official-artwork']?.front_default || selectedDetails.sprites?.front_default}
                                    alt={selectedDetails.name}
                                />
                            </div>
                            <div>
                                <p style={{ margin: "0 0 8px 0", fontSize: "1.25rem" }}>
                                    {capitalize(selectedDetails.name)}
                                </p>
                                <p><strong>Height:</strong> {selectedDetails.height / 10} m</p>
                                <p><strong>Weight:</strong> {selectedDetails.weight / 10} kg</p>
                                <p><strong>Types:</strong> {selectedDetails.types.map((entry) => capitalize(entry.type.name)).join(', ')}</p>
                                <p><strong>Abilities:</strong> {selectedDetails.abilities.map((entry) => capitalize(entry.ability.name)).join(', ')}</p>
                            </div>
                        </div>
                    )}
                    {!isDetailsLoading && !error && !selectedDetails && (
                        <p>Selecciona un Pokémon para ver su información.</p>
                    )}
                </aside>
            </div>
        </div>
    );
}

export default Example8DataFetching;
