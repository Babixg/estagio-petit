<?php
    require_once("conexao.php");

    // Verificar se foi enviado dados via POST
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
            //foto
            $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
            $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";
            $ingredientes = (isset($_POST["ingredientes"]) && $_POST["ingredientes"] != null) ? $_POST["ingredientes"] : "";
            $name = (isset($_POST["name"]) && $_POST["name"] != null) ? $_POST["name"] : "";
            $description = (isset($_POST["description"]) && $_POST["description"] != null) ? $_POST["description"] : "";
            $ingredients = (isset($_POST["ingredients"]) && $_POST["ingredients"] != null) ? $_POST["ingredients"] : "";
            $nombre = (isset($_POST["nombre"]) && $_POST["nombre"] != null) ? $_POST["nombre"] : "";
            $descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != null) ? $_POST["descripcion"] : "";
            $ingredienteses = (isset($_POST["ingredienteses"]) && $_POST["ingredienteses"] != null) ? $_POST["ingredienteses"] : "";
        } else if (!isset($id)) {
            // Se não se não foi setado nenhum valor para variável $id
            $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
            //foto
            $nome = null;
            $descricao = null;
            $ingredientes = null;
            $name = null;
            $description = null;
            $ingredients = null;
            $nombre = null;
            $descripcion = null;
            $ingredienteses = null;
        }

    //Salvar
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save") {
        try {
        //Foto
            $arquivo = $_FILES['arquivo']['name'];

            //Pasta onde o arquivo vai ser salvo
            $_UP['pasta'] = '../assets/img/uploads/';

            //Tamanho máximo do arquivo em Bytes
            $_UP['tamanho'] = 1024*1024*100; //5mb
            
            //Array com a extensões permitidas
            $_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
            
            //Renomeiar
            $_UP['renomeia'] = true;
            
            //Erros e verificações
                //Array com os tipos de erros de upload do PHP
                $_UP['erros'][0] = 'Não houve erro';
                $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
                $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
                $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
                $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
                
                //Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
                if($_FILES['arquivo']['error'] != 0){
                    die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
                    exit; //Para a execução do script
                }
                
                //Faz a verificação da extensao do arquivo
                $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
                if(array_search($extensao, $_UP['extensoes'])=== false){
                    echo "
                        <script type=\"text/javascript\">
                            alert(\"A imagem não foi cadastrada. Extensão inválida.\");
                        </script>
                    ";
                }
            
                //Faz a verificação do tamanho do arquivo
                else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
                    echo "
                        <script type=\"text/javascript\">
                            alert(\"Arquivo muito grande.\");
                        </script>
                    ";
                }
            
            //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
                else{
                    //Primeiro verifica se deve trocar o nome do arquivo
                    if($_UP['renomeia'] == true){
                        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                        $foto = time().'.jpg';
                    } else{
                        //mantem o nome original do arquivo
                        $foto = $_FILES['arquivo']['name'];
                    }

                    // //Verificar se é possivel mover o arquivo para a pasta escolhida
                    if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta']. $foto)){
                        //Upload efetuado com sucesso, exibe a mensagem
                        echo "
                            <script type=\"text/javascript\">
                                alert(\"Imagem cadastrada com Sucesso.\");
                            </script>
                        ";  
                    } else{
                        //Upload não efetuado com sucesso, exibe a mensagem
                        echo "
                            <script type=\"text/javascript\">
                                alert(\"Imagem não foi cadastrada com sucesso.\");
                            </script>
                        ";
                    }
                }

        //Dados gerais
            $stmt = $conexao->prepare("INSERT INTO itens(id_item, foto, nome, descricao, ingredientes, name, description, ingredients, nombre, descripcion, ingredienteses) VALUES (:id, :foto, :nome, :descricao, :ingredientes, :name, :description, :ingredients, :nombre, :descripcion, :ingredientes)");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":foto", $foto);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":descricao", $descricao);
            $stmt->bindParam(":ingredientes", $ingredientes);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":ingredients", $ingredients);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->bindParam(":ingredienteses", $ingredienteses);
        
        //Inserção
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0){

                    $_SESSION["msg_prato"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Dados cadastrados com sucesso!</div>";

                    $id = null;
                    $foto = null;
                    $nome = null;
                    $descricao = null;
                    $ingredientes = null;
                    $name = null;
                    $description = null;
                    $ingredients = null;
                    $nombre = null;
                    $descripcion = null;
                    $ingredienteses = null;
                    $tipo = null;
                } else {
                    $_SESSION["msg_prato"] = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erro ao tentar efetivar cadastro!</div>";
                }
                header("Location: itens.php");
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "<script type=\"text/javascript\">
                 alert(" .$erro->getMessage(). ")
                 </script>";
        }
    }

    //Atualizar
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd") {
        try {

        //Foto
            $arquivo = $_FILES['arquivo']['name'];

            //Pasta onde o arquivo vai ser salvo
            $_UP['pasta'] = '../assets/img/uploads/';

            //Tamanho máximo do arquivo em Bytes
            $_UP['tamanho'] = 1024*1024*100; //5mb
            
            //Array com a extensões permitidas
            $_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
            
            //Renomeiar
            $_UP['renomeia'] = true;
            
            //Erros e verificações
                //Array com os tipos de erros de upload do PHP
                $_UP['erros'][0] = 'Não houve erro';
                $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
                $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
                $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
                $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
                
                //Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
                if($_FILES['arquivo']['error'] != 0){
                    die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
                    exit; //Para a execução do script
                }
                
                //Faz a verificação da extensao do arquivo
                $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
                if(array_search($extensao, $_UP['extensoes']) === false){        
                    echo "
                        <script type=\"text/javascript\">
                            alert(\"A imagem não foi cadastrada. Extensão inválida.\");
                        </script>
                    ";
                }
            
                //Faz a verificação do tamanho do arquivo
                else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
                    echo "
                        <script type=\"text/javascript\">
                            alert(\"Arquivo muito grande.\");
                        </script>
                    ";
                }
            
            //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
                else{
                    //Primeiro verifica se deve trocar o nome do arquivo
                    if($_UP['renomeia'] == true){
                        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                        $foto = time().'.jpg';
                    } else{
                        //mantem o nome original do arquivo
                        $foto = $_FILES['arquivo']['name'];
                    }

                    // //Verificar se é possivel mover o arquivo para a pasta escolhida
                    if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta']. $foto)){
                        //Upload efetuado com sucesso, exibe a mensagem
                        echo "
                            <script type=\"text/javascript\">
                                alert(\"Imagem cadastrada com Sucesso.\");
                            </script>
                        ";  
                    } else{
                        //Upload não efetuado com sucesso, exibe a mensagem
                        echo "
                            <script type=\"text/javascript\">
                                alert(\"Imagem não foi cadastrada.\");
                            </script>
                        ";
                    }
                }

        //Demais dados
            if ($id != "") {
                $stmt = $conexao->prepare("UPDATE itens SET foto=:foto, 
                    nome=:nome, descricao=:descricao, ingredientes=:ingredientes, 
                    name=:name, description=:description, ingredients=:ingredients, 
                    nombre=:nombre, descripcion=:descripcion, ingredienteses=:ingredienteses 
                WHERE id_item = :id");

                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":foto", $foto);
            
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":ingredientes", $ingredientes);
                
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":description", $description);
                $stmt->bindParam(":ingredients", $ingredients);
                
                $stmt->bindParam(":nombre", $nombre);
                $stmt->bindParam(":descripcion", $descripcion);
                $stmt->bindParam(":ingredienteses", $ingredienteses);
            } 
                     
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $_SESSION["msg_prato"] = "<div class='alert alert-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Dados atualizados com sucesso!</div>";
                    $id = null;
                    $foto = null;

                    $nome = null;
                    $descricao = null;
                    $ingredientes = null;

                    $name = null;
                    $description = null;
                    $ingredients = null;

                    $nombre = null;
                    $descripcion = null;
                    $ingredienteses = null;
                    
                } else {
                    $_SESSION["msg_prato"] = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erro ao tentar efetivar atualização!</div>";
                }
                header("Location: itens.php");
            } else {
                   throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
           echo "<script type=\"text/javascript\">
                    alert(" .$erro->getMessage(). ")
                </script>";
        }
    }

    //Selecione
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "sel") {
        try {
            $stmt = $conexao->prepare("SELECT * FROM itens WHERE id_item = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                $id = $rs->id_item;
                $foto = $rs->foto;
                $nome = $rs->nome;
                $descricao = $rs->descricao;
                $ingredientes = $rs->ingredientes;
                $name = $rs->name;
                $description = $rs->description;
                $ingredients = $rs->ingredients;
                $nombre = $rs->nombre;
                $descripcion = $rs->descripcion;
                $ingredienteses = $rs->ingredienteses;
    
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "<script type=\"text/javascript\">
                    alert(" .$erro->getMessage(). ")
                </script>";
        }
    }

    //DELETAR
    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del") {
        try {
            $stmt = $conexao->prepare("DELETE FROM itens WHERE id_item = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $rmv = $conexao->prepare("DELETE FROM itens_categoria WHERE item_id = :item_id");
                $rmv->bindParam(":item_id", $id);
                $rmv->execute();

                echo "<script type=\"text/javascript\">
                        alert(\"Imagem não foi cadastrada com sucesso.\");
                    </script>";
                $id = null;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
            header("Location: itens.php");
        } catch (PDOException $erro) {
            echo "<script type=\"text/javascript\">
                    alert(" .$erro->getMessage(). ")
                </script>";
        }
    }

?>