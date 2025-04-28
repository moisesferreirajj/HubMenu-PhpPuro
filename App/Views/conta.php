<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <script href="/Views/Assets/Vendor/bootstrap.min.js"></script>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <script src="/Views/Assets/Js/sidebar.js"></script>
    <link rel="stylesheet" href="/Views/Assets/Css/conta.css">
    <title>Conta</title>
</head>
<body>

<?php require '../Views/Components/sidebar.php'; ?>
<div class="header-btn">
            <button type="button" onclick="openNav()" id="open-btn" class="open-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M7.8205 3.26875C8.2111 2.87823 8.8442 2.87823 9.2348 3.26875L15.8792 9.91322C17.0505 11.0845 17.0508 12.9833 15.88 14.155L9.3097 20.7304C8.9192 21.121 8.286 21.121 7.8955 20.7304C7.505 20.3399 7.505 19.7067 7.8955 19.3162L14.4675 12.7442C14.8581 12.3536 14.8581 11.7205 14.4675 11.33L7.8205 4.68297C7.43 4.29244 7.43 3.65928 7.8205 3.26875Z" fill="#0e7a56"/>
                </svg>
            </button>
        </div> 
    <div class="headerconta">
           Conta - HubMenu
    </div>
    <div class="header">
        


    
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-item">
                <div>
                    <span class="profile-label">Nome</span>
                    <div class="profile-value">Pedro Pascal</div>
                </div>
                <div class="edit-btn">
                    <i class="bi bi-pencil"></i>
                </div>
            </div>
            
            <div class="profile-item">
                <div>
                    <span class="profile-label">E-mail</span>
                    <div class="profile-value">ShaolinPigman@hotmart.com</div>
                </div>
                <div class="edit-btn">
                    <i class="bi bi-pencil"></i>
                </div>
            </div>
            
            <div class="profile-item">
                <div>
                    <span class="profile-label">Telefone</span>
                    <div class="profile-value">47 94002-8922</div>
                </div>
                <div class="edit-btn">
                    <i class="bi bi-pencil"></i>
                </div>
            </div>
            
            <div class="profile-item password-item">
                <div>
                    <span class="profile-label">Alterar Senha</span>
                </div>
                <div class="edit-btn">
                    <i class="bi bi-pencil"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</body>
</html>