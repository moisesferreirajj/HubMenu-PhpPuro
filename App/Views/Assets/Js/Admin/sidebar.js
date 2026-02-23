document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        initSidebar();
    }, 150);
});

function initSidebar() {
    const sidebar = document.getElementById('sidebar');
    const btnToggle = document.getElementById('btnToggle');
    const mainContent = document.querySelector('.main-content');
    
    if (!sidebar || !btnToggle) {
        return; // Sai se não encontrar os elementos
    }
    
    // Criar overlay para mobile
    let overlay = document.querySelector('.sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);
    }
    
    // Função para detectar mobile
    function isMobile() {
        return window.innerWidth <= 768;
    }
    
    // Função principal do toggle
    function toggleSidebar() {
        if (isMobile()) {
            // Mobile: mostrar/esconder
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
            
            if (sidebar.classList.contains('show')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        } else {
            // Desktop: colapsar/expandir
            sidebar.classList.toggle('collapsed');
            if (mainContent) {
                mainContent.classList.toggle('expanded');
            }
        }
    }
    
    // Event listener do botão
    btnToggle.addEventListener('click', function(e) {
        e.preventDefault();
        toggleSidebar();
    });
    
    // Fechar ao clicar no overlay
    overlay.addEventListener('click', function() {
        if (isMobile()) {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
    
    // Fechar ao clicar em link no mobile
    const navLinks = sidebar.querySelectorAll('.nav-link');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (isMobile() && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }
        });
    });
    
    // Ajustar ao redimensionar
    window.addEventListener('resize', function() {
        if (!isMobile()) {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        } else {
            sidebar.classList.remove('collapsed');
            if (mainContent) {
                mainContent.classList.remove('expanded');
            }
        }
    });
    
    // Adicionar tooltips para sidebar colapsado
    navLinks.forEach(function(link) {
        const span = link.querySelector('span');
        if (span) {
            link.setAttribute('data-tooltip', span.textContent.trim());
        }
    });
}