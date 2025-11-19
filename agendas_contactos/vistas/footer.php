</div> <!-- container -->
<footer class="footer" style="
    background: var(--background-light);
    padding: 2rem 0;
    margin-top: 3rem;
    text-align: center;
    position: relative;
    overflow: hidden;
">
    <div style="
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 1;
    ">
        <div style="
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            align-items: center;
            color: var(--text-secondary);
        ">
            <div style="font-weight: 500;" id="footer-info">Ingeniería en Informática – SPD</div>
            <div id="copyright" style="font-size: 0.875rem;"></div>
        </div>
        
        <div style="
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        ">
            <a href="#" class="social-link" style="
                color: var(--text-secondary);
                text-decoration: none;
                transition: color 0.2s ease;
            ">
                <i class="fab fa-github"></i>
            </a>
            <a href="#" class="social-link" style="
                color: var(--text-secondary);
                text-decoration: none;
                transition: color 0.2s ease;
            ">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
    </div>
</footer>

<script>
    // Función para actualizar el año dinámicamente
    function actualizarAño() {
        const año = new Date().getFullYear();
        document.getElementById('copyright').innerText = `© ${año}`;
    }

    // Función para actualizar la información del footer
    function actualizarFooterInfo() {
        const footerInfo = document.getElementById('footer-info');
        const textoBase = "Ingeniería en Informática – SPD";
        footerInfo.innerHTML = `${textoBase} <span style="white-space: nowrap;">© ${new Date().getFullYear()}</span>`;
    }

    // Hover effects para social links
    document.querySelectorAll('.social-link').forEach(link => {
        link.addEventListener('mouseover', function() {
            this.style.color = 'var(--primary-color)';
            this.style.transform = 'scale(1.1)';
        });
        link.addEventListener('mouseout', function() {
            this.style.color = 'var(--text-secondary)';
            this.style.transform = 'scale(1)';
        });
    });

    // Inicializar
    document.addEventListener('DOMContentLoaded', function() {
        actualizarFooterInfo();
        
        // Actualizar cada minuto (por si el usuario mantiene la página abierta durante el cambio de año)
        setInterval(actualizarFooterInfo, 60000);
    });
</script>
</body>
</html>
