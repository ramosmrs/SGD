<?php
/*
 * classe FormUsuario
 * formulário de cadastro de Usuários
 */
class UsuarioForm extends TPage
{
    private $form; // formulário

    /*
     * método construtor
     * cria a página e o formulário de cadastro
     */
    function __construct()
    {
        parent::__construct();
        // instancia um formulário
        $this->form = new TForm('form_usuario');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formulário
        $this->form->add($table);

        // cria os campos do formulário
        $codigo    = new TEntry('id');
//        $tpusuario = new TCombo('tipousuario');
        $nome      = new TEntry('nome');
        $telefone  = new TEntry('telefone');
        $email     = new TEntry('email');
        $login     = new TEntry('login');

        // define alguns atributos para os campos do formulário
        $codigo->setEditable(FALSE);
        $codigo->setSize(20);
        $nome->setSize(300);
        $telefone->setSize(300);
        $email->setSize(300);
        $login->setSize(300);

/*		$ColTipousuario = ABDTipoUsuario::ListarTodosArray();
        // adiciona objetos na combo
        foreach ($ColTipousuario as $object)
        {
            $items[$object->id] = $object->descricao;
        }
        $tpusuario->addItems($items);
*/
        // adiciona uma linha para o campo código
        $row=$table->addRow();
        $row->addCell(new TLabel('Código:'));
        $row->addCell($codigo);

        // adiciona uma linha para o campo cidade
/*        $row=$table->addRow();
        $row->addCell(new TLabel('Tipo de Usuário:'));
        $row->addCell($tpusuario);
  */      
        
        // adiciona uma linha para o campo nome
        $row=$table->addRow();
        $row->addCell(new TLabel('Nome:'));
        $row->addCell($nome);

        // adiciona uma linha para o campo endereço
        $row=$table->addRow();
        $row->addCell(new TLabel('Telefone:'));
        $row->addCell($telefone);

        // adiciona uma linha para o campo telefone
        $row=$table->addRow();
        $row->addCell(new TLabel('e-mail:'));
        $row->addCell($email);

        // adiciona uma linha para o campo cidade
        $row=$table->addRow();
        $row->addCell(new TLabel('Login:'));
        $row->addCell($login);
        
        // cria um botão de ação para o formulário
        $button1=new TButton('action1');

        // define a ação do botão
        $button1->setAction(new TAction(array($this, 'onSave')), 'Salvar');

        // adiciona uma linha para a ação do formulário
        $row=$table->addRow();
        $row->addCell('');
        $row->addCell($button1);

        // define quais são os campos do formulário
        $this->form->setFields(array($codigo, $nome, $telefone, $email, $login, $button1));

        // adiciona o formulário na página
        parent::add($this->form);
    }

    /*
     * método onEdit
     * edita os dados de um registro
     */
    function onEdit($param)
    {
  
        try
        {
            if (isset($param['key']))
            {
            	if(isset($param['key'])){
			        // obtém o parâmetro $key
			        $usuario = ABDUsuario::CarregaUsuario(intval($param['key']));
			        $usuario->tipousuario = $usuario->tipousuario->id;
			        $this->form->setData($usuario);
            	}
            }
        }
        catch (Exception $e)		    // em caso de exceção
        {
            // exibe a mensagem gerada pela exceção
            new TMessage('error', '<b>Erro</b>' . $e->getMessage());
        }
    }

    /*
     * método onSave
     * executado quando o usuário clicar no botão salvar
     */
    function onSave()
    {
        $tipousuario = $this->form->getData('ABDUsuario');
    	$mensagem = $tipousuario->Atualiza();
    	//$mensagem = $tipousuario->tipousuario;  
        new TMessage('info', $mensagem);
    }
}
?>
