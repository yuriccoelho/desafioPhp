<?php 

function cadastraProduto($nomeProduto, $precoProduto, $descProduto,  $imgProduto){
    $nomeArquivo = "produto.json";

    if(file_exists($nomeArquivo)){
        //abrindo e pegando informações do arquivo
        $arquivo = file_get_contents($nomeArquivo);
        //transformar json em array
        $produtos = json_decode($arquivo, true);
        //adicionando um novo produto na array
        $produtos[] = ["nome"=>$nomeProduto, "preco"=>$precoProduto, "desc"=>$descProduto, "imgProduto"=>$imgProduto];
        $json = json_encode($produtos);
        //salvando o json dentro de um arquivo;
        $deuCerto = file_put_contents($nomeArquivo, $json);

        if($deuCerto){
            return "Não é feitiçaria, é tecnologia!";
        } else {
            return "É leviosa, não leviosá!";
        }

    }else {
        $produtos = [];
        //array_push
        $produtos[] = ["nome"=>$nomeProduto, "preco"=>$precoProduto, "desc"=>$descProduto, "imgProduto"=>$imgProduto];
        //transformando array em json
        $json = json_encode($produtos);
        //salvando o json dentro de um arquivo
        $deuCerto = file_put_contents($nomeArquivo, $json);

        if($deuCerto){
            return "Não é feitiçaria, é tecnologia!";
        } else {
            return "É leviosa, não leviosá!";
        }


    }
}

if($_POST){
    //salvando arquivo
    $nomeImg = $_FILES['imgProduto']['name'];
    $localTmp = $_FILES['imgProduto']['tmp_name'];
    $dataAtual = date("d-m-y");
    $caminhoSalvo = 'img/'.$dataAtual.$nomeImg;
    
    
    $deuCerto = move_uploaded_file($localTmp, $caminhoSalvo);
    echo cadastraProduto($_POST['nomeProduto'], $_POST['precoProduto'], $_POST['descProduto'], $caminhoSalvo);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Cadastro Produto</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1> Cadastro de Produto </h1>
            </div>
            <div class="col-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nomeProduto" placeholder="Nome do Produto "/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="categoriaProduto" placeholder="Categoria do Produto "/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="descProduto" placeholder="Descrição do Produto "/>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" name="imgProduto" placeholder="Imagem do Produto "/>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="precoProduto" placeholder="Preço do Produto "/>
                    </div>
                    <button class="btn btn-success">Cadastrar Produto</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>