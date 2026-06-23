import { useEffect, useState } from "react";
import BtnBack from "../components/BtnBack";
import Swal from "sweetalert2";
import "./Challenge.css";

function Challenge() {
    const [pets, setPets] = useState([]);
    const [selectedPet, setSelectedPet] = useState(null);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);
    const [showForm, setShowForm] = useState(false);
    const [formData, setFormData] = useState({
        name: "",
        type: "",
        breed: "",
        age: "",
        weight: "",
        location: "",
        description: "",
    });

    const API_BASE = "http://127.0.0.1:8000/api"; // endpoint de 20-larapi

    const getToken = () => localStorage.getItem("token") || null;

    const headersWithAuth = () => {
        const token = getToken();
        return token ? { Authorization: `Bearer ${token}`, "Content-Type": "application/json" } : { "Content-Type": "application/json" };
    };

    const fetchPets = async () => {
        setIsLoading(true);
        setError(null);
        try {
            const res = await fetch(`${API_BASE}/pets/list`, { headers: headersWithAuth() });
            if (!res.ok) throw new Error("No se pudo obtener la lista de mascotas. Asegúrate de iniciar sesión si la API lo requiere.");
            const data = await res.json();
            setPets(Array.isArray(data) ? data : data.data || []);
        } catch (err) {
            setError(err.message);
        } finally {
            setIsLoading(false);
        }
    };

    const fetchPetDetails = async (id) => {
        setIsLoading(true);
        setError(null);
        try {
            const res = await fetch(`${API_BASE}/pets/show/${id}`, { headers: headersWithAuth() });
            if (!res.ok) throw new Error("No se pudo obtener los detalles de la mascota.");
            const data = await res.json();
            setSelectedPet(data);
        } catch (err) {
            setError(err.message);
        } finally {
            setIsLoading(false);
        }
    };

    const handleSelect = (pet) => {
        setSelectedPet(pet);
    };

    const handleDelete = async (pet) => {
        const result = await Swal.fire({
            title: `Eliminar ${pet.name}?`,
            text: "Esta acción no se puede deshacer.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        });

        if (!result.isConfirmed) return;

        try {
            const res = await fetch(`${API_BASE}/pets/delete/${pet.id}`, { method: "DELETE", headers: headersWithAuth() });
            if (!res.ok) throw new Error("Error al eliminar la mascota.");
            Swal.fire("Eliminado", "La mascota fue eliminada.", "success");
            fetchPets();
            setSelectedPet(null);
        } catch (err) {
            Swal.fire("Error", err.message, "error");
        }
    };

    const openAddForm = () => {
        setFormData({ name: "", type: "", breed: "", age: "", weight: "", location: "", description: "" });
        setShowForm(true);
    };

    const openEditForm = (pet) => {
        setFormData({
            name: pet.name || "",
            type: pet.type || "",
            breed: pet.race || pet.breed || "",
            age: pet.age || "",
            weight: pet.weight || "",
            location: pet.location || "",
            description: pet.description || "",
            id: pet.id,
        });
        setShowForm(true);
    };

    const handleFormChange = (e) => {
        const { name, value } = e.target;
        setFormData((prev) => ({ ...prev, [name]: value }));
    };

    const handleFormSubmit = async (e) => {
        e.preventDefault();
        try {
            const method = formData.id ? "PUT" : "POST";
            const url = formData.id ? `${API_BASE}/pets/edit/${formData.id}` : `${API_BASE}/pets/store`;
            const body = JSON.stringify({
                name: formData.name,
                type: formData.type,
                race: formData.breed,
                age: formData.age,
                weight: formData.weight,
                location: formData.location,
                description: formData.description,
            });

            const res = await fetch(url, { method, headers: headersWithAuth(), body });
            if (!res.ok) throw new Error("Error al guardar la mascota.");
            Swal.fire("Éxito", "Mascota guardada correctamente.", "success");
            setShowForm(false);
            fetchPets();
        } catch (err) {
            Swal.fire("Error", err.message, "error");
        }
    };

    useEffect(() => {
        fetchPets();
    }, []);

    return (
        <div className="container example8-container pets-container">
            <BtnBack />
            <h2 className="example8-header">Gestión de Mascotas</h2>
            <p>Interfaz React conectada a la API creada en <strong>20-larapi</strong>.</p>

            <div className="pets-topbar">
                <div>
                    <button className="btn-primary" onClick={openAddForm}>Agregar Mascota</button>
                </div>
            </div>

            <div className="pets-grid">
                <section className="pets-list">
                    <h3>Mis mascotas</h3>
                    {isLoading && <p>Cargando...</p>}
                    {error && <p className="error">{error}</p>}
                    <ul className="pets-ul">
                        {pets.map((pet) => (
                            <li key={pet.id} className={`pet-item ${selectedPet && selectedPet.id === pet.id ? 'active' : ''}`}>
                                <button className="pet-card" onClick={() => handleSelect(pet)}>
                                    <div className="pet-icon" style={{ width: 53, height: 50 }}>
                                        {/* Placeholder para icono - tamaño W:53 H:50 */}
                                    </div>
                                    <div className="pet-info">
                                        <strong>{pet.name}</strong>
                                        <small>{pet.race || pet.breed || ''} • {pet.age} años</small>
                                    </div>
                                </button>
                                <div className="pet-actions">
                                    <button className="btn-edit" onClick={() => openEditForm(pet)}>Editar</button>
                                    <button className="btn-danger" onClick={() => handleDelete(pet)}>Eliminar</button>
                                </div>
                            </li>
                        ))}
                        {pets.length === 0 && !isLoading && <li>No hay mascotas registradas.</li>}
                    </ul>
                </section>

                <aside className="pets-details">
                    <h3>Detalles</h3>
                    {selectedPet ? (
                        <div className="details-card">
                            <div className="details-header">
                                <div className="pet-icon-large" style={{ width: 120, height: 120 }}>
                                    {/* placeholder imagen */}
                                </div>
                                <div>
                                    <h4>{selectedPet.name}</h4>
                                    <p className="muted">{selectedPet.race || selectedPet.breed}</p>
                                </div>
                            </div>
                            <div className="details-body">
                                <p><strong>Edad:</strong> {selectedPet.age} años</p>
                                <p><strong>Peso:</strong> {selectedPet.weight} lbs</p>
                                <p><strong>Ubicación:</strong> {selectedPet.location}</p>
                                <p><strong>Descripción:</strong> {selectedPet.description}</p>
                                <div className="details-actions">
                                    <button className="btn-edit" onClick={() => openEditForm(selectedPet)}>Editar</button>
                                    <button className="btn-danger" onClick={() => handleDelete(selectedPet)}>Eliminar</button>
                                </div>
                            </div>
                        </div>
                    ) : (
                        <p>Selecciona una mascota para ver sus detalles.</p>
                    )}
                </aside>
            </div>

            {showForm && (
                <div className="pet-form-panel">
                    <form onSubmit={handleFormSubmit} className="pet-form">
                        <h3>{formData.id ? 'Editar Mascota' : 'Agregar Mascota'}</h3>
                        <label>Nombre</label>
                        <input name="name" value={formData.name} onChange={handleFormChange} required />
                        <label>Tipo</label>
                        <input name="type" value={formData.type} onChange={handleFormChange} />
                        <label>Raza</label>
                        <input name="breed" value={formData.breed} onChange={handleFormChange} />
                        <label>Edad</label>
                        <input name="age" value={formData.age} onChange={handleFormChange} />
                        <label>Peso (lbs)</label>
                        <input name="weight" value={formData.weight} onChange={handleFormChange} />
                        <label>Ubicación</label>
                        <input name="location" value={formData.location} onChange={handleFormChange} />
                        <label>Descripción</label>
                        <textarea name="description" value={formData.description} onChange={handleFormChange} />

                        <div className="form-actions">
                            <button type="button" className="btn-secondary" onClick={() => setShowForm(false)}>Cancelar</button>
                            <button type="submit" className="btn-primary">{formData.id ? 'Guardar Cambios' : 'Agregar'}</button>
                        </div>
                    </form>
                </div>
            )}
        </div>
    );
}

export default Challenge;
