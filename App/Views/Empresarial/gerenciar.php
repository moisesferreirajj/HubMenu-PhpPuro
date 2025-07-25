<?php ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Title ?? 'Gerenciamento de Contas' ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/Views/Assets/Css/gerenciar.css" rel="stylesheet">
    <!-- Cropper.js CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <style>
        .btn-circle {
            width: 40px;
            height: 40px;
            padding: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-circle:hover {
            background-color: #e9ecef;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .btn-circle i {
            margin: 0;
        }
        .back-button-container {
            padding: 1rem;
            display: flex;
            justify-content: flex-start;
        }
    </style>
</head>
<body>
    <!-- Botão voltar -->
    <div class="back-button-container">
        <a href="/gerenciar/cardapio/<?= htmlspecialchars($EstabelecimentoID ?? '1'); ?>" class="btn btn-light btn-circle" title="Voltar ao Cardápio" aria-label="Voltar ao Cardápio">
            <i class="bi bi-arrow-left"></i>
        </a>
    </div>

    <div class="container-fluid">
        <div class="main-container">
            <!-- Header Section -->
            <div class="header-section">
                <div class="header-content">
                    <div class="profile-section">
                        <img 
                            id="profileImagePreview" 
                            src="<?= !empty($Estabelecimento->imagem) ? $Estabelecimento->imagem : 'https://via.placeholder.com/120x120/28a745/ffffff?text=Foto' ?>" 
                            alt="Foto do Perfil" 
                            class="profile-image"
                        >
                        <div>
                            <h1 id="profileName"><?= htmlspecialchars($Estabelecimento->nome ?? 'Nome da Empresa') ?></h1>
                            <p class="mb-0" id="profileType"><?= htmlspecialchars($Estabelecimento->tipo ?? 'Tipo de Negócio') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner Section -->
            <div class="form-section">
                <div 
                    class="banner-section" 
                    id="bannerPreview"
                    style="<?= !empty($Estabelecimento->banner) ? "background-image: url('{$Estabelecimento->banner}');" : '' ?>"
                >
                    <div class="banner-overlay">
                        <h4>Banner da Empresa</h4>
                        <p class="mb-0">Visualização do banner personalizado</p>
                    </div>
                </div>

                <form id="accountForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($Estabelecimento->id ?? '') ?>">
                    <input type="hidden" name="imagem_atual" value="<?= htmlspecialchars($Estabelecimento->imagem ?? '') ?>">
                    <input type="hidden" name="banner_atual" value="<?= htmlspecialchars($Estabelecimento->banner ?? '') ?>">

                    <!-- Informações Básicas -->
                    <div class="section-title">
                        <i class="fas fa-user-circle"></i>
                        Informações Básicas
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome" class="form-label">
                                    <i class="fas fa-building"></i>
                                    Nome da Empresa
                                </label>
                                <input type="text" class="form-control" id="nome" name="nome" required maxlength="100"
                                    value="<?= htmlspecialchars($Estabelecimento->nome ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo" class="form-label">
                                    <i class="fas fa-tags"></i>
                                    Tipo de Negócio
                                </label>
                                <input type="text" class="form-control" id="tipo" name="tipo" maxlength="100"
                                    value="<?= htmlspecialchars($Estabelecimento->tipo ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cnpj" class="form-label">
                                    <i class="fas fa-id-card"></i>
                                    CNPJ
                                </label>
                                <input type="text" class="form-control" id="cnpj" name="cnpj" maxlength="20" placeholder="00.000.000/0000-00"
                                    value="<?= htmlspecialchars($Estabelecimento->cnpj ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cep" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i>
                                    CEP
                                </label>
                                <input type="text" class="form-control" id="cep" name="cep" maxlength="20" placeholder="00000-000"
                                    value="<?= htmlspecialchars($Estabelecimento->cep ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="endereco" class="form-label">
                            <i class="fas fa-home"></i>
                            Endereço Completo
                        </label>
                        <input type="text" class="form-control" id="endereco" name="endereco" maxlength="255"
                            value="<?= htmlspecialchars($Estabelecimento->endereco ?? '') ?>">
                    </div>

                    <!-- Imagens -->
                    <div class="section-title">
                        <i class="fas fa-images"></i>
                        Imagens e Visual
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imagem" class="form-label">
                                    <i class="fas fa-user-circle"></i>
                                    Foto do Perfil
                                </label>
                                <div class="file-input-wrapper">
                                    <input type="file" class="file-input" id="imagem" name="imagem" accept="image/*">
                                    <div class="file-input-display">
                                        <i class="fas fa-upload"></i>
                                        <span>Clique para selecionar uma imagem</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="banner" class="form-label">
                                    <i class="fas fa-image"></i>
                                    Banner da Empresa
                                </label>
                                <div class="file-input-wrapper">
                                    <input type="file" class="file-input" id="banner" name="banner" accept="image/*">
                                    <div class="file-input-display">
                                        <i class="fas fa-upload"></i>
                                        <span>Clique para selecionar um banner</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cores -->
                    <div class="section-title">
                        <i class="fas fa-palette"></i>
                        Personalização de Cores
                    </div>

                    <div class="color-picker-group">
                        <div class="form-group">
                            <label for="cor1" class="form-label">
                                <i class="fas fa-circle" style="color: var(--primary-color);"></i>
                                Cor Primária
                            </label>
                            <input type="color" class="form-control color-input" id="cor1" name="cor1"
                                value="<?= htmlspecialchars($Estabelecimento->cor1 ?? '#28a745') ?>">
                        </div>
                        <div class="form-group">
                            <label for="cor2" class="form-label">
                                <i class="fas fa-circle" style="color: var(--secondary-color);"></i>
                                Cor Secundária
                            </label>
                            <input type="color" class="form-control color-input" id="cor2" name="cor2"
                                value="<?= htmlspecialchars($Estabelecimento->cor2 ?? '#20c997') ?>">
                        </div>
                        <div class="form-group">
                            <label for="cor3" class="form-label">
                                <i class="fas fa-circle" style="color: var(--accent-color);"></i>
                                Cor de Destaque
                            </label>
                            <input type="color" class="form-control color-input" id="cor3" name="cor3"
                                value="<?= htmlspecialchars($Estabelecimento->cor3 ?? '#17a2b8') ?>">
                        </div>
                    </div>

                    <!-- Preview Section -->
                    <div class="preview-section">
                        <h5><i class="fas fa-eye"></i> Visualização em Tempo Real</h5>
                        <p class="text-muted">As alterações serão aplicadas após você clicar no botão "Salvar Alterações".</p>
                    </div>

                    <!-- Botões -->
                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <button type="submit" class="btn btn-primary" id="saveChangesBtn">
                            <i class="fas fa-save"></i>
                            Salvar Alterações
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">
                            <i class="fas fa-undo"></i>
                            Resetar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para crop do banner -->
    <div class="modal fade" id="bannerCropModal" tabindex="-1" aria-labelledby="bannerCropModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="bannerCropModalLabel">Ajustar Banner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div>
              <img id="bannerCropImage" style="max-width:100%; max-height:400px;">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="cropBannerBtn" class="btn btn-primary">Recortar e Usar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Toast Notifications -->
    <div class="toast-container"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="/Views/Assets/Js/gerenciar.js"></script>
    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</body>
</html>