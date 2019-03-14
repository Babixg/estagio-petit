<?php 
    require_once("conexao.php");
    session_start();

    //login
    if(isset($_REQUEST["act"]) && $_REQUEST["act"] == "login"){
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    
        $stmt = $conexao->prepare("SELECT * FROM usuario WHERE login = :login AND senha = :senha");
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":senha", $senha);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                header("Location: itens.php");
                //nome do usuário logado
                $row = $stmt->fetch();
                $_SESSION["usuario_logado"] = $row['login'];
            } 
            else {
                $_SESSION["msg_login"] = "<span style='display: block; margin-top: 23px; padding: 5px; background-color:#da1414; color: white; border-radius: 14px'>Campos podem estar com valores incorretos!</span>";
                header("Location: login.php");
            }
        } 
        else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
        
    }


    //logout
    if(isset($_REQUEST["act"]) && $_REQUEST["act"] == "logout"){
        if(isset($_SESSION["usuario_logado"])){
            unset($_SESSION["usuario_logado"]);
            header("Location: login.php");
        }
    } 
?>
