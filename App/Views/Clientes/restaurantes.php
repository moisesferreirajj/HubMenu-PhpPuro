<?php

@require_once __DIR__ . '/../../global.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurantes - <?= $Title ?? 'HubMenu' ?> Delivery de Comida</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Customizado -->
    <link rel="stylesheet" href="/Views/Assets/CSS/Clientes/dash.css">

    <style>
        :root {
            --primary: #0e7a56;
            --secondary: #006747;
            --accent: #ff4500;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #ffffff;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 4rem 0 2rem;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        /* Search and Filter Bar */
        .search-filter-bar {
            background: white;
            padding: 2rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .search-box {
            position: relative;
            margin-bottom: 1rem;
        }

        .search-box input {
            border-radius: 50px;
            padding: 0.75rem 3rem 0.75rem 1.5rem;
            border: 2px solid #e9ecef;
            font-size: 1rem;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(14, 122, 86, 0.25);
        }

        .search-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        .filter-btn {
            border: 2px solid #e9ecef;
            background: white;
            color: #495057;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .filter-btn:hover,
        .filter-btn.active {
            border-color: var(--primary);
            background: var(--primary);
            color: white;
        }

        /* Restaurant Cards */
        .restaurants-section {
            padding: 3rem 0;
            background-color: var(--light-gray);
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .section-header p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .restaurant-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            height: 100%;
            cursor: pointer;
        }

        .restaurant-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .restaurant-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            position: relative;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.7));
        }

        .restaurant-info {
            padding: 1.5rem;
        }

        .restaurant-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .restaurant-category {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .restaurant-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .rating {
            display: flex;
            align-items: center;
            background: var(--primary);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .rating i {
            margin-right: 0.3rem;
        }

        .delivery-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .delivery-info span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* Loading and Error States */
        .loading-spinner {
            text-align: center;
            padding: 3rem;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: var(--primary);
        }

        .error-message {
            text-align: center;
            padding: 3rem;
        }

        .error-message .alert {
            max-width: 500px;
            margin: 0 auto;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        .pagination .page-link {
            border-radius: 50px;
            margin: 0 0.2rem;
            border: 2px solid #e9ecef;
            color: var(--dark-gray);
        }

        .pagination .page-link:hover,
        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section p {
                font-size: 1rem;
            }

            .search-filter-bar {
                padding: 1.5rem 0;
            }

            .filter-buttons {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }

            .filter-btn {
                white-space: nowrap;
                flex-shrink: 0;
            }

            .restaurant-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }

        /* Animation for cards */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* No results state */
        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--dark-gray);
        }

        .no-results i {
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .no-results h4 {
            color: var(--dark-gray);
            margin-bottom: 1rem;
        }

        .no-results p {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../Components/navigation-clientes.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Descubra Sabores Incríveis</h1>
            <p>Explore todos os restaurantes parceiros e encontre sua próxima refeição favorita</p>
        </div>
    </section>

    <!-- Search and Filter Bar -->
    <section class="search-filter-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Buscar restaurantes, pratos ou tipos de comida..." id="searchInput">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="filter-buttons">
                        <button class="filter-btn active" data-filter="all">Todos</button>
                        <button class="filter-btn" data-filter="restaurante">Restaurantes</button>
                        <button class="filter-btn" data-filter="pizzaria">Pizzarias</button>
                        <button class="filter-btn" data-filter="hamburgueria">Hamburguerias</button>
                        <button class="filter-btn" data-filter="lanchonete">Lanchonetes</button>
                        <button class="filter-btn" data-filter="sushi">Sushi Bar</button>
                        <button class="filter-btn" data-filter="rating">Melhor Avaliados</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Restaurants Section -->
    <section class="restaurants-section">
        <div class="container">
            <div class="section-header">
                <h2>Todos os Restaurantes</h2>
                <p id="results-count">Carregando estabelecimentos...</p>
            </div>

            <div class="row g-4" id="restaurants-container">
                <!-- Loading Spinner -->
                <div class="col-12 loading-spinner">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <p class="mt-3">Carregando restaurantes...</p>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper" id="pagination-container" style="display: none;">
                <nav>
                    <ul class="pagination" id="pagination">
                        <!-- Pagination items will be generated here -->
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">HubMenu</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Sobre nós</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Carreiras</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Blog</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Contato</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Para Restaurantes</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Cadastre seu Restaurante</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Entregadores</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Planos para Parceiros</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Para Você</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Restaurantes próximos</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Pizzarias</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Hamburguerias</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">HubMenu Card</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Redes Sociais</h5>
                    <div class="d-flex gap-3 fs-4">
                        <a href="#" class="text-white-50"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-white-50">&copy; <?= date('Y') ?> HubMenu | Todos os direitos reservados</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let allRestaurants = [];
        let filteredRestaurants = [];
        let currentPage = 1;
        const itemsPerPage = 12;
        let currentFilter = 'all';
        let searchTerm = '';

        document.addEventListener('DOMContentLoaded', function() {
            loadRestaurants();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', debounce(handleSearch, 300));

            // Filter buttons
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(button => {
                button.addEventListener('click', handleFilter);
            });
        }

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function loadRestaurants() {
            const container = document.getElementById('restaurants-container');
            
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/visualizar/estabelecimentos', true);

            xhr.onload = function () {
                if (this.status === 200) {
                    try {
                        const response = JSON.parse(this.responseText);

                        if (response && response.estabelecimentos && response.estabelecimentos.results) {
                            allRestaurants = response.estabelecimentos.results;
                            filteredRestaurants = [...allRestaurants];
                            displayRestaurants();
                            updateResultsCount();
                        } else {
                            showError('Não foram encontrados estabelecimentos');
                        }
                    } catch (e) {
                        showError('Erro ao processar os dados: ' + e.message);
                    }
                } else {
                    showError('Erro ao buscar estabelecimentos: ' + this.status);
                }
            };

            xhr.onerror = function () {
                showError('Falha na conexão com o servidor');
            };

            xhr.send();
        }

        function handleSearch(event) {
            searchTerm = event.target.value.toLowerCase();
            applyFilters();
        }

        function handleFilter(event) {
            // Update active filter button
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            currentFilter = event.target.getAttribute('data-filter');
            currentPage = 1;
            applyFilters();
        }

        function applyFilters() {
            filteredRestaurants = allRestaurants.filter(restaurant => {
                // Search filter
                const matchesSearch = !searchTerm || 
                    restaurant.nome.toLowerCase().includes(searchTerm) ||
                    (restaurant.tipo && restaurant.tipo.toLowerCase().includes(searchTerm));

                // Category filter
                let matchesCategory = true;
                if (currentFilter !== 'all') {
                    if (currentFilter === 'rating') {
                        matchesCategory = parseFloat(restaurant.media_avaliacao) >= 4.0;
                    } else {
                        matchesCategory = restaurant.tipo && 
                            restaurant.tipo.toLowerCase().includes(currentFilter.toLowerCase());
                    }
                }

                return matchesSearch && matchesCategory;
            });

            // Sort by rating for better results
            if (currentFilter === 'rating') {
                filteredRestaurants.sort((a, b) => 
                    parseFloat(b.media_avaliacao) - parseFloat(a.media_avaliacao)
                );
            }

            currentPage = 1;
            displayRestaurants();
            updateResultsCount();
        }

        function displayRestaurants() {
            const container = document.getElementById('restaurants-container');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const restaurantsToShow = filteredRestaurants.slice(startIndex, endIndex);

            if (restaurantsToShow.length === 0) {
                container.innerHTML = `
                    <div class="col-12 no-results">
                        <i class="fas fa-search fa-3x"></i>
                        <h4>Nenhum restaurante encontrado</h4>
                        <p>Tente ajustar seus filtros ou termo de busca</p>
                    </div>
                `;
                document.getElementById('pagination-container').style.display = 'none';
                return;
            }

            container.innerHTML = '';

            restaurantsToShow.forEach((restaurant, index) => {
                const card = createRestaurantCard(restaurant);
                card.classList.add('fade-in');
                container.appendChild(card);

                // Animate card appearance
                setTimeout(() => {
                    card.classList.add('visible');
                }, 100 * index);
            });

            setupPagination();
        }

        function createRestaurantCard(restaurant) {
            const col = document.createElement('div');
            col.className = 'col-lg-4 col-md-6';

            const tempoEntrega = restaurant.tempo_entrega || '30-45 min';
            const valorEntrega = restaurant.valor_entrega
                ? 'R$ ' + Number(restaurant.valor_entrega).toFixed(2).replace('.', ',')
                : 'Grátis';

            const rating = Number(restaurant.media_avaliacao).toFixed(1);
            const imageUrl = restaurant.imagem || 'https://via.placeholder.com/400x200/f8f9fa/6c757d?text=Sem+Imagem';

            col.innerHTML = `
                <div class="restaurant-card" onclick="viewRestaurant('${restaurant.id}')">
                    <div style="position: relative;">
                        <img src="${imageUrl}" class="restaurant-image" alt="${restaurant.nome}">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="restaurant-info">
                        <h3 class="restaurant-name">${restaurant.nome}</h3>
                        <p class="restaurant-category">${restaurant.tipo || 'Restaurante'}</p>
                        
                        <div class="restaurant-meta">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                ${rating}
                            </div>
                            <div class="delivery-info">
                                <span>
                                    <i class="fas fa-clock"></i>
                                    ${tempoEntrega}
                                </span>
                            </div>
                        </div>
                        
                        <div class="delivery-info">
                            <span>
                                <i class="fas fa-motorcycle"></i>
                                Entrega: ${valorEntrega}
                            </span>
                        </div>
                    </div>
                </div>
            `;

            return col;
        }

        function setupPagination() {
            const totalPages = Math.ceil(filteredRestaurants.length / itemsPerPage);
            const paginationContainer = document.getElementById('pagination-container');
            const pagination = document.getElementById('pagination');

            if (totalPages <= 1) {
                paginationContainer.style.display = 'none';
                return;
            }

            paginationContainer.style.display = 'block';
            pagination.innerHTML = '';

            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Anterior</a>`;
            pagination.appendChild(prevLi);

            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);

            for (let i = startPage; i <= endPage; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                pagination.appendChild(li);
            }

            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Próximo</a>`;
            pagination.appendChild(nextLi);
        }

        function changePage(page) {
            const totalPages = Math.ceil(filteredRestaurants.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                displayRestaurants();
                
                // Scroll to top of restaurants section
                document.querySelector('.restaurants-section').scrollIntoView({ 
                    behavior: 'smooth' 
                });
            }
        }

        function updateResultsCount() {
            const resultsCount = document.getElementById('results-count');
            const total = filteredRestaurants.length;
            
            if (total === 0) {
                resultsCount.textContent = 'Nenhum restaurante encontrado';
            } else if (total === 1) {
                resultsCount.textContent = '1 restaurante encontrado';
            } else {
                resultsCount.textContent = `${total} restaurantes encontrados`;
            }
        }

        function viewRestaurant(restaurantId) {
            // Redirect to restaurant detail page
            window.location.href = `/cardapio/${restaurantId}`;
        }

        function showError(message) {
            const container = document.getElementById('restaurants-container');
            container.innerHTML = `
                <div class="col-12 error-message">
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        ${message}
                    </div>
                    <button class="btn btn-primary mt-3" onclick="loadRestaurants()">
                        <i class="fas fa-sync-alt me-2"></i> Tentar novamente
                    </button>
                </div>
            `;
            
            const resultsCount = document.getElementById('results-count');
            resultsCount.textContent = 'Erro ao carregar restaurantes';
        }
    </script>
</body>

</html>