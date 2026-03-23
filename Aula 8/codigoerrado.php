<?php

class Pedido
{
    private $tipoCliente;
    private $valor;
    private $db;

    public function __construct($tipoCliente, $valor)
    {
        $this->tipoCliente = $tipoCliente;
        $this->valor = $valor;

        // Dependência concreta (violação DIP)
        $this->db = new MySQL();
    }

    public function processarPedido()
    {
        // Regra de negócio + persistência + comunicação (violação SRP)

        $desconto = 0;

        // Condicionais de tipo (violação OCP)
        if ($this->tipoCliente == 'vip') {
            $desconto = $this->valor * 0.2;
        } elseif ($this->tipoCliente == 'regular') {
            $desconto = $this->valor * 0.1;
        }

        $valorFinal = $this->valor - $desconto;

        // Salva no banco
        $this->db->salvarPedido($valorFinal);

        // Envia notificação
        $email = new Email();
        $email->enviar("Pedido no valor de {$valorFinal} processado");
    }
}

class MySQL
{
    public function salvarPedido($valor)
    {
        echo "Salvando pedido no MySQL com valor {$valor} <br>";
    }
}

class Email
{
    public function enviar($mensagem)
    {
        echo "Enviando email: {$mensagem} <br>";
    }
}
?>