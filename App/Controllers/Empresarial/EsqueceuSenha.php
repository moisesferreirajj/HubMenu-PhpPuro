<?php

// Include Composer's autoloader
require_once __DIR__ . '/../../../vendor/autoload.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EsqueceuSenha extends RenderView
{
    public function index()
    {
        $this->loadView(
            'empresarial/forget_password',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }

    function gerarCodigo($tamanho = 5)
    {
        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $tamanho);
    }

    public function enviaEmail($codigo, $nomeUsuario = '')
    {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;               //Enable verbose debug output
            $mail->isSMTP();                                      //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                 //Set the SMTP server to send through
            $mail->SMTPAuth = true;                             //Enable SMTP authentication
            $mail->Username = PHPMAILER_USERNAME;               //SMTP username
            $mail->Password = PHPMAILER_PASSWORD;                         //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   //Enable implicit TLS encryption
            $mail->Port = 587;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(PHPMAILER_USERNAME, 'HubMenu');
            $mail->addAddress($_SESSION['email_usuario'], $_SESSION['usuario_nome']);     //Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Código de Recuperação de Senha - HUBMENU';

            $mail->Body = $this->getEmailTemplate($codigo, $nomeUsuario);
            $mail->AltBody = $this->getEmailTextVersion($codigo, $nomeUsuario);

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function autenticar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /empresarial/esqueceuSenha');
            exit();
        }

        if ($_SESSION['metodo_envio'] == 'email') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

            if (!$email) {
                echo "<script>alert('Informe um e-mail válido.'); window.location.href = '/empresarial/esqueceuSenha';</script>";
                exit();
            }

            $users = new UsuariosModel();
            $usuario = $users->buscarPorEmail($email);
            $emailExists = $usuario->results[0] ?? null;

            // para desenvolvimento
            // if ($emailExists == null) {
            //     echo "Busca Vazia"; 
            //     exit;
            // }

            if (!$emailExists) {
                // Por segurança, não informe se o e-mail existe ou não
                echo "<script>alert('Se o e-mail estiver cadastrado, você receberá instruções.'); window.location.href = '/empresarial/esqueceuSenha';</script>";
                exit;
            }

            echo "<script>alert('Se o e-mail estiver cadastrado, você receberá instruções.'); window.location.href = '/empresarial/esqueceuSenha';</script>";

            $codigo = $this->gerarCodigo(5);

            $_SESSION['email_usuario'] = $emailExists->email;
            $_SESSION['id_usuario'] = $emailExists->id;
            $_SESSION['codigo'] = $codigo;
            $_SESSION['codigo_expira'] = time() + 300;

            $this->enviaEmail($codigo, $emailExists->nome);
            exit();
        }

        if ($_SESSION['metodo_envio'] == 'sms') {
            $telefone = trim($_POST['telefone']);

            // Remove tudo que não for número
            $telefoneOnlyNumbers = preg_replace('/[^0-9]/', '', $telefone);

            if (strlen($telefoneOnlyNumbers) < 10 || strlen($telefoneOnlyNumbers) > 11) {
                echo "<script>alert('Formato de telefone inválido.'); window.location.href = '/empresarial/esqueceuSenha';</script>";
                exit();
            }

            $users = new UsuariosModel();
            $usuario = $users->buscarPorTelefone($telefone);
            $telefoneExists = $usuario->results[0] ?? null;

            if (!$telefoneExists) {
                echo "<script>alert('Se o telefone estiver cadastrado, você receberá um SMS.'); window.location.href = '/empresarial/esqueceuSenha';</script>";
                exit;
            }

            $codigo = $this->gerarCodigo(5);

            $_SESSION['telefone_usuario'] = $telefoneExists->telefone;
            $_SESSION['id_usuario'] = $telefoneExists->id;
            $_SESSION['codigo'] = $codigo;
            $_SESSION['codigo_expira'] = time() + 300;

            // Instancia SendSMSController e envia o SMS
            $smsenvio = new SendSMSController();
            $resultado = $smsenvio->sendSMS($codigo, $telefoneOnlyNumbers);

            if ($resultado['success']) {
                echo "<script>alert('SMS enviado com sucesso!'); window.location.href = '/empresarial/esqueceuSenha';</script>";
            } else {
                echo "<script>alert('Erro ao enviar SMS: " . $resultado['message'] . "'); window.location.href = '/empresarial/esqueceuSenha';</script>";
            }
            exit();
        }
    }

    public function sendType()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /empresarial/esqueceuSenha');
            exit();
        }

        $metodo_envio = $_POST['metodo_envio'] ?? '';

        if (!$metodo_envio) {
            header('Location: /empresarial/esqueceuSenha');
            exit;
        }

        $_SESSION['metodo_envio'] = $metodo_envio;
        header("Location: /empresarial/esqueceuSenha");
        exit;
    }

    public function code()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /empresarial/esqueceuSenha');
            exit;
        }

        $codigo_inserido = $_POST['codigo'];

        if ($codigo_inserido != $_SESSION['codigo']) {
            echo "<script>alert('O código está incorreto!'); window.location.href = '/empresarial/esqueceuSenha';</script>";
            exit;
        }

        $_SESSION['codigo_inserido'] = $codigo_inserido;

        header("Location: /empresarial/esqueceuSenha");
        exit;
    }

    public function changePassword()
    {
        $users = new UsuariosModel();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /empresarial/esqueceuSenha');
            exit;
        }

        $nova_senha = $_POST['nova_senha'];
        $confirmar_nova_senha = $_POST['confirmar_nova_senha'];

        $hash_nova_senha = password_hash($nova_senha, PASSWORD_DEFAULT);

        if (!$nova_senha) {
            header("Location: /empresarial/esqueceuSenha");
            exit;
        }

        if ($nova_senha && $confirmar_nova_senha) {
            if (!($nova_senha == $confirmar_nova_senha)) {
                echo "<script>alert('As senhas não correspondem'); window.location.href = '/empresarial/esqueceuSenha';</script>";
                exit;
            }

            $users->updatePassword($hash_nova_senha, $_SESSION['id_usuario']);

            echo "<script>alert('Sua senha foi atualizada, você pode usá-la para entrar em sua conta!'); window.location.href = '/empresarial/login';</script>";

            session_destroy();
        }
    }

    /**
     * Template HTML profissional para o e-mail
     * @param string $codigo
     * @param string $nomeUsuario
     * @return string
     */
    private function getEmailTemplate($codigo, $nomeUsuario)
    {
        $saudacao = $nomeUsuario ? "Olá, {$nomeUsuario}" : "Olá";
        
        return "
        <!DOCTYPE html>
        <html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Recuperação de Senha - HubMenu</title>
            <style>
                body { 
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
                    line-height: 1.6; 
                    color: #333; 
                    max-width: 600px; 
                    margin: 0 auto; 
                    padding: 20px;
                    background-color: #f5f5f5;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 8px;
                    padding: 40px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                }
                .header {
                    text-align: center;
                    margin-bottom: 30px;
                }
                .logo {
                    color: #2c5282;
                    font-size: 28px;
                    font-weight: bold;
                    margin-bottom: 10px;
                }
                .subtitle {
                    color: #718096;
                    font-size: 16px;
                }
                .greeting {
                    font-size: 18px;
                    margin-bottom: 20px;
                    color: #2d3748;
                }
                .message {
                    margin-bottom: 30px;
                    color: #4a5568;
                    line-height: 1.7;
                }
                .code-container {
                    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
                    border-radius: 12px;
                    padding: 30px;
                    text-align: center;
                    margin: 30px 0;
                    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
                }
                .code-label {
                    color: rgba(255, 255, 255, 0.9);
                    font-size: 16px;
                    margin-bottom: 15px;
                    font-weight: 500;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                }
                .code {
                    background-color: #ffffff;
                    color: #1e40af;
                    font-size: 36px;
                    font-weight: 900;
                    letter-spacing: 6px;
                    padding: 20px 30px;
                    border-radius: 8px;
                    border: none;
                    display: inline-block;
                    min-width: 220px;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                    font-family: 'Courier New', monospace;
                }
                .security-notice {
                    background-color: #f7fafc;
                    border-left: 4px solid #4299e1;
                    padding: 15px;
                    margin: 25px 0;
                    border-radius: 0 4px 4px 0;
                }
                .security-title {
                    font-weight: bold;
                    color: #2d3748;
                    margin-bottom: 5px;
                }
                .footer {
                    margin-top: 40px;
                    padding-top: 20px;
                    border-top: 1px solid #e2e8f0;
                    text-align: center;
                    color: #718096;
                    font-size: 14px;
                }
                .highlight {
                    color: #2c5282;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <div class='logo'>HubMenu</div>
                    <div class='subtitle'>Sistema de Gestão</div>
                </div>
                
                <div class='greeting'>{$saudacao}.</div>
                
                <div class='message'>
                    Recebemos uma solicitação para recuperação de senha da sua conta. 
                    Para prosseguir com a alteração da sua senha, utilize o código abaixo:
                </div>
                
                <div class='code-container'>
                    <div class='code-label'>Seu código de verificação:</div>
                    <div class='code'>{$codigo}</div>
                </div>
                
                <div class='security-notice'>
                    <div class='security-title'>⚠️ Importante - Segurança da sua conta:</div>
                    <ul style='margin: 10px 0; padding-left: 20px; color: #4a5568;'>
                        <li>Este código é válido por apenas <span class='highlight'>5 minutos</span></li>
                        <li>Use este código apenas no site oficial do HubMenu</li>
                        <li>Nunca compartilhe este código com terceiros</li>
                        <li>Se você não solicitou esta recuperação, ignore este e-mail</li>
                    </ul>
                </div>
                
                <div class='message'>
                    Retorne à página de recuperação de senha e digite o código acima para continuar.
                </div>
                
                <div class='footer'>
                    <p>Atenciosamente,<br>
                    <strong>Equipe HubMenu</strong></p>
                    <p style='margin-top: 20px; font-size: 12px; color: #a0aec0;'>
                        Este é um e-mail automático, não responda a esta mensagem.
                    </p>
                </div>
            </div>
        </body>
        </html>";
    }

    /**
     * Versão texto do e-mail (para clientes que não suportam HTML)
     * @param string $codigo
     * @param string $nomeUsuario
     * @return string
     */
    private function getEmailTextVersion($codigo, $nomeUsuario)
    {
        $saudacao = $nomeUsuario ? "Olá, {$nomeUsuario}" : "Olá";

        return "
        {$saudacao}.

        Recebemos uma solicitação para recuperação de senha da sua conta HubMenu.

        SEU CÓDIGO DE VERIFICAÇÃO: {$codigo}

        IMPORTANTE:
        - Este código é válido por apenas 5 minutos
        - Use apenas no site oficial do HubMenu  
        - Nunca compartilhe com terceiros
        - Se não solicitou, ignore este e-mail

        Retorne à página de recuperação e digite o código para continuar.

        Atenciosamente,
        Equipe HubMenu

        ---
        Este é um e-mail automático, não responda a esta mensagem.
        ";
    }
}
