<?php

class CategoriasController
{
    public function excluir()
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID não informado']);
            return;
        }

        try {
            $model = new CategoriasModel();
            $result = $model->delete($id);

            // Se seu método retorna um objeto com status, use isso:
            if (is_object($result) && isset($result->status) && $result->status === 'success') {
                echo json_encode(['status' => 'success']);
            } elseif ($result) {
                // Caso retorne true/false
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Não foi possível excluir']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}