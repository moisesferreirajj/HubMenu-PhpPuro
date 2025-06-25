<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Views/Assets/Css/suporte.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <script href="/Views/Assets/Vendor/bootstrap.min.js"></script>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <title><?= $Title ?> Suporte</title>
</head>

<body>
    <?php include_once __DIR__ . '/../Components/navigation.php'; ?>

    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <section class="py-5">
                <div class="container px-5">
                    <div class="bg rounded-4 py-5 px-4 px-md-5">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder">Fale Conosco</h1>
                            <p class="lead fw-normal text-muted mb-0">Vamos conversar, quer tirar alguma dúvida sobre o
                                sistema?</p>
                        </div>
                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-8 col-xl-6">
                                <form id="ContatoForm">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="nome" type="text" placeholder="Insira seu nome"
                                            data-sb-validations="required" required />
                                        <label for="nome">Nome completo</label>
                                        <div class="invalid-feedback" data-sb-feedback="nome:required">É necessário o
                                            nome completo!</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email" type="email"
                                            placeholder="exemplo@gmail.com" data-sb-validations="required" required />
                                        <label for="email">Endereço de email</label>
                                        <div class="invalid-feedback" data-sb-feedback="email:required">É necessário um
                                            email!</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="phone" type="tel" placeholder="(99) 99999-9999"
                                            maxlength="15" data-sb-validations="required" required
                                            pattern="^\(\d{2}\)\s\d{4,5}-\d{4}$" />
                                        <label for="phone">Telefone</label>
                                        <div class="invalid-feedback" data-sb-feedback="phone:required">
                                            É necessário um número de telefone!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="message" type="text"
                                            placeholder="Coloque sua mensagem aqui" style="height: 10rem"
                                            data-sb-validations="required" required>
                                        </textarea>
                                        <label for="message">Mensagem</label>
                                        <div class="invalid-feedback" data-sb-feedback="message:required">É necessário
                                            escrever uma mensagem!</div>
                                    </div>
                                    <div class="d-grid"><button class="btn btn-success" id="BotaoEnviar"
                                            type="submit">Enviar</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include_once __DIR__ . '/../Components/footer.php'; ?>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const phoneInput = document.getElementById('phone');
                const phoneFeedback = phoneInput.parentElement.querySelector('.invalid-feedback');
                const phoneRegex = /^\(\d{2}\)\s\d{4,5}-\d{4}$/;

                // Formatação automática
                phoneInput.addEventListener('input', function (e) {
                    let value = phoneInput.value.replace(/\D/g, ''); // Remove tudo que não for número

                    if (value.length > 11) value = value.slice(0, 11);

                    if (value.length > 6) {
                        phoneInput.value = `(${value.slice(0, 2)}) ${value.slice(2, value.length - 4)}-${value.slice(-4)}`;
                    } else if (value.length > 2) {
                        phoneInput.value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
                    } else if (value.length > 0) {
                        phoneInput.value = `(${value}`;
                    }

                    validatePhone();
                });

                function validatePhone() {
                    if (phoneRegex.test(phoneInput.value.trim())) {
                        phoneInput.classList.remove('is-invalid');
                        phoneInput.classList.add('is-valid');
                        phoneFeedback.style.display = 'none';
                    } else {
                        phoneInput.classList.remove('is-valid');
                        phoneInput.classList.add('is-invalid');
                        phoneFeedback.style.display = 'block';
                    }
                }

                phoneInput.addEventListener('blur', validatePhone);
                phoneInput.addEventListener('change', validatePhone);
            });
        </script>
    </body>

</html>