<?php
/*
 * classe ConcluiVenda
 * formulário de conclusão de venda
 */
class LoginDialogoForm extends TForm
{
    public $button;	   // botão de ação do formulário

    /*
     * método construtor
     * Cria a página e o formulário de cadastro
     */
    function __construct()
    {
        parent::__construct('form_conclui_venda');
        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formulário
        parent::add($table);

        // cria os campos do formulário
        $usuario = new TEntry('usuario');
        $senha   = new TPassword('senha');

        // define alguns atributos para os campos do formulário
        $usuario->setSize(100);
        $senha->setSize(100);
        
        $row=$table->addRow();
        $row->addCell(new TLabel('Usuário:'));
        $row->addCell($usuario);
        $row=$table->addRow();
        $row->addCell(new TLabel('Senha:'));
        $row->addCell($senha);
        
        // cria um botão de ação para o formulário
        $this->button=new TButton('action1');

        // adiciona uma linha para as ações do formulário
        $row=$table->addRow();
        $row->addCell('');
        $row->addCell($this->button);

        // define quais são os campos do formulário
        parent::setFields(array($usuario, $senha, $this->button));
    }
}
?>
