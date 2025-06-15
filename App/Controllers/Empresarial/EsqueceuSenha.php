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

    public function enviaEmail($codigo)
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

            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';                                  //Set email format to HTML
            $mail->Subject = 'Código senha - HUBMENU';
            $mail->Body = 'Segue código para recuperação de senha: <br><br><b>' . $codigo . '<b>';
            $mail->AltBody = 'Segue código para recuperação de senha: ' . $codigo;

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

            $this->enviaEmail($codigo);
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
}
