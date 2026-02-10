<?php

$baseUrl = "https://parallelum.com.br/fipe/api/v1/carros";

function apiFipe($url) {
    $json = file_get_contents($url);
    return json_decode($json, true);
}

if (!isset($_GET['marca'])) {
    $marcas = apiFipe("$baseUrl/marcas");

    echo "<h2>Marcas</h2>";
    foreach ($marcas as $marca) {
        echo "<a href='?marca={$marca['codigo']}'>
                {$marca['nome']}
              </a><br>";
    }
}

elseif (isset($_GET['marca']) && !isset($_GET['modelo'])) {
    $marca = $_GET['marca'];
    $modelos = apiFipe("$baseUrl/marcas/$marca/modelos");

    echo "<h2>Modelos</h2>";
    foreach ($modelos['modelos'] as $modelo) {
        echo "<a href='?marca=$marca&modelo={$modelo['codigo']}'>
                {$modelo['nome']}
              </a><br>";
    }
}

elseif (isset($_GET['marca'], $_GET['modelo']) && !isset($_GET['ano'])) {
    $marca  = $_GET['marca'];
    $modelo = $_GET['modelo'];

    $anos = apiFipe("$baseUrl/marcas/$marca/modelos/$modelo/anos");

    echo "<h2>Anos</h2>";
    foreach ($anos as $ano) {
        echo "<a href='?marca=$marca&modelo=$modelo&ano={$ano['codigo']}'>
                {$ano['nome']}
              </a><br>";
    }
}

elseif (isset($_GET['marca'], $_GET['modelo'], $_GET['ano'])) {
    $marca  = $_GET['marca'];
    $modelo = $_GET['modelo'];
    $ano    = $_GET['ano'];

    $preco = apiFipe("$baseUrl/marcas/$marca/modelos/$modelo/anos/$ano");

    echo "<h2>Preço FIPE</h2>";
    echo "Marca: {$preco['Marca']} <br>";
    echo "Modelo: {$preco['Modelo']} <br>";
    echo "Ano: {$preco['AnoModelo']} <br>";
    echo "Combustível: {$preco['Combustivel']} <br>";
    echo "<strong>Valor: {$preco['Valor']}</strong>";
}

?>