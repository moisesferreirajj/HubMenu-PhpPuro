<?php

class SendSMSController extends RenderView
{
    public function sendSMS($codigo, $telefone)
    {
        try {
            if (empty($codigo) || empty($telefone)) {
                throw new Exception("Código ou telefone não fornecidos");
            }

            $usuario = IAgente_USER;
            $senha = IAgente_PASS;
            
            // Garante que o telefone está apenas com números
            $telefone = preg_replace('/[^0-9]/', '', $telefone);
            
            $mensagem = urlencode('Código redefinição de senha - HUBMENU: ' . $codigo);

            $url_api = "https://api.iagentesms.com.br/webservices/http.php?metodo=envio"
                . "&usuario={$usuario}"
                . "&senha={$senha}"
                . "&celular={$telefone}"
                . "&mensagem={$mensagem}";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_api);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new Exception('Erro cURL: ' . curl_error($ch));
            }

            curl_close($ch);
            
            // Verifica a resposta da API
            if (strpos($response, 'OK') !== false) {
                return ['success' => true, 'message' => 'SMS enviado com sucesso'];
            } else {
                throw new Exception('Erro na API: ' . $response);
            }

        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}