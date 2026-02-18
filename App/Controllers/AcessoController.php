<?php

class AcessoController
{
    private static $rotasPrivadas = [
        '/admin/dashboard' => ['Admin', 'Gerente'],
        '/empresarial/dashboard/{id}' => ['Admin', 'Gerente'],
        '/admin/logs' => ['Admin'],
        '/gerenciar/cardapio/{id}' => ['Admin', 'Gerente'],
        '/pedidos/{id}' => ['Admin', 'Gerente', 'Garçom', 'Caixa', 'Supervisor', 'Atendente'],
        '/pedidos/registerOrder' => ['Admin', 'Gerente', 'Garçom', 'Caixa', 'Supervisor', 'Atendente'], // ✅ Adicionada aqui
    ];

    /**
     * Verifica se o cargo tem acesso à rota.
     * Redireciona para /acesso-negado.php se não tiver permissão.
     */
    public static function verificarAcesso($rota, $cargo, $estabelecimentoDaRota = null)
    {
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

        if ($temPermissao && $estabelecimentoDaRota !== null) {
            if ($_SESSION['estabelecimento_id'] != $estabelecimentoDaRota) {
                echo "<script>alert('Acesso Negado! - Estabelecimento não autorizado.'); window.history.back();</script>";
                exit();
            }
        }
    }
}
