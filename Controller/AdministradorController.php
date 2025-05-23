<?php

if (!isset($_SESSION)) {
    session_start();
}

class AdministradorController
{
    public function login($cpf, $senha)
    {
        require_once '../Model/Administrador.php';
        $administrador = new Administrador();
        $administrador->carregarAdministrador($cpf);
        if ($administrador->getSenha() == $senha) {
            $_SESSION['Administrador'] = serialize($administrador);
            return true;
        } else {
            return false;
        }
    }

    // Método para listar os administradores cadastrados --------
    public function listaCadastrados()
    {
        require_once '../Model/ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT idadministrador, nome, cpf FROM administrador;";
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }
}
