<?php if (!$contacto): ?>
    <div class="empty-state" style="background: #f8f9fa; border-radius: 15px; padding: 60px 20px;">
        <div style="font-size: 80px; margin-bottom: 20px;">❌</div>
        <h2 style="color: #e74c3c; margin-bottom: 15px;">Contacto no encontrado</h2>
        <p style="color: #666; font-size: 1.1em;">El contacto que intentas editar no existe o fue eliminado.</p>
        <a href="index.php?action=listar" class="btn" style="margin-top: 20px;">
            Volver al listado
        </a>
    </div>
<?php else: ?>
    <div class="editar-contacto" style="max-width: 600px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="color: #667eea; font-size: 2em; margin-bottom: 10px;">✏️ Editar Contacto</h2>
            <p style="color: #666;">Modifica los datos del contacto</p>
        </div>

        

        <div class="card" style="background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 30px;">
            <form method="POST" action="index.php?action=editar&id=<?= $contacto['id'] ?>">
                <div class="form-group">
                    <label for="nombre" style="color: #333; font-size: 1.1em;">
                        Nombre <span style="color: #e74c3c;">*</span>
                    </label>
                    <input type="text" 
                           id="nombre" 
                           name="nombre" 
                           required
                           value="<?= htmlspecialchars($contacto['nombre']) ?>"
                           placeholder="Ej: Juan Pérez"
                           style="transition: all 0.3s;">
                </div>

                <div class="form-group">
                    <label for="telefono" style="color: #333; font-size: 1.1em;">
                        Teléfono
                    </label>
                    <input type="tel" 
                           id="telefono" 
                           name="telefono"
                           value="<?= htmlspecialchars($contacto['telefono']) ?>"
                           placeholder="Ej: 0981-123-456 o +595981123456"
                           pattern="^(\+595|0)(9[6-9][1-9]|2[1-9]|3[1-9]|4[1-8])\d{6,7}$"
                           title="Formato válido: 0981-123-456, 0981123456, +595981123456"
                           style="transition: all 0.3s;">
                    <small style="color: #666; display: block; margin-top: 5px;">
                        📱 Formatos aceptados: 0981-123-456 | 0981123456 | +595981123456
                    </small>
                </div>

                <div class="form-group">
                    <label for="email" style="color: #333; font-size: 1.1em;">
                        Email
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email"
                           value="<?= htmlspecialchars($contacto['email']) ?>"
                           placeholder="Ej: juan@example.com"
                           style="transition: all 0.3s;">
                    <div id="email-existe-msg" style="color: #dc2626; font-size: 0.95em; margin-top: 4px; display: none;"></div>
                    <?php if (!empty($errores['email'])): ?>
                        <div style="color: #dc2626; font-size: 0.95em; margin-top: 4px;">
                            <?= htmlspecialchars($errores['email']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group" style="margin-bottom: 30px;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" 
                               name="favorito" 
                               <?= $contacto['favorito'] ? 'checked' : '' ?>
                               style="width: 20px; height: 20px;">
                        <span style="font-size: 1.1em;">
                            ⭐ Marcar como favorito
                        </span>
                    </label>
                </div>

                <div style="display: flex; gap: 15px; margin-top: 30px;">
                    <button type="submit" 
                            class="btn" 
                            style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span style="font-size: 1.2em;">💾</span> 
                        Actualizar Contacto
                    </button>
                    <a href="index.php?action=listar" 
                       class="btn" 
                       style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; background: #95a5a6;">
                        <span style="font-size: 1.2em;">↩️</span> 
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Validación del formulario -->
    <script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const nombre = document.getElementById('nombre').value.trim();
        if (nombre === '') {
            e.preventDefault();
            alert('Por favor, ingresa un nombre');
            return false;
        }
        
        const telefono = document.getElementById('telefono').value.trim();
        if (telefono) {
            // Eliminar espacios y guiones para validar
            const telefonoLimpio = telefono.replace(/[\s\-]/g, '');
            
            // Patrones válidos para Paraguay:
            // +595 seguido de código de área y número (9-11 dígitos totales)
            // 0 seguido de código de área y número (9-10 dígitos)
            const patronParaguayo = /^(\+595|0)(9[6-9][1-9]|2[1-9]|3[1-9]|4[1-8])\d{6,7}$/;
            
            if (!patronParaguayo.test(telefonoLimpio)) {
                e.preventDefault();
                alert('📱 Formato de teléfono no válido para Paraguay.\n\n' +
                      'Formatos aceptados:\n' +
                      '• Móvil: 0981-123-456, 0981123456, +595981123456\n' +
                      '• Fijo: 021-123-456, 021123456, +59521123456\n\n' +
                      'Códigos de área válidos:\n' +
                      '• Móvil: 096x-099x\n' +
                      '• Fijo: 021-048 (según ciudad)');
                return false;
            }
        }
        
        const email = document.getElementById('email').value.trim();
        if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            e.preventDefault();
            alert('Por favor, ingresa un email válido');
            return false;
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email');
        const emailMsg = document.getElementById('email-existe-msg');
        const contactoId = "<?= isset($contacto['id']) ? $contacto['id'] : '' ?>";
        emailInput.addEventListener('input', function() {
            const email = emailInput.value.trim();
            if (email.length < 5) {
                emailMsg.style.display = 'none';
                return;
            }
            let body = 'email=' + encodeURIComponent(email);
            if (contactoId) {
                body += '&excluirId=' + encodeURIComponent(contactoId);
            }
            fetch('verificar_email.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body
            })
            .then(res => res.json())
            .then(data => {
                if (data.existe) {
                    emailMsg.textContent = 'Este email ya está registrado en otro contacto';
                    emailMsg.style.display = 'block';
                } else {
                    emailMsg.textContent = '';
                    emailMsg.style.display = 'none';
                }
            });
        });
    });
    </script>
<?php endif; ?>