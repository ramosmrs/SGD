<?php
/*
 * classe ConcluiVenda
 * formul�rio de conclus�o de venda
 */
class UsuarioDemandaForm extends TForm
{
    public $button;	   // bot�o de a��o do formul�rio

    /*
     * m�todo construtor
     * Cria a p�gina e o formul�rio de cadastro
     */
    function __construct()
    {
        parent::__construct('form_conclui_venda');
        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formul�rio
        parent::add($table);

        // cria os campos do formul�rio
        $usuario  = new TCombo('usuario');

        // define alguns atributos para os campos do formul�rio
        $usuario->setSize(250);
        
        // adiciona uma linha para o campo tipo de demanda
        $ColUsuario = ABDUsuario::ListarTodosArray();
        
        // adiciona objetos na combo
        foreach ($ColUsuario as $object1)
        {
            $items1[$object1->id] = $object1->nome;
        }
        $usuario->addItems($items1);
        $row=$table->addRow();
        $row->addCell(new TLabel(' '));
        $row=$table->addRow();
        $row->addCell(new TLabel('Usu�rio:'));
        $row->addCell($usuario);
        
        // cria um bot�o de a��o para o formul�rio
        $this->button=new TButton('action1');

        // adiciona uma linha para as a��es do formul�rio
        $row=$table->addRow();
        $row->addCell('');
        $row->addCell($this->button);

        // define quais s�o os campos do formul�rio
        parent::setFields(array($usuario, $this->button));
    }
}
?>
