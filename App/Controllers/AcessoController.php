<?php

class AcessoController
{
    private static $rotasPrivadas = [
        '/admin/logs' => ['Admin'],
        '/gerenciar/cardapio/{id}' => ['Admin', 'Gerente']
    ];

    /**
     * Verifica se o cargo tem acesso à rota.
     * Redireciona para /acesso-negado.php se não tiver permissão.
     */
    public static function verificarAcesso($rota, $cargo)
    {

        if (!isset($_SESSION['usuario_cargo'])){
            echo "<script>alert('Você não está logado em uma conta!'); window.location.href = '/empresarial/login';</script>";
            exit();
        }
        
        if (isset(self::$rotasPrivadas[$rota]) && !in_array($cargo, self::$rotasPrivadas[$rota])) {
            echo "<script>alert('Acesso Negado! - Você não tem permissão para entrar aqui.'); window.location.href('/empresarial/login');</script>";
            exit;
        }
    }
}