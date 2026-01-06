
    <!-- Encabezado -->
    <div class="header">
        <h1>👋 Hola, <?= $_SESSION['usuario_nombre']; ?> </h1>
        <a class="logout-btn" href="../../controllers/logout.php">🔒 Cerrar sesión</a>
    </div>

    <!-- Contenedor principal -->
    <div class="container">
        <h2>✅ Mis Tareas</h2>

        <!-- Herramientas de búsqueda y filtrado -->
        <div class="toolbar">
            <input type="text" id="buscar" placeholder="🔎 Buscar tarea...">
            <select id="ordenar">
                <option value="recientes">📅 Más recientes</option>
                <option value="antiguas">📅 Más antiguas</option>
            </select>
            <button onclick="location.href='agregar.php'">➕ Nueva Tarea</button>
        </div>

        <!-- Sección de tareas pendientes -->
        <div class="tasks-section">
            <h3>📌 Pendientes</h3>
            <div class="tasks-list">
                <?php foreach ($tareas as $tarea): ?>
                    <?php if ($tarea['estado'] === "pendiente"): ?>
                        <div class="task-card">
                            <span class="task-title">📝 <?= $tarea['titulo']; ?></span>
                            <div class="task-actions">
                                <a class="complete-btn" href="completar.php?id=<?= $tarea['id'] ?>">✅</a>
                                <a class="delete-btn" href="eliminar.php?id=<?= $tarea['id'] ?>">❌</a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Sección de tareas completadas -->
        <div class="tasks-section">
            <h3>🎯 Completadas</h3>
            <div class="tasks-list">
                <?php foreach ($tareas as $tarea): ?>
                    <?php if ($tarea['estado'] === "completado"): ?>
                        <div class="task-card completed">
                            <span class="task-title">✅ <?= $tarea['titulo']; ?></span>
                            <div class="task-actions">
                                <a class="reopen-btn" href="reabrir.php?id=<?= $tarea['id'] ?>">🔄</a>
                                <a class="delete-btn" href="eliminar.php?id=<?= $tarea['id'] ?>">❌</a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


