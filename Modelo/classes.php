<?php
class Tipousuario {
	public $id;
	public $descricao;
}

class Usuario {
	public $id;
	public $tipousuario;
	public $nome;
	public $telefone;
	public $email;
	public $login;
	public $senha;
}

class Equipe {
	public $id;
	public $descricao;
}

class UsuarioEquipe {
	public $usuario;
	public $equipe;	
}

class TipoDemanda {
	public $id;
	public $descricao;
}

class EquipeTipoDemanda {
	public $equipe;
	public $tipodemanda;
}

class Prioridade {
	public $id;
	public $descricao;	
}

class Situacao {
	public $id;
	public $descricao;
}

class Demanda {
	public $id;
	public $tipodemanda;
	public $prioridade;
	public $situacao;
	public $titulo;
	public $descricao;
	public $dataentrada;
}

class EquipeDemanda {
	public $id;
	public $equipe;
	public $demanda;
}

class FaseResolucao {
	public $id;
	public $descricao;
}

class HistoricoDemanda {
	public $id;
	public $equipe;
	public $demanda;
	public $situacao;
	public $data;
	public $descricao;
}

class BaseConhecimento {
	public $id;
	public $demanda;
	public $historicodemanda;
	public $data;
	public $descricao;
}

?>