<?php

session_start();
require('../../database/conexao.php');

//FUNÇÕES DE LOGIN/LOGOUT//
function realizarLogin($usuario, $senha, $conexao)
{

    $sql = "SELECT * FROM tbl_administrador
                WHERE usuario = '$usuario' AND senha = '$senha'";

    $resultado = mysqli_query($conexao, $sql);

    $dadosUsuario = mysqli_fetch_array($resultado);

    if (isset($dadosUsuario["usuario"]) && isset($dadosUsuario["senha"]) && password_verify($senha, $dadosUsuario["senha"])) {

        $_SESSION["usuarioID"] = $dadosUsuario["id"];
        $_SESSION["nome"] = $dadosUsuario["nome"];

        // echo $_SESSION["usuarioID"];
        // echo $_SESSION["nome"];

        header("location: ../../produtos/index.php");
    } else {

        echo 'ALGO DEU ERRADO!';
    }
}

switch ($_POST["acao"]) {
    case 'login':

        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        realizarLogin($usuario, $senha, $conexao);

        break;

    case 'logout':
        # echo 'FAZENDO LOGOUT'
        session_destroy();
        header("location: ../../produtos/index.php");

    default:

        break;
}
