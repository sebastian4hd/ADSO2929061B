<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles - <?= htmlspecialchars($data['pokemon']['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col">
            <div class="text-center mb-4">
                <h1 class="text-5xl font-bold">Detalles del Pokemon</h1>
                <p class="py-2">Información completa de <?= htmlspecialchars($data['pokemon']['name']) ?></p>
            </div>
            <div class="card bg-base-100 w-full max-w-lg shadow-2xl">
                <div class="card-body">
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="label">
                                    <span class="label-text font-bold">ID:</span>
                                </label>
                                <div class="text-lg"><?= htmlspecialchars($data['pokemon']['id']) ?></div>
                            </div>
                            
                            <div>
                                <label class="label">
                                    <span class="label-text font-bold">Nombre:</span>
                                </label>
                                <div class="text-lg"><?= htmlspecialchars($data['pokemon']['name']) ?></div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="label">
                                    <span class="label-text font-bold">Tipo:</span>
                                </label>
                                <div>
                                    <?php 
                                    $typeColors = [
                                        'Water' => 'badge-info',
                                        'Grass' => 'badge-success',
                                        'Fire' => 'badge-error',
                                        'Electric' => 'badge-warning',
                                        'Normal' => 'badge-secondary',
                                        'Poison' => 'badge-primary',
                                        'Ghost' => 'badge-accent',
                                        'Dragon' => 'badge-secondary',
                                        'Rock' => 'badge-neutral'
                                    ];
                                    $badgeClass = $typeColors[$data['pokemon']['type']] ?? 'badge-ghost';
                                    
                                    $typeEmojis = [
                                        'Water' => '💧',
                                        'Grass' => '🌿',
                                        'Fire' => '🔥',
                                        'Electric' => '⚡',
                                        'Normal' => '⭐',
                                        'Poison' => '☠️',
                                        'Ghost' => '👻',
                                        'Dragon' => '🐉',
                                        'Rock' => '🪨'
                                    ];
                                    $emoji = $typeEmojis[$data['pokemon']['type']] ?? '❓';
                                    ?>
                                    <span class="badge <?= $badgeClass ?> badge-lg">
                                        <?= $emoji ?> <?= htmlspecialchars($data['pokemon']['type']) ?>
                                    </span>
                                </div>
                            </div>

                            <div>
                                <label class="label">
                                    <span class="label-text font-bold">Entrenador:</span>
                                </label>
                                <div>
                                    <?php if ($data['pokemon']['trainer_name']): ?>
                                        <a href="<?= $data['url'] ?>trainer/<?= $data['pokemon']['trainer_id'] ?>" class="badge badge-outline badge-lg">
                                            <?= htmlspecialchars($data['pokemon']['trainer_name']) ?>
                                        </a>
                                        <div class="text-xs text-gray-500 mt-1">Nivel: <?= htmlspecialchars($data['pokemon']['trainer_level']) ?></div>
                                    <?php else: ?>
                                        <span class="text-gray-400">Sin entrenador</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="divider">Estadísticas</div>

                    <div class="space-y-3">
                        <!-- Strength -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-bold">⚔️ Strength</span>
                                <span class="text-sm font-bold"><?= htmlspecialchars($data['pokemon']['strength']) ?>/1500</span>
                            </div>
                            <progress class="progress progress-error w-full" value="<?= htmlspecialchars($data['pokemon']['strength']) ?>" max="1500"></progress>
                        </div>

                        <!-- Stamina -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-bold">❤️ Stamina</span>
                                <span class="text-sm font-bold"><?= htmlspecialchars($data['pokemon']['staming']) ?>/320</span>
                            </div>
                            <progress class="progress progress-success w-full" value="<?= htmlspecialchars($data['pokemon']['staming']) ?>" max="320"></progress>
                        </div>

                        <!-- Speed -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-bold">⚡ Speed</span>
                                <span class="text-sm font-bold"><?= htmlspecialchars($data['pokemon']['speed']) ?>/120</span>
                            </div>
                            <progress class="progress progress-warning w-full" value="<?= htmlspecialchars($data['pokemon']['speed']) ?>" max="120"></progress>
                        </div>

                        <!-- Accuracy -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-bold">🎯 Accuracy</span>
                                <span class="text-sm font-bold"><?= htmlspecialchars($data['pokemon']['accuracy']) ?>/232</span>
                            </div>
                            <progress class="progress progress-info w-full" value="<?= htmlspecialchars($data['pokemon']['accuracy']) ?>" max="232"></progress>
                        </div>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <div class="card-actions justify-center">
                        <a href="<?= $data['url'] ?>edit/<?= $data['pokemon']['id'] ?>" class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M227.32,73.37,182.63,28.69a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31l83.67-83.66,3.48,13.9-36.8,36.79a8,8,0,0,0,11.31,11.32l40-40a8,8,0,0,0,2.11-7.6l-6.9-27.61L227.32,96A16,16,0,0,0,227.32,73.37ZM48,179.31,76.69,208H48Zm48,25.38L51.31,160,136,75.31,180.69,120Zm96-96L147.32,64l24-24L216,84.69Z"></path>
                            </svg>
                            Editar
                        </a>
                        <a href="<?= $data['url'] ?>delete/<?= $data['pokemon']['id'] ?>" class="btn btn-error">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                            </svg>
                            Eliminar
                        </a>
                    </div>
                    
                    <a href="<?= $data['url'] ?>" class="btn btn-ghost mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
                        </svg>
                        Volver a la Lista
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>