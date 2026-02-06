<?php
    echo "<style>body { font-size: 20px; }</style>";

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $imagem_nome = $_FILES['imagem']['name'];
    $imagem_tmp = $_FILES['imagem']['tmp_name'];
    move_uploaded_file($imagem_tmp, "imagens/" . $imagem_nome);
    
    echo "ID: " . $id . "<br>";
    echo "<p></p>";
    echo "Nome: " . $nome . "<br>";
    echo "<p></p>";
    echo "Preço: " . $preco . "<br>";
    echo "<p></p>";
    echo "Descrição: " . $descricao . "<br>";
    echo "<p></p>";
    echo "Categoria: " . $categoria . "<br>";
    echo "<p></p>";
    echo "Imagem: <img src='imagens/" . $imagem_nome . "' width='200'>";
?>