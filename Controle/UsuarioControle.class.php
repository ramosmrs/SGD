<?php
    	
class UsuarioControle extends TPage
{
    private $form;     // formul�rio de buscas
    private $datagrid; // listagem
    private $loaded;

    public function __construct()
    {
    	
        parent::__construct();
        // instancia um formul�rio
        $this->form = new TForm('form_busca_Usuario');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formul�rio
        $this->form->add($table);

        // cria dois bot�es de a��o para o formul�rio
        $new_button = new TButton('cadastra');

        
        // define as a��es dos bot�es
        $form = new UsuarioForm();
        $new_button->setAction(new TAction(array($form, 'onEdit')), 'Novo Usu�rio');


/*        // Teste
        $janela = new TWindow('Ajuda');
        $janela->setPosition(900,250);
        $janela->setSize(250,180);
        $janela->add($form);
        $janela->show();
 */      
        if($_SESSION['usuario']->sistema != 'SGA'){
    	//	new TMessage('error', 'Somente administradores podem utilizar o cadastro de usu�rios.');
        }
        else{
        // adiciona uma linha para aas a��es do formul�rio
        $row=$table->addRow();
        $row->addCell($new_button);
        	
        }

        // define quais s�o os campos do formul�rio
        $this->form->setFields(array($new_button));
        
        // instancia objeto DataGrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->align = 'left';
        // instancia as colunas da DataGrid
        $codigo   = new TDataGridColumn('id',    'C�digo', 'right', 50);
        $nome     = new TDataGridColumn('nome',  'Nome', 'left', 140);

        // adiciona as colunas � DataGrid
        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($nome);

        // instancia duas a��es da DataGrid
        $action1 = new TDataGridAction(array($form, 'onEdit'));
        $action1->setLabel('Editar');
        $action1->setImage('ico_edit.png');
        $action1->setField('id');

        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel('Deletar');
        $action2->setImage('ico_delete.png');
        $action2->setField('id');

        if($_SESSION['usuario']->sistema == 'SGA'){
        
        // adiciona as a��es � DataGrid
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);
        }
        // cria o modelo da DataGrid, montando sua estrutura
        $this->datagrid->createModel();

        // monta a p�gina atrav�s de uma tabela
        $table = new TTable;
        $table->width='100%';

        //T�tulo da p�gina
        $tbtitulo = new TTable;
        $Titulo = new TLabel('Cadastro dos Usu�rios');
        $Titulo->setFontSize(20);
        $Titulo->setFontColor('#003580');
        $spacer = new TLabel('  ');
        $spacer->setFontSize(25);
        $row=$tbtitulo->addrow();
		$row->addCell($Titulo);
		$row=$tbtitulo->addrow();
		$row->addCell($spacer);
        $row = $table->addRow();
        $row->addCell($tbtitulo);
        
        // cria uma linha para o formul�rio
        $row = $table->addRow();
        $row->addCell($this->form);

        // cria uma linha para a datagrid
        $row = $table->addRow();
        $row->addCell($this->datagrid);

        // adiciona a tabela � p�gina
        parent::add($table);
    }
    
    function onReload()
    {
		$tpusuario = array();
		$tpusuario = ABDUsuario::ListarTodosArray();
        $this->datagrid->clear();
        if ($tpusuario)
        {
            foreach ($tpusuario as $tpu)
            {
                // adiciona o objeto na DataGrid
                $this->datagrid->addItem($tpu);
            }
        }

        $this->loaded = true;
    }

    function onDelete($param)
    {
        // obt�m o par�metro $key
        $key=$param['key'];

        // define duas a��es
        $action1 = new TAction(array($this, 'Delete'));
        $action2 = new TAction(array($this, 'teste'));

        // define os par�metros de cada a��o
        $action1->setParameter('key', $key);
        $action2->setParameter('key', $key);

        // exibe um di�logo ao usu�rio
        new TQuestion('Deseja realmente excluir o registro?', $action1, $action2);
    }
    
    function Delete($param)
    {
        // obt�m o par�metro $key
        //$key=$param['key'];

		$tpusuario = new ABDUsuario();
		$tpusuario->id = $param['key'];
		$mensagem = $tpusuario->Exclui();
        
        // recarrega a datagrid
        $this->onReload();

        // exibe mensagem de sucesso
        new TMessage('info', $mensagem);
    }

    function show()
    {
        // se a listagem ainda n�o foi carregada
        if (!$this->loaded)
        {
            $this->onReload();
        }
        parent::show();
    }
}
    
?>