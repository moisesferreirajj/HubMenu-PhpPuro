document.addEventListener('DOMContentLoaded', function() {
    carregarEstabelecimentos();
});

function carregarEstabelecimentos() {
    const containerEstabelecimentos = document.getElementById('estabelecimentos-container');

    if (containerEstabelecimentos) {
        containerEstabelecimentos.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
                <p class="mt-2">Carregando estabelecimentos...</p>
            </div>
        `;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/api/visualizar/estabelecimentos', true);

    xhr.onload = function () {
        if (this.status === 200) {
            try {
                const response = JSON.parse(this.responseText);

                if (response && response.estabelecimentos && response.estabelecimentos.results) {
                    const estabelecimentos = response.estabelecimentos.results.sort((a, b) => {
                        return parseFloat(b.media_avaliacao) - parseFloat(a.media_avaliacao);
                    });

                    const melhoresEstabelecimentos = estabelecimentos.slice(0, 3);
                    renderizarEstabelecimentos(melhoresEstabelecimentos, containerEstabelecimentos);
                } else {
                    exibirErro('Não foram encontrados estabelecimentos', containerEstabelecimentos);
                }
            } catch (e) {
                exibirErro('Erro ao processar os dados: ' + e.message, containerEstabelecimentos);
            }
        } else {
            exibirErro('Erro ao buscar estabelecimentos: ' + this.status, containerEstabelecimentos);
        }
    };

    xhr.onerror = function () {
        exibirErro('Falha na conexão com o servidor', containerEstabelecimentos);
    };

    xhr.send();
}

function renderizarEstabelecimentos(estabelecimentos, container) {
    if (!estabelecimentos || estabelecimentos.length === 0) {
        container.innerHTML = `
            <div class="col-12 text-center">
                <p>Não foram encontrados estabelecimentos no momento.</p>
            </div>
        `;
        return;
    }

    container.innerHTML = '';

    estabelecimentos.forEach(estabelecimento => {
        const card = document.createElement('div');
        card.className = 'col-md-4';

        const tempoEntrega = estabelecimento.tempo_entrega || '30-45 min';
        const valorEntrega = estabelecimento.valor_entrega
            ? 'R$ ' + Number(estabelecimento.valor_entrega).toFixed(2).replace('.', ',')
            : 'Grátis';

        card.innerHTML = `
            <div class="card restaurant-card h-100">
                <img src="${estabelecimento.imagem || 'https://via.placeholder.com/300x150'}" 
                    class="card-img-top fixed-img" alt="${estabelecimento.nome}">
                <div class="card-body">
                    <h5 class="card-title">${estabelecimento.nome}</h5>
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-success me-2">
                            <i class="fas fa-star"></i> ${Number(estabelecimento.media_avaliacao).toFixed(1)}
                        </span>
                        <span class="text-muted small">${estabelecimento.tipo || 'Restaurante'}</span>
                    </div>
                    <p class="card-text small text-muted">
                        <i class="fas fa-clock me-1"></i> ${tempoEntrega}
                        <span class="mx-2">•</span>
                        <i class="fas fa-motorcycle me-1"></i> ${valorEntrega}
                    </p>
                </div>
            </div>
        `;

        container.appendChild(card);
    });

    const cards = container.querySelectorAll('.col-md-4');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100 * index);
    });
}

function exibirErro(mensagem, container) {
    container.innerHTML = `
        <div class="col-12 text-center">
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                ${mensagem}
            </div>
            <button class="btn btn-primary mt-3" onclick="carregarEstabelecimentos()">
                <i class="fas fa-sync-alt me-2"></i> Tentar novamente
            </button>
        </div>
    `;
}