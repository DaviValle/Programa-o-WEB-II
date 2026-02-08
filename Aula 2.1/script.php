<?php

    $dados = file_get_contents('dados.json');

    $dados = json_decode($dados,true);
     $dados = $dados ?:[];
    
    $last = 0;
    foreach($dados as $dado){
        if($dado ['id'] > $lastId){
            $lastId = $dado['id'];
        }
    }
    $lastId = $lastId + 1;

    $novo = [
        'id' => $lastId,
        'nome' => $_POST['nome'],
        'preco' => $POST['preco'],
        'descricao' => $_POST['descricao'],
        'categoria' => $_POST['categoria'],
        'imagem' => $_FILE['imagem'],
    ];


    $dados[] = $novo;
    $dados = json_encode($dados);
    file_put_contents('dados.json',$dados);
    header('Location: index.html');

?>