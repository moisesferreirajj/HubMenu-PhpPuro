<?php
@require_once __DIR__ . '/../global.php';

class SendSMSController extends RenderView
{
    public function sendSMS()
    {
        $users = new UsuariosModel();

        $usuario = IAgente_USER;
        $senha = IAgente_PASS;
        $celular = '47991270120';
        $mensagem = urlencode('Fabio lindao!');

        $url_api = "https://api.iagentesms.com.br/webservices/http.php?metodo=envio"
            . "&usuario={$usuario}"
            . "&senha={$senha}"
            . "&celular={$celular}"
            . "&mensagem={$mensagem}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Erro cURL: ' . curl_error($ch);
        } else {
            echo 'Resposta da API: ' . $response;
        }

        curl_close($ch);
    }
}
