<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

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
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $codigo = '';
        for ($i = 0; $i < $tamanho; $i++) {
            $indice = random_int(0, strlen($caracteres) - 1);
            $codigo .= $caracteres[$indice];
        }
        return $codigo;
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
            $mail->addAddress($_SESSION['email_usuario'], );     //Add a recipient

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

        header("Location: /empresarial/esqueceuSenha");
        exit();
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
        $usuario = $users->findById($_SESSION['usuario_id']);
        $usuarioPassword = $usuario->results[0] ?? null;

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /empresarial/esqueceuSenha');
            exit;
        }

        $nova_senha = $_POST['nova_senha'];
        $confirmar_nova_senha = $_POST['confirmar_nova_senha'];
        $senha_usuario = $usuarioPassword->senha;

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

            $updatePassword = $users->updatePassword($hash_nova_senha, $_SESSION['id_usuario']);
            
            echo "<script>alert('Sua senha foi atualizada, você pode usá-la para entrar em sua conta!'); window.location.href = '/empresarial/login';</script>";

            session_destroy();
        }
    }
}
