<?php
    require_once("conexao.php");

    // Verificar se foi enviando dados via POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
        $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
        $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";
    
    } else if (!isset($id)) {
        // Se não se não foi setado nenhum valor para variável $id
        $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
        $nome = null;
        $descricao = null;
    }

    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save") {
        //$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        //$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        if(empty($nome) || empty($descricao)){
            $_SESSION["msg_categoria"] = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Há campos nulos !</div>";
            header("Location: home.php");
        }
        else{
            try {
                $stmt = $conexao->prepare("INSERT INTO categoria(nome, descricao) VALUES (:nome, :descricao)");
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":descricao", $descricao);
                    
                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        $_SESSION["msg_categoria"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Dados cadastrados com sucesso !</div>";
                        //$id = null;
                        $nome = null;
                        $descricao = null;
                    } else {
                        $_SESSION["msg_categoria"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erro ao tentar efetivar o cadastro !</div>";
                    }
                } 
                else {
                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                }
                header("Location: home.php");
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }
        }
    }


    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd") {
        try {
            if ($id != "") {
                $stmt = $conexao->prepare("UPDATE categoria SET nome=:nome, descricao=:descricao WHERE id_categoria = :id_categoria");
                $stmt->bindParam(":id_categoria", $id);
            } 
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":descricao", $descricao);
            $stmt->bindParam(":id_categoria", $id);
            
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $_SESSION["msg_categoria"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Dados atualizados com sucesso !</div>";
                    $id = null;
                    $nome = null;
                    $descricao = null;
                } else {
                    $_SESSION["msg_categoria"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erro ao tentar efetivar a atualização !</div>";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
            header("Location: home.php");
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "sel") {
        try {
            $stmt = $conexao->prepare("SELECT * FROM categoria WHERE id_categoria = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                $id = $rs->id_categoria;
                $nome = $rs->nome;
                $descricao = $rs->descricao;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }

    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del") {
        try {
            $stmt = $conexao->prepare("DELETE FROM categoria WHERE id_categoria = :id_categoria");
            $stmt->bindParam(":id_categoria", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                //$_SESSION["msg_categoria"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Registro foi excluído com êxito !</div>";
                $id = null;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } 
        catch (PDOException $erro) {
            $_SESSION["msg_categoria"] = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Remova os pratos presentes nessa categoria antes de excluir !</div>";
        } 
    }

     if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "filtro") {
        try {
            $stmt = $conexao->prepare("SELECT prato.nome, prato.ingredientes FROM prato inner join categoria on tipo = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }

    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "pratoSEMcategoria") {
        try {
            $stmt = $conexao->prepare("SELECT prato.nome FROM prato inner join categoria on tipo = null");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }



?>

