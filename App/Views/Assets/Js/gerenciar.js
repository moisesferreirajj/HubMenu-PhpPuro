// Account Management JavaScript
        class AccountManager {
            constructor() {
                this.form = document.getElementById('accountForm');
                this.initializeEventListeners();
                this.initializePreview();
                this.loadSavedData();
            }

            initializeEventListeners() {
                // Form submission
                this.form.addEventListener('submit', (e) => this.handleSubmit(e));

                // Real-time preview updates
                document.getElementById('nome').addEventListener('input', () => this.updateNamePreview());
                document.getElementById('tipo').addEventListener('input', () => this.updateTypePreview());
                
                // Color changes
                ['cor1', 'cor2', 'cor3'].forEach(colorId => {
                    document.getElementById(colorId).addEventListener('change', () => this.updateColors());
                });

                // Image uploads
                document.getElementById('imagem').addEventListener('change', (e) => this.handleImageUpload(e, 'profile'));
                document.getElementById('banner').addEventListener('change', (e) => this.handleImageUpload(e, 'banner'));

                // CEP lookup
                document.getElementById('cep').addEventListener('blur', () => this.lookupCEP());

                // CNPJ formatting
                document.getElementById('cnpj').addEventListener('input', (e) => this.formatCNPJ(e));
                document.getElementById('cep').addEventListener('input', (e) => this.formatCEP(e));
            }

            initializePreview() {
                this.updateColors();
                this.updateNamePreview();
                this.updateTypePreview();
            }

            updateColors() {
                const cor1 = document.getElementById('cor1').value || '#28a745';
                const cor2 = document.getElementById('cor2').value || '#20c997';
                const cor3 = document.getElementById('cor3').value || '#17a2b8';

                // Update CSS custom properties
                const root = document.documentElement;
                root.style.setProperty('--primary-color', cor1);
                root.style.setProperty('--secondary-color', cor2);
                root.style.setProperty('--accent-color', cor3);

                // Update body background
                document.body.style.background = `linear-gradient(135deg, ${cor1} 0%, ${cor2} 50%, ${cor3} 100%)`;
            }

            updateNamePreview() {
                const nome = document.getElementById('nome').value || 'Nome da Empresa';
                document.getElementById('profileName').textContent = nome;
            }

            updateTypePreview() {
                const tipo = document.getElementById('tipo').value || 'Tipo de Negócio';
                document.getElementById('profileType').textContent = tipo;
            }

            handleImageUpload(event, type) {
                const file = event.target.files[0];
                if (!file) return;

                if (!file.type.startsWith('image/')) {
                    this.showToast('Erro', 'Por favor, selecione apenas arquivos de imagem.', 'error');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    if (type === 'profile') {
                        document.getElementById('profileImagePreview').src = e.target.result;
                    } else if (type === 'banner') {
                        document.getElementById('bannerPreview').style.backgroundImage = `url(${e.target.result})`;
                    }
                };
                reader.readAsDataURL(file);
            }

            async lookupCEP() {
                const cep = document.getElementById('cep').value.replace(/\D/g, '');
                if (cep.length !== 8) return;

                try {
                    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                    const data = await response.json();
                    
                    if (!data.erro) {
                        const endereco = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                        document.getElementById('endereco').value = endereco;
                        this.showToast('Sucesso', 'Endereço preenchido automaticamente!', 'success');
                    }
                } catch (error) {
                    console.error('Erro ao buscar CEP:', error);
                }
            }

            formatCNPJ(event) {
                let value = event.target.value.replace(/\D/g, '');
                if (value.length <= 14) {
                    value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                    value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                    value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                    value = value.replace(/(\d{4})(\d)/, '$1-$2');
                    event.target.value = value;
                }
            }

            formatCEP(event) {
                let value = event.target.value.replace(/\D/g, '');
                if (value.length <= 8) {
                    value = value.replace(/^(\d{5})(\d)/, '$1-$2');
                    event.target.value = value;
                }
            }

            async handleSubmit(event) {
                event.preventDefault();

                const formData = new FormData(this.form);

                try {
                    const response = await fetch('/api/estabelecimento/editar', {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();

                    if (result.status === 'success') {
                        this.showToast('Sucesso', result.message, 'success');
                    } else {
                        // Mostra mensagem detalhada se existir
                        let msg = result.message;
                        if (result.error) {
                            msg += '<br><small>' + result.error + '</small>';
                        }
                        this.showToast('Erro', msg, 'error');
                    }
                } catch (error) {
                    this.showToast('Erro', 'Falha ao salvar dados.', 'error');
                }
            }

            saveData(data) {
                // In a real application, this would send data to a server
                // For now, we'll save to memory
                this.savedData = { ...data };
                console.log('Dados salvos:', data);
            }

            loadSavedData() {
                // In a real application, this would load from a server or database
                if (this.savedData) {
                    Object.keys(this.savedData).forEach(key => {
                        const element = document.getElementById(key);
                        if (element) {
                            element.value = this.savedData[key];
                        }
                    });
                    this.initializePreview();
                }
            }

            showToast(title, message, type = 'info') {
                const toastContainer = document.querySelector('.toast-container');
                const toastId = 'toast-' + Date.now();
                
                const bgClass = {
                    success: 'bg-success',
                    error: 'bg-danger',
                    warning: 'bg-warning',
                    info: 'bg-info'
                }[type] || 'bg-info';

                const toastHTML = `
                    <div class="toast ${bgClass} text-white" id="${toastId}" role="alert">
                        <div class="toast-header ${bgClass} text-white border-0">
                            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                            <strong class="me-auto">${title}</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>
                `;

                toastContainer.innerHTML += toastHTML;
                const toastElement = document.getElementById(toastId);
                const toast = new bootstrap.Toast(toastElement, { delay: 5000 });
                toast.show();

                // Remove toast element after it's hidden
                toastElement.addEventListener('hidden.bs.toast', () => {
                    toastElement.remove();
                });
            }
        }

        // Global functions
        function resetForm() {
            if (confirm('Tem certeza que deseja resetar todos os dados?')) {
                document.getElementById('accountForm').reset();
                
                // Reset colors to default
                document.getElementById('cor1').value = '#28a745';
                document.getElementById('cor2').value = '#20c997';
                document.getElementById('cor3').value = '#17a2b8';
                
                // Reset images
                document.getElementById('profileImagePreview').src = 'https://via.placeholder.com/120x120/28a745/ffffff?text=Foto';
                document.getElementById('bannerPreview').style.backgroundImage = '';
                
                // Reinitialize preview
                accountManager.initializePreview();
                accountManager.showToast('Info', 'Formulário resetado!', 'info');
            }
        }

        function loadSampleData() {
            document.getElementById('nome').value = 'Empresa Exemplo Ltda';
            document.getElementById('tipo').value = 'Tecnologia e Inovação';
            document.getElementById('cnpj').value = '12.345.678/0001-90';
            document.getElementById('cep').value = '01234-567';
            document.getElementById('endereco').value = 'Rua das Flores, 123, Centro, São Paulo - SP';
            
            accountManager.initializePreview();
            accountManager.showToast('Sucesso', 'Dados de exemplo carregados!', 'success');
        }

        // Initialize the application
        const accountManager = new AccountManager();
