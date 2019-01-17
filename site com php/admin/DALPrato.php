<?php

    require_once("conexao.php");

    // Verificar se foi enviando dados via POST

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
        $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
        $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";
        $peso = (isset($_POST["peso"]) && $_POST["peso"] != null) ? $_POST["peso"] : "";
        $ingredientes = (isset($_POST["ingredientes"]) && $_POST["ingredientes"] != null) ? $_POST["ingredientes"] : "";
        $tipo = (isset($_POST["tipo"]) && $_POST["tipo"] != null) ? $_POST["tipo"] : null;
    } else if (!isset($id)) {
        // Se não se não foi setado nenhum valor para variável $id
        $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
        $nome = null;
        $peso = null;
        $ingredientes = null;
        $tipo = null;
    }

    //SALVAR
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save") {
        if(empty($nome) || empty($peso) || empty($ingredientes) ){
            $_SESSION["msg_prato"] = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Há campos nulos!</div>";
            header("Location: home.php");
        }
        else
        {
            try {
                $stmt = $conexao->prepare("INSERT INTO prato (id_prato, nome, descricao, peso, ingredientes, tipo) VALUES (:id, :nome, :descricao, :peso, :ingredientes, :tipo)");
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":peso", $peso);
                $stmt->bindParam(":ingredientes", $ingredientes);
                $stmt->bindParam(":tipo", $tipo);
                 
                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        $_SESSION["msg_prato"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Dados cadastrados com sucesso!</div>";
                        $id = null;
                        $nome = null;
                        $peso = null;
                        $ingredientes = null;
                        $tipo = null;
                    } else {
                        $_SESSION["msg_prato"] = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erro ao tentar efetivar cadastro!</div>";
                    }
                    header("Location: home.php");
                } else {
                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }
        }
    }

    //ATUALIZAR
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd") {
        if(empty($nome) || empty($peso) || empty($ingredientes)){
            $_SESSION["msg_prato"] = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Há campos nulos!</div>";
            header("Location: home.php");
        }
        else{
            try {
                if ($id != "") {
                    $stmt = $conexao->prepare("UPDATE prato SET nome=:nome, descricao=:descricao, peso=:peso, ingredientes=:ingredientes, tipo=:tipo WHERE id_prato = :id");
                    $stmt->bindParam(":id", $id);
                } 
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":peso", $peso);
                $stmt->bindParam(":ingredientes", $ingredientes);
                $stmt->bindParam(":tipo", $tipo);
                 
                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        $_SESSION["msg_prato"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Dados atualizados com sucesso!</div>";
                        $id = null;
                        $nome = null;
                        $peso = null;
                        $ingredientes = null;
                        $tipo = null;
                    } else {
                        $_SESSION["msg_prato"] = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erro ao tentar efetivar atualização!</div>";
                    }
                    header("Location: home.php");
                } else {
                       throw new PDOException("Erro: Não foi possível executar a declaração sql");
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }
        }
    }


    //SELECIONAR
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "sel") {
        try {
            $stmt = $conexao->prepare("SELECT * FROM prato WHERE id_prato = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                $id = $rs->id_prato;
                $nome = $rs->nome;
                $descricao = $rs->descricao;
                $peso = $rs->peso;
                $ingredientes = $rs->ingredientes;
                $tipo = $rs->tipo;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }

    //DELETAR
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del") {
        try {
            $stmt = $conexao->prepare("DELETE FROM prato WHERE id_prato = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $_SESSION["msg_prato"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Registro excluído com sucesso !</div>";
                $id = null;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
            //header("Location: home.php");
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }

    //ATUALIZAR TIPO
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd_tipo_prato") {
        try {
            $id_upd_p = $_POST["id_upd_p"];
            $tipo_upd_p = $_GET["tipo_upd_p"];

            if ($id_upd_p != "") {
                if($tipo_upd_p != "null"){ //se for passado um id para atualizar o tipo, atualize, senão defina como nulo
                    $stmt = $conexao->prepare("UPDATE prato SET tipo=:tipo WHERE id_prato = :id");
                    $stmt->bindParam(":tipo", $tipo_upd_p);
                }
                else{
                    $stmt = $conexao->prepare("UPDATE prato SET tipo=null WHERE id_prato = :id");
                }
                $stmt->bindParam(":id", $id_upd_p);
            }     
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $_SESSION["msg_prato"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Dados atualizados com sucesso!</div>";
                } else {
                    $_SESSION["msg_prato"] = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erro ao tentar efetivar atualização!</div>";
                }
                header("Location: home.php");
            } else {
                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
?>