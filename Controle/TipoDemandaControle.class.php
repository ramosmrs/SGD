<?php

class TipoDemandaControle extends TPage
{
    private $form;     // formulário de buscas
    private $datagrid; // listagem
    private $loaded;

    public function __construct()
    {
        parent::__construct();

        if($_SESSION['usuario']->sistema != 'SGA'){
    	//	new TMessage('error', 'Somente administradores podem utilizar o cadastro de tipo de demanda.');
        }
        else{
        
        // instancia um formulário
        $this->form = new TForm('form_busca_TipoDemanda');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formulário
        $this->form->add($table);
        // cria os campos do formulário
        $id = new TEntry('id');
        $descricao = new TEntry('descricao');
		$id->setEditable(false);
		$id->setSize(50);
		
        // adiciona uma linha para o campo nome
        $row=$table->addRow();
        $row->addCell(new TLabel('Código:'));
        $row->addCell($id);
		
		// adiciona uma linha para o campo nome
        $row=$table->addRow();
        $row->addCell(new TLabel('Descricao:'));
        $row->addCell($descricao);

        // cria dois botões de ação para o formulário
        $new_button = new TButton('cadastra');

        // define as ações dos botões
        $new_button->setAction(new TAction(array($this, 'onSave')), 'Cadastrar');

	        // adiciona uma linha para aas ações do formulário
	        $row=$table->addRow();
	        $row->addCell($new_button);
        
        // define quais são os campos do formulário
        $this->form->setFields(array($id, $descricao, $new_button));
        }
        // instancia objeto DataGrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->align = 'left';
        // instancia as colunas da DataGrid
        $codigo   = new TDataGridColumn('id',         'Código', 'right', 50);
        $nome     = new TDataGridColumn('descricao',  'Descrição', 'left', 140);

        // adiciona as colunas à DataGrid
        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($nome);

        // instancia duas ações da DataGrid
        $action1 = new TDataGridAction(array($this, 'onEdit'));
        $action1->setLabel('Editar');
        $action1->setImage('ico_edit.png');
        $action1->setField('id');

        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel('Deletar');
        $action2->setImage('ico_delete.png');
        $action2->setField('id');
        
        if($_SESSION['usuario']->sistema == 'SGA'){
	        // adiciona as ações à DataGrid
	        $this->datagrid->addAction($action1);
	        $this->datagrid->addAction($action2);
        }
        // cria o modelo da DataGrid, montando sua estrutura
        $this->datagrid->createModel();

        // monta a página através de uma tabela
        $table = new TTable;
        $table->width='100%';

        //Título da página
        $tbtitulo = new TTable;
        $Titulo = new TLabel('Cadastro dos tipos de demandas');
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
        
        
        // cria uma linha para o formulário
        $row = $table->addRow();
        $row->addCell($this->form);

        // cria uma linha para a datagrid
        $row = $table->addRow();
        $row->addCell($this->datagrid);

        // adiciona a tabela à página
        parent::add($table);
    }
    
    function onReload()
    {
		$tpusuario = array();
		$tpusuario = ABDTipoDemanda::ListarTodosArray();
        $this->datagrid->clear();
        if ($tpusuario)
        {
            foreach ($tpusuario as $tpu)
            {
                // adiciona o objeto na DataGrid
                $this->datagrid->addItem($tpu);
            }
        }

        // finaliza a transação
        $this->loaded = true;
    }

    function onSave()
    {
    	// inicia transação com o banco 'pg_livro'
        // obtém os dados no formulário em um objeto Cidade
        $TipoDemanda = $this->form->getData('ABDTipoDemanda');
    	$mensagem = $TipoDemanda->Atualiza();  
        // recarrega listagem
        $this->onReload();
        new TMessage('info', $mensagem);
    }    
    
    function onEdit($param)
    {
        // obtém o parâmetro $key
        $tpusuario = ABDTipoDemanda::CarregaTipoDemanda($param['key']);
        $this->form->setData($tpusuario);
        $this->onReload();
    }
    
    
    function onDelete($param)
    {
        // obtém o parâmetro $key
        $key=$param['key'];

        // define duas ações
        $action1 = new TAction(array($this, 'Delete'));
        $action2 = new TAction(array($this, 'teste'));

        // define os parâmetros de cada ação
        $action1->setParameter('key', $key);
        $action2->setParameter('key', $key);

        // exibe um diálogo ao usuário
        new TQuestion('Deseja realmente excluir o registro?', $action1, $action2);
    }
    
    function Delete($param)
    {
        // obtém o parâmetro $key
        //$key=$param['key'];

		$tpusuario = new ABDTipoDemanda();
		$tpusuario->id = $param['key'];
		$mensagem = $tpusuario->Exclui();
        
        // recarrega a datagrid
        $this->onReload();

        // exibe mensagem de sucesso
        new TMessage('info', $mensagem);
    }

    
    
    function show()
    {
        // se a listagem ainda não foi carregada
        if (!$this->loaded)
        {
            $this->onReload();
        }
        parent::show();
    }
}
    
?>