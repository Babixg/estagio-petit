<?php
    require_once("conexao.php");

    // Verificar se foi enviando dados via POST
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
            $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
            $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";
            $name = (isset($_POST["name"]) && $_POST["name"] != null) ? $_POST["name"] : "";
            $description = (isset($_POST["description"]) && $_POST["description"] != null) ? $_POST["description"] : "";
            $nombre = (isset($_POST["nombre"]) && $_POST["nombre"] != null) ? $_POST["nombre"] : "";
            $descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != null) ? $_POST["descripcion"] : "";
        } else if (!isset($id)) {
            // Se não se não foi setado nenhum valor para variável $id
            $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
            $nome = null;
            $descricao = null;
            $name = null;
            $description = null;
            $nombre = null;
            $descripcion = null;
            $categoria_id = null;
        }

    //Salvar
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save") {
        try {
            $stmt = $conexao->prepare("INSERT INTO categoria(id_categoria, nome, descricao, name, description, nombre, descripcion) VALUES (:id_categoria, :nome, :descricao, :name, :description, :nombre, :descripcion)");
            $stmt->bindParam(":id_categoria", $id);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":descricao", $descricao);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":descripcion", $descripcion);

        //Inserção
            //Categoria foi criada
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    //Item(ns) foi(ram) marcado(s)
                    if(isset($_POST["cbitem"])){
                        //Inserir em itens_categorias os itens marcados para essa categoria
                        //O relacionamento é de muitos para muitos

                        //Último id inserido, sistema vai ser usado por 1 pessoa apenas, risco baixo de conflito
                        $busca = $conexao->prepare("select id_categoria from categoria order by id_categoria desc limit 1;");
                        $busca->execute();    
                        $categoria_id = $busca->fetch(\PDO::FETCH_ASSOC);
                        $categoria_id = (int) $categoria_id['id_categoria'];

                        //Inserir para cada item marcado um relacionamento com a categoria
                        foreach($_POST["cbitem"] as $cbitem){
                            $stmt = $conexao->prepare("INSERT INTO itens_categoria(categoria_id, item_id) VALUES (:categoria_id, :item_id)");
                            $stmt->bindParam(":categoria_id", $categoria_id);
                            $stmt->bindParam(":item_id", $cbitem);
                            $stmt->execute();
                        }
                    }
                    $_SESSION["msg_categoria"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Dados cadastrados com sucesso !</div>";
                    $cbitem = null;
                    $id = null;
                    $nome = null;
                    $descricao = null;
                    $name = null;
                    $description = null;
                    $nombre = null;
                    $descripcion = null;
                } else {
                    $_SESSION["msg_categoria"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erro ao tentar efetivar o cadastro !</div>";
                }
            } 
            else {
                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
            header("Location: categorias.php");
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    //Atualizar
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd") {
        try {
            if ($id != "") {
                $stmt = $conexao->prepare("UPDATE categoria SET nome=:nome, descricao=:descricao, name=:name, description=:description, nombre=:nombre, descripcion=:descripcion WHERE id_categoria = :id_categoria");

                $stmt->bindParam(":id_categoria", $id); 

                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":descricao", $descricao);

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":description", $description);

                $stmt->bindParam(":nombre", $nombre);
                $stmt->bindParam(":descripcion", $descripcion);
            }

            //Categoria foi atualizada
            
            if ($stmt->execute()) { 
                if ($stmt->rowCount() >= 0) { //As alterações podem ter sido no nome ou não
                    var_dump($stmt);
                    //Checkboxes não marcadas não são enviadas. Apagar todos os registros de itens_categoria dessa categoria e recriar com as novas definições.
                    $rmv_existentes = $conexao->prepare("DELETE FROM itens_categoria WHERE categoria_id = :categoria_id");
                    $rmv_existentes->bindParam(":categoria_id", $id);

                    $rmv_existentes->execute();

                    //Inserir para cada item marcado um relacionamento com a categoria
                    foreach($_POST["cbitem"] as $cbitem){
                        $stmt = $conexao->prepare("INSERT INTO itens_categoria(categoria_id, item_id) VALUES (:categoria_id, :item_id)");
                        $stmt->bindParam(":categoria_id", $id);
                        $stmt->bindParam(":item_id", $cbitem);
                        $stmt->execute();
                    }

                    $_SESSION["msg_categoria"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Dados atualizados com sucesso !</div>";
                    $cbitem = null;
                    $id = null;
                    $nome = null;
                    $descricao = null;
                    $name = null;
                    $description = null;
                    $nombre = null;
                    $descripcion = null;
                } else {
                    $_SESSION["msg_categoria"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erro ao tentar efetivar a atualização !</div>";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
            header("Location: categorias.php");
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    //Selecionar
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "sel") {
        try {
            $stmt = $conexao->prepare("SELECT * FROM categoria WHERE id_categoria = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                $id = $rs->id_categoria;
                $nome = $rs->nome;
                $descricao = $rs->descricao;
                $name = $rs->name;
                $description = $rs->description;
                $nombre = $rs->nombre;
                $descripcion = $rs->descripcion;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }

    //Deletar
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del") {
        try {
            $stmt = $conexao->prepare("DELETE FROM categoria WHERE id_categoria = :id_categoria");
            $stmt->bindParam(":id_categoria", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                //Apagar resultados que contenham essa categoria também

                $rmv = $conexao->prepare("DELETE FROM itens_categoria WHERE categoria_id = :categoria_id");
                $rmv->bindParam(":categoria_id", $id);
                $rmv->execute();

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

    //Filtrar
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "filtro") {
        try {
            $stmt = $conexao->prepare("SELECT itens.* FROM itens_categoria INNER JOIN itens ON itens.id_item = itens_categoria.item_id INNER JOIN categoria ON categoria.id_categoria = itens_categoria.categoria_id WHERE categoria.id_categoria = :id_categoria");
            $stmt->bindParam(":id_categoria", $id, PDO::PARAM_INT);
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }


?>

