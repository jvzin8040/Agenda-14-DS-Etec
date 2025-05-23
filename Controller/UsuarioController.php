<?php
if (!isset($_SESSION)) {
    session_start();
}
class UsuarioController
{
    public function inserir($nome, $cpf, $dataNascimento, $email, $senha)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setDataNascimento($dataNascimento);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $r = $usuario->inserirBD();
        $_SESSION['Usuario'] = serialize($usuario);
        return $r;
    }

    public function atualizar($id, $nome, $cpf, $email, $dataNascimento)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setDataNascimento($dataNascimento);


        $r = $usuario->atualizarBD();
        $_SESSION['Usuario'] = serialize($usuario);
        return $r;
    }

    public function login($cpf, $senha)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->carregarUsuario($cpf);
        $verSenha = $usuario->getSenha();
        if ($senha == $verSenha) {
            $_SESSION['Usuario'] = serialize($usuario);
            return true;
        } else {
            return false;
        }
    }

 // Método para listar o usuário
    public function listaCadastrados()
    {
        require_once '../Model/ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error); 
        }
        $sql = "SELECT idusuario, nome FROM usuario;"; 
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }

}
