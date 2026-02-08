<?php

    $dados = file_get_contents('dados.json');

    $dados = json_decode($dados);
    $dados = $dados?:[];


    echo "ul";
    foreach($dados as $dado){
        echo "<li>ID: {$dado->id} nome: {$dado->nome} preco: {$dado->preco} descricao {$dado->descricao} categoria: {$dado->categoria} <li>";
    }
    echo "</ul>";
    echo "<a href='index.html'> Voltar </a>"


?>