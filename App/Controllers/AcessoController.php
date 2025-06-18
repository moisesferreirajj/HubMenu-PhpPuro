<?php

class AcessoController
{
    private static $rotasPrivadas = [
        '/admin/dashboard' => ['Admin', 'Gerente'],
        '/admin/logs' => ['Admin'],
        '/gerenciar/cardapio/{id}' => ['Admin', 'Gerente'],
        '/pedidos/{id}' => ['Admin', 'Gerente', 'Garçom', 'Caixa', 'Supervisor', 'Atendente']
    ];

    /**
     * Verifica se o cargo tem acesso à rota.
     * Redireciona para /acesso-negado.php se não tiver permissão.
     */
    public static function verificarAcesso($rota, $cargo)
    {

        // PRIMEIRO: verifica se está logado
        if (!isset($_SESSION['usuario_cargo'])) {
            echo "<script>alert('Você não está logado em uma conta!'); window.location.href = '/empresarial/login';</script>";
            exit();
        }

        $temPermissao = true;

        foreach (self::$rotasPrivadas as $rotaPrivada => $cargosPermitidos) {
            $pattern = '#^' . preg_replace('/{[^}]+}/', '(\w+)', $rotaPrivada) . '$#';
            if (preg_match($pattern, $rota)) {
                if (!in_array($cargo, $cargosPermitidos)) {
                    $temPermissao = false;
                }
                break;
            }
        }

        if (!$temPermissao) {
            echo "<script>alert('Acesso Negado! - Você não tem permissão para entrar aqui.'); window.location.href = '/empresarial/login';</script>";
            exit();
        }
    }

}