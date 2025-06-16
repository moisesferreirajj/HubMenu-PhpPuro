<?php

class AcessoController
{
    private static $rotasPrivadas = [
        '/admin/dashboard' => ['Admin'],
        '/admin/usuarios' => ['Admin', 'Gerente'],
        '/relatorios' => ['Admin', 'Analista'],
    ];

    /**
     * Verifica se o cargo tem acesso à rota.
     * Redireciona para /acesso-negado.php se não tiver permissão.
     */
    public static function verificarAcesso($rota, $cargo)
    {
        if (isset(self::$rotasPrivadas[$rota]) && !in_array($cargo, self::$rotasPrivadas[$rota])) {
            echo "<script>alert('Acesso Negado! - Você não tem permissão para entrar aqui.'); window.location.href('/empresarial/login');</script>";
            exit;
        }
    }
}