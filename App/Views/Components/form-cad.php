    <div class="container">
        <div class="left-side">
            <div class="left-content">
                <h1>Gerencie seu restaurante com facilidade!</h1>
                <p>Acesse o HubMenu para controlar cardápios, pedidos e clientes em uma única plataforma intuitiva e moderna. Simplifique a gestão do seu negócio e aumente seus resultados.</p>
            </div>
        </div>
        <div class="right-side">
            <div class="form-container">
                <?php @require_once __DIR__ . '/svg-logo.php'; ?>
                <h2>Acesso - Cadastro</h2>
                
                <!-- Seleção de tipo de pessoa -->
                <div class="type-selection">
                    <div class="type-button" id="btn-pessoa-fisica" onclick="selectType('fisica')">
                        <i class="fas fa-user"></i> Pessoa Física
                    </div>
                    <div class="type-button" id="btn-pessoa-juridica" onclick="selectType('juridica')">
                        <i class="fas fa-building"></i> Pessoa Jurídica
                    </div>
                </div>
                
                <!-- Formulário Pessoa Física -->
                <div class="form-section" id="form-fisica">
                    <div class="form-group">
                        <label for="nome"><i class="fas fa-user"></i> Nome Completo</label>
                        <input type="text" id="nome" placeholder="Digite seu nome completo">
                    </div>
                    
                    <div class="form-group">
                        <label for="cpf"><i class="fas fa-id-card"></i> CPF</label>
                        <input type="text" id="cpf" placeholder="000.000.000-00">
                    </div>
                    
                    <div class="form-group">
                        <label for="email-pf"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email-pf" placeholder="Seu email">
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone-pf"><i class="fas fa-phone"></i> Telefone</label>
                        <input type="tel" id="telefone-pf" placeholder="(00) 00000-0000">
                    </div>
                    
                    <div class="form-group">
                        <label for="senha-pf"><i class="fas fa-lock"></i> Senha</label>
                        <div class="password-container">
                            <input type="password" id="senha-pf" placeholder="Sua senha">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmar-senha-pf"><i class="fas fa-lock"></i> Confirmar Senha</label>
                        <div class="password-container">
                            <input type="password" id="confirmar-senha-pf" placeholder="Confirme sua senha">
                        </div>
                    </div>
                    
                    <button type="button" onclick="cadastrar('fisica')">
                        <i class="fas fa-user-plus"></i> Cadastrar-se
                    </button>
                </div>
                
                <!-- Formulário Pessoa Jurídica -->
                <div class="form-section" id="form-juridica">
                    <div class="form-group">
                        <label for="razao-social"><i class="fas fa-building"></i> Razão Social</label>
                        <input type="text" id="razao-social" placeholder="Razão Social da empresa">
                    </div>
                    
                    <div class="form-group">
                        <label for="nome-fantasia"><i class="fas fa-store"></i> Nome Fantasia</label>
                        <input type="text" id="nome-fantasia" placeholder="Nome Fantasia do restaurante">
                    </div>
                    
                    <div class="form-group">
                        <label for="cnpj"><i class="fas fa-id-card-alt"></i> CNPJ</label>
                        <input type="text" id="cnpj" placeholder="00.000.000/0000-00">
                    </div>
                    
                    <div class="form-group">
                        <label for="email-pj"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email-pj" placeholder="Email corporativo">
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone-pj"><i class="fas fa-phone"></i> Telefone</label>
                        <input type="tel" id="telefone-pj" placeholder="(00) 00000-0000">
                    </div>
                    
                    <div class="form-group">
                        <label for="responsavel"><i class="fas fa-user-tie"></i> Nome do Responsável</label>
                        <input type="text" id="responsavel" placeholder="Nome do responsável">
                    </div>
                    
                    <div class="form-group">
                        <label for="senha-pj"><i class="fas fa-lock"></i> Senha</label>
                        <div class="password-container">
                            <input type="password" id="senha-pj" placeholder="Sua senha">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmar-senha-pj"><i class="fas fa-lock"></i> Confirmar Senha</label>
                        <div class="password-container">
                            <input type="password" id="confirmar-senha-pj" placeholder="Confirme sua senha">
                        </div>
                    </div>
                    
                    <button type="button" onclick="cadastrar('juridica')">
                        <i class="fas fa-building"></i> Cadastrar-se
                    </button>
                </div>
                
                <div class="links">
                    <a href="./index"><i class="fas fa-arrow-left"></i> Voltar ao Início</a>
                    <a href="./login"><i class="fas fa-sign-in-alt"></i> Já tem cadastro? Entrar</a>
                </div>
            </div>
        </div>
    </div>
    <script src="Assets/Js/cpf-cnpj.js"></script>