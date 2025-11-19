<div class="lista-contactos">
    <!-- Barra superior con búsqueda y botón de nuevo contacto -->
    <div class="acciones-principales" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; max-width: 1200px; margin: 0 auto 20px auto;">
        <form method="GET" action="index.php" class="search-box" style="flex: 1; margin: 0 20px 0 0;">
            <input type="hidden" name="action" value="listar">
            <div style="position: relative; width: 100%;">
                <input type="text" 
                       name="q" 
                       placeholder="🔍 Buscar contactos..." 
                       value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
                       style="padding-left: 40px; width: 100%;">
                <button type="submit" class="btn btn-search" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); padding: 8px 20px;">
                    Buscar
                </button>
            </div>
        </form>
        <a href="index.php?action=crear" class="btn btn-new" style="white-space: nowrap;">
            Nuevo Contacto
        </a>
    </div>

    <?php if (empty($contactos)): ?>
        <div class="empty-state" style="background: #f8f9fa; border-radius: 15px; padding: 60px 20px;">
            <div style="font-size: 80px; margin-bottom: 20px;">📭</div>
            <h2 style="color: #667eea; margin-bottom: 15px;">No hay contactos</h2>
            <p style="color: #666; font-size: 1.1em;">Tu agenda está vacía. ¡Comienza agregando tu primer contacto!</p>
            <a href="index.php?action=crear" class="btn" style="margin-top: 20px;">
                Agregar Contacto
            </a>
        </div>
    <?php else: ?>
        <div class="acciones-multiples" style="display: flex; justify-content: flex-start; align-items: center; margin-bottom: 1rem;">
            <a href="index.php?action=vaciarLista" 
               class="btn btn-danger" 
               style="background: var(--danger-color);"
               onclick="return confirm('¿Estás seguro de que deseas eliminar TODOS los contactos? Esta acción no se puede deshacer.')">
                🗑️ Eliminar Todo
            </a>
        </div>

        <div class="table-responsive" style="background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); min-height: calc(100vh - 500px); max-width: 1200px; margin: 0 auto;">
            <table style="margin: 0; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">⭐</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th style="text-align: right; padding-right: 20px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contactos as $c): ?>
                    <tr style="transition: all 0.3s;">
                        <td style="text-align: center;">
                            <a href="index.php?action=toggleFavorito&id=<?= $c['id'] ?>" 
                               class="favorito-icon" 
                               title="<?= $c['favorito'] ? 'Quitar de favoritos' : 'Agregar a favoritos' ?>"
                               style="color: <?= $c['favorito'] ? '#ffd700' : '#ccc' ?>;">
                                <?= $c['favorito'] ? '⭐' : '☆' ?>
                            </a>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <input type="checkbox" 
                                       style="width: 18px; height: 18px; cursor: pointer;">
                                <strong style="font-size: 1.1em; color: #333;">
                                    <?= htmlspecialchars($c['nombre']) ?>
                                </strong>
                            </div>
                        </td>
                        <td>
                            <span style="color: #666;">
                                <?= htmlspecialchars($c['telefono']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="mailto:<?= htmlspecialchars($c['email']) ?>" 
                               style="color: #667eea; text-decoration: none;">
                                <?= htmlspecialchars($c['email']) ?>
                            </a>
                        </td>
                        <td class="actions" style="text-align: right;">
                            <div class="action-buttons" style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="index.php?action=editar&id=<?= $c['id'] ?>" 
                                   class="btn btn-small" 
                                   title="Editar contacto"
                                   style="background: var(--primary-color);">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?action=eliminar&id=<?= $c['id'] ?>" 
                                   class="btn btn-small btn-danger" 
                                   onclick="return confirm('¿Estás seguro de que deseas eliminar este contacto?')"
                                   title="Eliminar contacto"
                                   style="background: var(--danger-color);">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
