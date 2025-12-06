<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col">
            <div class="text-center mb-4">
                <h1 class="text-5xl font-bold">Agregar Pokemon</h1>
                <p class="py-2">Registra un nuevo Pokemon en la base de datos</p>
            </div>
            <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
                <form class="card-body" method="POST" action="<?= $data['url'] ?>store">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nombre del Pokemon</span>
                        </label>
                        <input type="text" name="name" placeholder="Ej: Pikachu" class="input input-bordered" required autofocus />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Tipo</span>
                        </label>
                        <select name="type" class="select select-bordered" required>
                            <option disabled selected>Selecciona un tipo</option>
                            <option value="Water">💧 Water</option>
                            <option value="Grass">🌿 Grass</option>
                            <option value="Fire">🔥 Fire</option>
                            <option value="Electric">⚡ Electric</option>
                            <option value="Normal">⭐ Normal</option>
                            <option value="Poison">☠️ Poison</option>
                            <option value="Ghost">👻 Ghost</option>
                            <option value="Dragon">🐉 Dragon</option>
                            <option value="Rock">🪨 Rock</option>
                            <option value="Fighting">🥊 Fighting</option>
                            <option value="Psychic">🔮 Psychic</option>
                            <option value="Ice">❄️ Ice</option>
                        </select>
                    </div>
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path>
                            </svg>
                            Guardar Pokemon
                        </button>
                    </div>
                    <div class="form-control">
                        <a href="<?= $data['url'] ?>" class="btn btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
                            </svg>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>