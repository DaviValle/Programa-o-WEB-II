<?php

    $dados = file_get_contents('dados.json');

    $dados = json_decode($dados);
    $dados = $dados?:[];

    echo "ul";
    foreach($dados as $dado){
        echo "<li>ID: {$dado->id} Username: {$dado->username} Email: {$dado->email} Password {$dado->password} <li>";
    }
    echo "</ul>";
    echo "<a href='index.html'> Voltar </a>"


?>