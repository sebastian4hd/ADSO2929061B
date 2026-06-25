import React, { useEffect, useState } from "react";
import { Link, useNavigate, useParams, useLocation } from "react-router-dom";
import Swal from "sweetalert2";
import "./Challenge.css";

const LOGIN_IMAGE = "/assets/images/login_dog.png";

const IMAGE_MAP = {
  "no-dog.jpg": "/assets/images/no-dog.jpg",
  "no-cat.jpg": "/assets/images/no-cat.jpg",
  "no-horse.png": "/assets/images/no-horse.png",
  "no-pig.jpg": "/assets/images/no-pig.jpg",
  "no-vaca.jpg": "/assets/images/no-vaca.jpg",
  "no-tiger.jpg": "/assets/images/no-tiger.jpg",
  "no-tiger-albino.jpg": "/assets/images/no-tiger-albino.jpg"
};

const getFallbackImage = (kind) => {
  const type = (kind || "dog").toLowerCase();
  if (type === "cat") return IMAGE_MAP["no-cat.jpg"];
  if (type === "horse") return IMAGE_MAP["no-horse.png"];
  if (type === "pig") return IMAGE_MAP["no-pig.jpg"];
  if (type === "cow") return IMAGE_MAP["no-vaca.jpg"];
  if (type === "tiger") return IMAGE_MAP["no-tiger.jpg"];
  return IMAGE_MAP["no-dog.jpg"];
};

function Challenge() {
  const [screen, setScreen] = useState("login"); // 'login', 'dashboard', 'details', 'add', 'edit'
  const screenTitles = {
    login: "Login",
    dashboard: "Mis mascotas",
    add: "Agregar mascota",
    details: "Detalles de mascota",
    edit: "Editar mascota"
  };
  const [pets, setPets] = useState([]);
  const [selectedPet, setSelectedPet] = useState(null);
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState(null);
  const [tempImageBase64, setTempImageBase64] = useState("");

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [showPassword, setShowPassword] = useState(false);
  const [userFullName, setUserFullName] = useState("");

  const [formData, setFormData] = useState({
    name: "",
    kind: "dog",
    bread: "",
    age: "",
    weight: "",
    location: "",
    description: "",
    image: "no-dog.jpg",
    active: 1,
    adopted: 0,
  });

  const API_BASE = "http://127.0.0.1:8000/api";

  const navigate = useNavigate();
  const params = useParams();
  const location = useLocation();

  useEffect(() => {
    const token = localStorage.getItem("token");
    const name = localStorage.getItem("user_fullname");
    if (token) setUserFullName(name || "Usuario");
    syncScreenWithLocation();
    if (token) fetchPets(token);
  }, []);

  useEffect(() => {
    syncScreenWithLocation();
    if (params.id && pets.length > 0) {
      const found = pets.find((p) => String(p.id) === String(params.id));
      if (found) setSelectedPet(found);
      else fetchPets();
    }
  }, [location.pathname, params.id, pets.length]);

  const syncScreenWithLocation = () => {
    const path = location?.pathname || window.location.pathname;
    const token = getToken();
    if (path.endsWith("/login")) {
      if (token) {
        navigate("/challenge");
        return;
      }
      setScreen("login");
    } else if (path.includes("/challenge/show/")) setScreen("details");
    else if (path.endsWith("/add")) setScreen("add");
    else if (path.includes("/challenge/edit/")) setScreen("edit");
    else setScreen("dashboard");
  };

  const getToken = () => localStorage.getItem("token") || null;

  const headersWithAuth = (tokenOverride) => {
    const token = tokenOverride || getToken();
    return token
      ? { Authorization: `Bearer ${token}`, "Content-Type": "application/json" }
      : { "Content-Type": "application/json" };
  };

  const getExtraInfo = (petId) => {
    const stored = localStorage.getItem(`pet_extra_${petId}`);
    if (stored) {
      return JSON.parse(stored);
    }
    return {
      birth_date: "12 Mayo de 2024",
      color: "beige claro",
      microchip: "1234567890"
    };
  };

  const saveExtraInfo = (petId, info) => {
    localStorage.setItem(`pet_extra_${petId}`, JSON.stringify(info));
  };

  // Auth Handlers
  const handleLogin = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    setError(null);
    try {
      const res = await fetch(`${API_BASE}/login`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password })
      });
      const data = await res.json();
      if (!res.ok) {
        throw new Error(data.message || "Credenciales inválidas");
      }
      localStorage.setItem("token", data.token);
      const fullName = data.user?.fullname || "Usuario";
      localStorage.setItem("user_fullname", fullName);
      setUserFullName(fullName);
      navigate('/challenge');
      fetchPets(data.token);
      Swal.fire({
        title: "¡Bienvenido!",
        text: `Hola, ${fullName}`,
        icon: "success",
        timer: 1500,
        showConfirmButton: false
      });
    } catch (err) {
      Swal.fire("Error", err.message, "error");
      setError(err.message);
    } finally {
      setIsLoading(false);
    }
  };

  const handleLogout = async () => {
    const token = getToken();
    try {
      await fetch(`${API_BASE}/logout`, {
        method: "POST",
        headers: headersWithAuth(token)
      });
    } catch (err) {
      console.error("Error logging out from server", err);
    }
    localStorage.removeItem("token");
    localStorage.removeItem("user_fullname");
    setPets([]);
    setSelectedPet(null);
    navigate('/challenge/login');
  };

  const fetchPets = async (tokenOverride) => {
    setIsLoading(true);
    setError(null);
    const token = tokenOverride || getToken();
    try {
      const res = await fetch(`${API_BASE}/pets/list`, {
        headers: headersWithAuth(token)
      });
      if (!res.ok) {
        throw new Error("No se pudo obtener la lista de mascotas.");
      }
      const data = await res.json();
      setPets(data.pets || []);
      if (params.id && data.pets) {
        const found = data.pets.find((p) => String(p.id) === String(params.id));
        if (found) setSelectedPet(found);
      }
    } catch (err) {
      setError(err.message);
    } finally {
      setIsLoading(false);
    }
  };

  const getPetImageSrc = (petId, imgName, kind) => {
    const localBase64 = petId ? localStorage.getItem(`pet_image_data_${petId}`) : null;
    if (localBase64) return localBase64;

    const normalizedName = (imgName || "").trim();
    if (normalizedName.startsWith("http") || normalizedName.startsWith("data:")) {
      return normalizedName;
    }

    if (normalizedName) {
      return `/assets/images/${normalizedName}`;
    }

    const type = (kind || "dog").toLowerCase();
    if (type === "cat") return IMAGE_MAP["no-cat.jpg"];
    if (type === "horse") return IMAGE_MAP["no-horse.png"];
    if (type === "pig") return IMAGE_MAP["no-pig.jpg"];
    if (type === "cow") return IMAGE_MAP["no-vaca.jpg"];
    if (type === "tiger") return IMAGE_MAP["no-tiger.jpg"];
    return IMAGE_MAP["no-dog.jpg"];
  };

  const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        setTempImageBase64(reader.result);
        setFormData((prev) => ({
          ...prev,
          image: file.name
        }));
      };
      reader.readAsDataURL(file);
    }
  };

  const triggerFilePicker = () => {
    document.getElementById("pet-image-upload-input").click();
  };

  // Add Pet
  const handleAddSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    try {
      const body = {
        name: formData.name,
        kind: formData.kind,
        bread: formData.bread,
        age: parseInt(formData.age) || 0,
        weight: parseFloat(formData.weight) || 0.0,
        location: formData.location,
        description: formData.description,
        image: formData.image || "no-dog.jpg",
        active: 1,
        adopted: 0
      };

      const res = await fetch(`${API_BASE}/pets/store`, {
        method: "POST",
        headers: headersWithAuth(),
        body: JSON.stringify(body)
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || "Error al crear la mascota");

      if (data.pet?.id && tempImageBase64) {
        localStorage.setItem(`pet_image_data_${data.pet.id}`, tempImageBase64);
        setTempImageBase64("");
      }

      Swal.fire("¡Creado!", "Mascota agregada con éxito.", "success");
      fetchPets();
      navigate('/challenge');
    } catch (err) {
      Swal.fire("Error", err.message, "error");
    } finally {
      setIsLoading(false);
    }
  };

  // Edit Pet
  const handleEditSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    try {
      const body = {
        name: formData.name,
        kind: formData.kind,
        bread: formData.bread,
        age: parseInt(formData.age) || 0,
        weight: parseFloat(formData.weight) || 0.0,
        location: formData.location,
        description: formData.description,
        image: formData.image || "no-dog.jpg",
        active: formData.active ? 1 : 0,
        adopted: formData.adopted ? 1 : 0
      };

      const res = await fetch(`${API_BASE}/pets/edit/${selectedPet.id}`, {
        method: "PUT",
        headers: headersWithAuth(),
        body: JSON.stringify(body)
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || "Error al actualizar la mascota");

      // Save image locally
      if (tempImageBase64) {
        localStorage.setItem(`pet_image_data_${selectedPet.id}`, tempImageBase64);
        setTempImageBase64("");
      }

      Swal.fire("¡Actualizado!", "Cambios guardados con éxito.", "success");
      
      const updatedPet = { ...selectedPet, ...body };
      setSelectedPet(updatedPet);
      
      fetchPets();
      navigate(`/challenge/show/${selectedPet.id}`);
    } catch (err) {
      Swal.fire("Error", err.message, "error");
    } finally {
      setIsLoading(false);
    }
  };

  // Delete Pet
  const handleDelete = async (petId) => {
    const result = await Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción no se puede deshacer.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#ff6b6b",
      cancelButtonColor: "#7b9cc0",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar"
    });

    if (!result.isConfirmed) return;

    setIsLoading(true);
    try {
      const res = await fetch(`${API_BASE}/pets/delete/${petId}`, {
        method: "DELETE",
        headers: headersWithAuth()
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || "Error al eliminar la mascota");

      Swal.fire("¡Eliminado!", "La mascota ha sido eliminada.", "success");
      localStorage.removeItem(`pet_extra_${petId}`);
      fetchPets();
      navigate('/challenge');
      setSelectedPet(null);
    } catch (err) {
      Swal.fire("Error", err.message, "error");
    } finally {
      setIsLoading(false);
    }
  };

  const openAddForm = () => {
    setTempImageBase64("");
    setFormData({
      name: "",
      kind: "dog",
      bread: "",
      age: "",
      weight: "",
      location: "",
      description: "",
      image: "no-dog.jpg",
      active: 1,
      adopted: 0
    });
    navigate("/challenge/add");
  };

  const openEditForm = (pet) => {
    setTempImageBase64("");
    const extra = getExtraInfo(pet.id);
    setFormData({
      name: pet.name || "",
      kind: pet.kind || "dog",
      bread: pet.bread || "",
      age: pet.age || "",
      weight: pet.weight || "",
      location: pet.location || "",
      description: pet.description || "",
      image: pet.image || "no-dog.jpg",
      active: pet.active,
      adopted: pet.adopted
    });
    setSelectedPet(pet);
    navigate(`/challenge/edit/${pet.id}`);
  };

  const handleInputChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: type === "checkbox" ? (checked ? 1 : 0) : value
    }));
  };

  return (
    <div className="pets-app-wrapper">
      {/* Back to main examples dashboard */}
      <div className="btn-back-container">
        <Link to="/" className="btn-back-menu">
          <i className="fa fa-arrow-left"></i> Volver al Menú
        </Link>
      </div>

      <div className="mobile-device">

        {screen === "login" && (
          <div className="login-screen">
            <h1 className="brand-title">
              <i className="fa fa-paw"></i> Lara<span className="green">Pets</span>
            </h1>

            <div className="login-dog-img-container">
              <img
                className="login-dog-img"
                src={LOGIN_IMAGE}
                alt="Golden Retriever Welcome"
              />
            </div>

            <div className="login-welcome-text">
              <h2>¡Bienvenido!</h2>
              <p>Inicia sesión para continuar</p>
            </div>

            <form onSubmit={handleLogin} className="login-form">
              <div className="input-container">
                <i className="fa fa-envelope field-icon"></i>
                <input
                  type="email"
                  className="login-input"
                  placeholder="Correo Electrónico"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  required
                />
              </div>

              <div className="input-container">
                <i className="fa fa-lock field-icon"></i>
                <input
                  type={showPassword ? "text" : "password"}
                  className="login-input"
                  placeholder="Contraseña"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required
                />
                <i
                  className={`fa ${showPassword ? "fa-eye-slash" : "fa-eye"} eye-icon`}
                  onClick={() => setShowPassword(!showPassword)}
                ></i>
              </div>

              <button type="submit" className="btn-gradient" disabled={isLoading}>
                {isLoading ? "Iniciando..." : "Iniciar sesión"}
              </button>
            </form>
          </div>
        )}

        {screen === "dashboard" && (
          <div className="screen-scrollable">
            <div className="dashboard-header">
              <div className="welcome-user">
                <h2>Hola, {userFullName.split(" ")[0]}</h2>
                <p>¿Cómo está tu mascota hoy?</p>
              </div>
              <div className="header-actions">
                <button className="btn-action-circle" onClick={openAddForm} title="Agregar Mascota">
                  <i className="fa fa-plus"></i>
                </button>
                <button className="btn-action-circle" onClick={handleLogout} title="Cerrar Sesión">
                  <i className="fa fa-sign-out-alt"></i>
                </button>
              </div>
            </div>

            <div className="stats-row">
              <div className="stat-card blue">
                <div className="stat-icon">
                  <i className="fa fa-paw"></i>
                </div>
                <div className="stat-info">
                  <span className="stat-num">{pets.length}</span>
                  <span className="stat-label">Mascotas</span>
                </div>
              </div>

              <div className="stat-card green">
                <div className="stat-icon">
                  <i className="fa fa-calendar-alt"></i>
                </div>
                <div className="stat-info">
                  <span className="stat-num">04</span>
                  <span className="stat-label">Citas próximas</span>
                </div>
              </div>
            </div>

            <div className="pets-list-section">
              <h3>Mis mascotas</h3>
              {isLoading && <p style={{ color: "#7b9cc0" }}>Cargando mascotas...</p>}
              {error && <p style={{ color: "#ff6b6b" }}>{error}</p>}
              
              <div className="pets-list-container">
                {pets.map((pet) => (
                  <div
                    key={pet.id}
                    className="pet-list-item"
                    onClick={() => {
                      setSelectedPet(pet);
                      navigate(`/challenge/show/${pet.id}`);
                    }}
                  >
                    <div className="pet-list-img-wrapper">
                      <img
                          className="pet-list-img"
                          src={getPetImageSrc(pet.id, pet.image, pet.kind)}
                          alt={pet.name}
                          onError={(e) => { e.currentTarget.onerror = null; e.currentTarget.src = getFallbackImage(pet.kind); }}
                        />
                    </div>
                    <div className="pet-list-details">
                      <div className="pet-list-name-row">
                        <span className="pet-list-name">{pet.name}</span>
                        <span className={pet.active ? "badge-active" : "badge-inactive"}>
                          {pet.active ? "Activo" : "Inactivo"}
                        </span>
                      </div>
                      <span className="pet-list-meta">
                        {pet.bread || pet.kind}
                      </span>
                      <span className="pet-list-meta">
                        {pet.age} años • {pet.weight} lbs
                      </span>
                    </div>
                    <i className="fa fa-chevron-right arrow-right-icon"></i>
                  </div>
                ))}

                {pets.length === 0 && !isLoading && (
                  <p style={{ color: "#7b9cc0", textAlign: "center", marginTop: "20px" }}>
                    No hay mascotas registradas. ¡Agrega una!
                  </p>
                )}
              </div>
            </div>
          </div>
        )}

        {screen === "add" && (
          <div className="screen-scrollable">
              <div className="form-screen-header">
              <button className="btn-back-circle" onClick={() => navigate('/challenge')}> 
                <i className="fa fa-arrow-left"></i>
              </button>
              <h2>Agregar Mascota</h2>
            </div>

            <form onSubmit={handleAddSubmit}>
              <div className="photo-uploader-card" onClick={triggerFilePicker}>
                {tempImageBase64 || formData.image ? (
                  <img
                    className="uploaded-preview-img"
                    src={tempImageBase64 || getPetImageSrc(null, formData.image, formData.kind)}
                    onError={(e) => { e.currentTarget.onerror = null; e.currentTarget.src = getFallbackImage(formData.kind); }}
                    alt="Preview"
                  />
                ) : (
                  <>
                    <i className="fa fa-camera"></i>
                    <span>Agregar Foto JPG o PNG</span>
                  </>
                )}
                <input
                  id="pet-image-upload-input"
                  type="file"
                  accept="image/*"
                  style={{ display: "none" }}
                  onChange={handleFileChange}
                />
              </div>

              <div className="form-inputs-container">
                <div className="form-group">
                  <label>Nombre de tu mascota</label>
                  <input
                    type="text"
                    name="name"
                    className="form-input-field"
                    placeholder="Nombre"
                    value={formData.name}
                    onChange={handleInputChange}
                    required
                  />
                </div>

                <div className="form-group">
                  <label>Tipo de mascota</label>
                  <select
                    name="kind"
                    className="form-input-field"
                    value={formData.kind}
                    onChange={handleInputChange}
                    style={{ background: "#0c1a30", color: "#fff" }}
                  >
                    <option value="dog">Perro</option>
                    <option value="cat">Gato</option>
                    <option value="horse">Caballo</option>
                    <option value="bird">Ave</option>
                    <option value="other">Otro</option>
                  </select>
                </div>

                <div className="form-group">
                  <label>Raza</label>
                  <input
                    type="text"
                    name="bread"
                    className="form-input-field"
                    placeholder="Escribe la raza"
                    value={formData.bread}
                    onChange={handleInputChange}
                  />
                </div>

                <div className="form-row-2">
                  <div className="form-group">
                    <label>Edad (Años)</label>
                    <input
                      type="number"
                      name="age"
                      className="form-input-field"
                      placeholder="Años"
                      value={formData.age}
                      onChange={handleInputChange}
                      required
                    />
                  </div>

                  <div className="form-group">
                    <label>Peso (lbs)</label>
                    <input
                      type="number"
                      step="any"
                      name="weight"
                      className="form-input-field"
                      placeholder="lbs"
                      value={formData.weight}
                      onChange={handleInputChange}
                      required
                    />
                  </div>
                </div>

                <div className="form-group">
                  <label>Ubicación</label>
                  <input
                    type="text"
                    name="location"
                    className="form-input-field"
                    placeholder="Escribe ubicación"
                    value={formData.location}
                    onChange={handleInputChange}
                    required
                  />
                </div>

                <div className="form-group">
                  <label>Descripción</label>
                  <textarea
                    name="description"
                    className="form-input-field"
                    placeholder="Describe a tu mascota..."
                    value={formData.description}
                    onChange={handleInputChange}
                  ></textarea>
                </div>

              </div>

              <button type="submit" className="btn-gradient" style={{ width: "100%", marginBottom: "15px" }}>
                Agregar
              </button>
            </form>
          </div>
        )}

        {screen === "details" && selectedPet && (
          <div className="profile-screen-container" style={{ flex: 1, overflowY: "auto" }}>
            <div className="profile-image-section">
              <div className="profile-top-actions">
                <button className="btn-back-circle" onClick={() => navigate('/challenge')}>
                  <i className="fa fa-arrow-left"></i>
                </button>
              </div>

              <img
                className="profile-pet-img"
                src={getPetImageSrc(selectedPet.id, selectedPet.image, selectedPet.kind)}
                alt={selectedPet.name}
                onError={(e) => { e.currentTarget.onerror = null; e.currentTarget.src = getFallbackImage(selectedPet.kind); }}
              />

              <button className="profile-edit-btn-float" onClick={() => openEditForm(selectedPet)}>
                <i className="fa fa-pencil-alt"></i>
              </button>
            </div>

            <div className="profile-details-section">
              <div className="profile-name-row">
                <h2>{selectedPet.name}</h2>
                <span className="breed">{selectedPet.bread || selectedPet.kind}</span>
                <div className="status-badge-container">
                  <span className={selectedPet.active ? "badge-active" : "badge-inactive"}>
                    {selectedPet.active ? "Activo" : "Inactivo"}
                  </span>
                </div>
              </div>

              <div className="profile-stats-grid">
                <div className="profile-stat-box">
                  <i className="fa fa-birthday-cake"></i>
                  <span className="val">{selectedPet.age} Años</span>
                  <span className="lbl">Edad</span>
                </div>

                <div className="profile-stat-box">
                  <i className="fa fa-weight"></i>
                  <span className="val">{selectedPet.weight} lbs</span>
                  <span className="lbl">Peso</span>
                </div>

                <div className="profile-stat-box">
                  <i className="fa fa-map-marker-alt"></i>
                  <span className="val">{selectedPet.location.split(" ")[0]}</span>
                  <span className="lbl">Ubicación</span>
                </div>
              </div>

              {selectedPet.description && (
                <div className="profile-description-section">
                  <h4>Descripción</h4>
                  <p>{selectedPet.description}</p>
                </div>
              )}


              <div className="profile-delete-row">
                <button className="btn-delete-full" onClick={() => handleDelete(selectedPet.id)}>
                  Eliminar Mascota
                </button>
              </div>
            </div>
          </div>
        )}

        {screen === "edit" && selectedPet && (
          <div className="screen-scrollable">
              <div className="form-screen-header">
              <button className="btn-back-circle" onClick={() => navigate(`/challenge/show/${selectedPet?.id}`)}>
                <i className="fa fa-arrow-left"></i>
              </button>
              <h2>Editar mascota</h2>
            </div>

            <form onSubmit={handleEditSubmit}>
              <div className="edit-photo-circle-container">
                <div className="edit-photo-circle">
                  <img
                    src={tempImageBase64 || getPetImageSrc(selectedPet.id, formData.image, formData.kind)}
                    alt="Current Pet"
                    onError={(e) => { e.currentTarget.onerror = null; e.currentTarget.src = getFallbackImage(formData.kind || selectedPet.kind); }}
                  />
                  <div className="edit-photo-overlay" onClick={triggerFilePicker}>
                    <i className="fa fa-camera"></i>
                  </div>
                </div>
                <input
                  id="pet-image-upload-input"
                  type="file"
                  accept="image/*"
                  style={{ display: "none" }}
                  onChange={handleFileChange}
                />
              </div>

              <div className="form-inputs-container">
                <div className="form-group">
                  <label>Nombre de tu mascota</label>
                  <input
                    type="text"
                    name="name"
                    className="form-input-field"
                    value={formData.name}
                    onChange={handleInputChange}
                    required
                  />
                </div>

                <div className="form-group">
                  <label>Tipo de mascota</label>
                  <select
                    name="kind"
                    className="form-input-field"
                    value={formData.kind}
                    onChange={handleInputChange}
                    style={{ background: "#0c1a30", color: "#fff" }}
                  >
                    <option value="dog">Perro</option>
                    <option value="cat">Gato</option>
                    <option value="horse">Caballo</option>
                    <option value="bird">Ave</option>
                    <option value="other">Otro</option>
                  </select>
                </div>

                <div className="form-group">
                  <label>Raza</label>
                  <input
                    type="text"
                    name="bread"
                    className="form-input-field"
                    value={formData.bread}
                    onChange={handleInputChange}
                  />
                </div>

                <div className="form-row-2">
                  <div className="form-group">
                    <label>Edad (Años)</label>
                    <input
                      type="number"
                      name="age"
                      className="form-input-field"
                      value={formData.age}
                      onChange={handleInputChange}
                      required
                    />
                  </div>

                  <div className="form-group">
                    <label>Peso (lbs)</label>
                    <input
                      type="number"
                      step="any"
                      name="weight"
                      className="form-input-field"
                      value={formData.weight}
                      onChange={handleInputChange}
                      required
                    />
                  </div>
                </div>

                <div className="form-group">
                  <label>Ubicación</label>
                  <input
                    type="text"
                    name="location"
                    className="form-input-field"
                    value={formData.location}
                    onChange={handleInputChange}
                    required
                  />
                </div>

                <div className="form-group">
                  <label>Descripción</label>
                  <textarea
                    name="description"
                    className="form-input-field"
                    value={formData.description}
                    onChange={handleInputChange}
                  ></textarea>
                </div>


                <div style={{ display: "flex", gap: "20px", marginTop: "10px" }}>
                  <label style={{ display: "flex", alignItems: "center", gap: "8px", fontSize: "0.9rem", cursor: "pointer" }}>
                    <input
                      type="checkbox"
                      name="active"
                      checked={formData.active === 1}
                      onChange={handleInputChange}
                    />
                    Mascota Activa
                  </label>

                  <label style={{ display: "flex", alignItems: "center", gap: "8px", fontSize: "0.9rem", cursor: "pointer" }}>
                    <input
                      type="checkbox"
                      name="adopted"
                      checked={formData.adopted === 1}
                      onChange={handleInputChange}
                    />
                    Adoptado
                  </label>
                </div>
              </div>

              <button type="submit" className="btn-gradient" style={{ width: "100%", marginBottom: "15px" }}>
                Guardar Cambios
              </button>
            </form>
          </div>
        )}

      </div>
    </div>
  );
}

export default Challenge;
