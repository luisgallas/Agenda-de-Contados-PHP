<div class="crear-contacto" style="max-width: 600px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="color: var(--primary-color); font-size: 2em; margin-bottom: 10px;">Nuevo Contacto</h2>
        <p style="color: var(--text-secondary);">Ingresa los datos del nuevo contacto</p>
    </div>

    <div class="card form-container" style="background: var(--background-card); border-radius: 15px; box-shadow: var(--shadow); padding: 30px;">
        <form method="POST" action="index.php?action=crear">
            <div class="form-group">
                <label for="nombre" style="color: var(--text-primary); font-size: 1.1em;">
                    Nombre <span style="color: #e74c3c;">*</span>
                </label>
                <input type="text" 
                       id="nombre" 
                       name="nombre" 
                       required
                       placeholder="Ej: Juan Pérez"
                       style="transition: all 0.3s;">
            </div>

            <div class="form-group">
                <label for="telefono" style="color: var(--text-primary); font-size: 1.1em;">
                    Teléfono
                </label>
                <input type="tel" 
                       id="telefono" 
                       name="telefono"
                       placeholder="Ej: 0981-123-456 o +595981123456"
                       pattern="^(\+595|0)(9[6-9][1-9]|2[1-9]|3[1-9]|4[1-8])\d{6,7}$"
                       title="Formato válido: 0981-123-456, 0981123456, +595981123456"
                       style="transition: all 0.3s;">
                <small style="color: var(--text-secondary); display: block; margin-top: 5px;">
                    📱 Formatos aceptados: 0981-123-456 | 0981123456 | +595981123456
                </small>
            </div>

            <div class="form-group">
                <label for="email" style="color: var(--text-primary); font-size: 1.1em;">
                    Email
                </label>
                <input type="email" 
                       id="email" 
                       name="email"
                       value="<?= htmlspecialchars($contacto['email'] ?? '') ?>"
                       placeholder="Ej: juan@example.com"
                       style="transition: all 0.3s;">
                <div id="email-existe-msg" style="color: #dc2626; font-size: 0.95em; margin-top: 4px; display: none;"></div>
                <?php if (!empty($errores['email'])): ?>
                    <div style="color: #dc2626; font-size: 0.95em; margin-top: 4px;">
                        <?= htmlspecialchars($errores['email']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 30px;">
                <button type="submit" 
                        class="btn btn-save" 
                        style="flex: 1; display: flex; align-items: center; justify-content: center;">
                    Guardar Contacto
                </button>
                <a href="index.php?action=listar" 
                   class="btn btn-cancel" 
                   style="flex: 1; display: flex; align-items: center; justify-content: center;">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Validación del formulario -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const emailMsg = document.getElementById('email-existe-msg');
    emailInput.addEventListener('input', function() {
        const email = emailInput.value.trim();
        if (email.length < 5) {
            emailMsg.style.display = 'none';
            return;
        }
        fetch('verificar_email.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'email=' + encodeURIComponent(email)
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