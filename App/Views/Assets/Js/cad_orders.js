document.getElementById('cadastrarModal').addEventListener('shown.bs.modal', () => {
    const products_check = document.querySelectorAll('.produto'); // Recarrega os elementos ao abrir o modal
    const totalSpan = document.getElementById('total-value');

    function calcTotal() {
        let total = 0;

        products_check.forEach(product => {
            if (product.checked) {
                total += parseFloat(products.value);
            }
        });

        totalSpan.textContent = total.toFixed(2).replace('.', ','); // Formata para padrão brasileiro
    }

    products_check.forEach(product => {
        product.addEventListener('change', calcTotal);
    });
    calcTotal(); // Chama a função para calcular o total inicialmente
});