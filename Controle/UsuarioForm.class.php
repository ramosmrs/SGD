<?php
/*
 * classe FormUsuario
 * formul�rio de cadastro de Usu�rios
 */
class UsuarioForm extends TPage
{
    private $form; // formul�rio

    /*
     * m�todo construtor
     * cria a p�gina e o formul�rio de cadastro
     */
    function __construct()
    {
        parent::__construct();
        // instancia um formul�rio
        $this->form = new TForm('form_usuario');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formul�rio
        $this->form->add($table);

        // cria os campos do formul�rio
        $codigo    = new TEntry('id');
//        $tpusuario = new TCombo('tipousuario');
        $nome      = new TEntry('nome');
        $telefone  = new TEntry('telefone');
        $email     = new TEntry('email');
        $login     = new TEntry('login');

        // define alguns atributos para os campos do formul�rio
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
        // adiciona uma linha para o campo c�digo
        $row=$table->addRow();
        $row->addCell(new TLabel('C�digo:'));
        $row->addCell($codigo);

        // adiciona uma linha para o campo cidade
/*        $row=$table->addRow();
        $row->addCell(new TLabel('Tipo de Usu�rio:'));
        $row->addCell($tpusuario);
  */      
        
        // adiciona uma linha para o campo nome
        $row=$table->addRow();
        $row->addCell(new TLabel('Nome:'));
        $row->addCell($nome);

        // adiciona uma linha para o campo endere�o
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
        
        // cria um bot�o de a��o para o formul�rio
        $button1=new TButton('action1');

        // define a a��o do bot�o
        $button1->setAction(new TAction(array($this, 'onSave')), 'Salvar');

        // adiciona uma linha para a a��o do formul�rio
        $row=$table->addRow();
        $row->addCell('');
        $row->addCell($button1);

        // define quais s�o os campos do formul�rio
        $this->form->setFields(array($codigo, $nome, $telefone, $email, $login, $button1));

        // adiciona o formul�rio na p�gina
        parent::add($this->form);
    }

    /*
     * m�todo onEdit
     * edita os dados de um registro
     */
    function onEdit($param)
    {
  
        try
        {
            if (isset($param['key']))
            {
            	if(isset($param['key'])){
			        // obt�m o par�metro $key
			        $usuario = ABDUsuario::CarregaUsuario(intval($param['key']));
			        $usuario->tipousuario = $usuario->tipousuario->id;
			        $this->form->setData($usuario);
            	}
            }
        }
        catch (Exception $e)		    // em caso de exce��o
        {
            // exibe a mensagem gerada pela exce��o
            new TMessage('error', '<b>Erro</b>' . $e->getMessage());
        }
    }

    /*
     * m�todo onSave
     * executado quando o usu�rio clicar no bot�o salvar
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
