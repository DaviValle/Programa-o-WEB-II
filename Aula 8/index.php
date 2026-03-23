<?php

interface DatabaseInterface
{
    public function salvarPedido(float $valor): void;
}

interface NotificacaoInterface
{
    public function enviar(string $mensagem): void;
}

interface DescontoStrategy
{
    public function calcular(float $valor): float;
}

class DescontoVip implements DescontoStrategy
{
    public function calcular(float $valor): float
    {
        return $valor * 0.2;
    }
}

class DescontoRegular implements DescontoStrategy
{
    public function calcular(float $valor): float
    {
        return $valor * 0.1;
    }
}

class DescontoNenhum implements DescontoStrategy
{
    public function calcular(float $valor): float
    {
        return 0;
    }
}

class DescontoFactory
{
    public static function criar(string $tipoCliente): DescontoStrategy
    {
        return match($tipoCliente) {
            'vip' => new DescontoVip(),
            'regular' => new DescontoRegular(),
            default => new DescontoNenhum(),
        };
    }
}

class MySQL implements DatabaseInterface
{
    public function salvarPedido(float $valor): void
    {
        echo "Salvando pedido no MySQL com valor {$valor} <br>";
    }
}

class PostgreSQL implements DatabaseInterface
{
    public function salvarPedido(float $valor): void
    {
        echo "Salvando pedido no PostgreSQL com valor {$valor} <br>";
    }
}

class Email implements NotificacaoInterface
{
    public function enviar(string $mensagem): void
    {
        echo "Enviando email: {$mensagem} <br>";
    }
}

class SMS implements NotificacaoInterface
{
    public function enviar(string $mensagem): void
    {
        echo "Enviando SMS: {$mensagem} <br>";
    }
}

class ProcessadorPedido
{
    private DescontoStrategy $descontoStrategy;
    
    public function __construct(DescontoStrategy $descontoStrategy)
    {
        $this->descontoStrategy = $descontoStrategy;
    }
    
    public function processar(float $valor): float
    {
        $desconto = $this->descontoStrategy->calcular($valor);
        return $valor - $desconto;
    }
}

class PersistenciaPedido
{
    private DatabaseInterface $database;
    
    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }
    
    public function salvar(float $valorFinal): void
    {
        $this->database->salvarPedido($valorFinal);
    }
}

class NotificadorPedido
{
    private NotificacaoInterface $notificacao;
    
    public function __construct(NotificacaoInterface $notificacao)
    {
        $this->notificacao = $notificacao;
    }
    
    public function notificar(float $valorFinal): void
    {
        $this->notificacao->enviar("Pedido no valor de {$valorFinal} processado");
    }
}

class PedidoService
{
    private ProcessadorPedido $processador;
    private PersistenciaPedido $persistencia;
    private NotificadorPedido $notificador;
    
    public function __construct(
        ProcessadorPedido $processador,
        PersistenciaPedido $persistencia,
        NotificadorPedido $notificador
    ) {
        $this->processador = $processador;
        $this->persistencia = $persistencia;
        $this->notificador = $notificador;
    }
    
    public function processarPedido(float $valor): void
    {
        $valorFinal = $this->processador->processar($valor);
        $this->persistencia->salvar($valorFinal);
        $this->notificador->notificar($valorFinal);
    }
}

?>