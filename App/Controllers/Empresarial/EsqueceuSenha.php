<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

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

    public function enviaEmail()
    {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug  = SMTP::DEBUG_SERVER;               //Enable verbose debug output
            $mail->isSMTP();                                      //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                 //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                             //Enable SMTP authentication
            $mail->Username   = 'cautios.yohan@gmail.com';               //SMTP username
            $mail->Password   = 'ttcczoklydsvcwxu';                         //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   //Enable implicit TLS encryption
            $mail->Port       = 587;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('cautios.yohan@gmail.com', 'Mailer');
            $mail->addAddress($_SESSION['email_usuario'],);     //Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';                                  //Set email format to HTML
            $mail->Subject = 'Código senha - HUBMENU';
            $mail->Body    = 'Segue código para recuperação de senha: <br><br><b>' . $this->gerarCodigo(5) . '<b>';
            $mail->AltBody = 'Segue código para recuperação de senha: ' . $this->gerarCodigo(5);

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
        $emailExists = $usuario->results[0];

        if (!$emailExists) {
            // Por segurança, não informe se o e-mail existe ou não
            echo "<script>alert('Se o e-mail estiver cadastrado, você receberá instruções.'); window.location.href = '/empresarial/esqueceuSenha';</script>";
            exit();
        }

        $_SESSION['email_usuario'] = $emailExists->email;
        $_SESSION['nome_usuario'] = $emailExists->nome;

        $this->enviaEmail();

        echo "<script>alert('Se o e-mail estiver cadastrado, você receberá instruções.'); window.location.href = '/empresarial/esqueceuSenha';</script>";
        exit();
    }
}
