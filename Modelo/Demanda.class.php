<?php 

class Demanda {
	public $id;
	public $tipodemanda;
	public $prioridade;
	public $situacao;
	public $titulo;
	public $descricao;
	public $dataentrada;
	public $usuario;
	public $responsavel;
	public $fase;
	
	function __construct()
    {
    	$tipodemanda = new TipoDemanda();
    	$prioridade = new Prioridade();
    	$situacao = new Situacao();
    	$usuario = new Usuario();
    	$responsavel = new Usuario();
    	$fase = new FaseResolucao();
    }
    
    
}

?>