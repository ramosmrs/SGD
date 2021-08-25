<?php

class FaseResolucaoControle extends TPage
{
    private $form;     // formulсrio de buscas
    private $datagrid; // listagem
    private $loaded;

    public function __construct()
    {
        parent::__construct();
        // instancia um formulсrio
        $this->form = new TForm('form_busca_FaseResolucao');

        // instancia uma tabela
        $table = new TTable;
        // adiciona a tabela ao formulсrio
        $this->form->add($table);
        // cria os campos do formulсrio
        $id = new TEntry('id');
        $descricao = new TEntry('descricao');
		$id->setEditable(false);
		$id->setSize(50);
		
        // adiciona uma linha para o campo nome
        $row=$table->addRow();
        $row->addCell(new TLabel('Cѓdigo:'));
        $row->addCell($id);
		
		// adiciona uma linha para o campo nome
        $row=$table->addRow();
        $row->addCell(new TLabel('Descricao:'));
        $row->addCell($descricao);

        // cria dois botѕes de aчуo para o formulсrio
        $new_button = new TButton('cadastra');

        // define as aчѕes dos botѕes
        $new_button->setAction(new TAction(array($this, 'onSave')), 'Cadastrar');

        // adiciona uma linha para aas aчѕes do formulсrio
        $row=$table->addRow();
        $row->addCell($new_button);

        // define quais sуo os campos do formulсrio
        $this->form->setFields(array($id, $descricao, $new_button));

        // instancia objeto DataGrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->align = 'center';
        // instancia as colunas da DataGrid
        $codigo   = new TDataGridColumn('id',         'Cѓdigo', 'right', 50);
        $nome     = new TDataGridColumn('descricao',  'Descriчуo', 'left', 140);

        // adiciona as colunas р DataGrid
        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($nome);

        // instancia duas aчѕes da DataGrid
        $action1 = new TDataGridAction(array($this, 'onEdit'));
        $action1->setLabel('Editar');
        $action1->setImage('ico_edit.png');
        $action1->setField('id');

        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel('Deletar');
        $action2->setImage('ico_delete.png');
        $action2->setField('id');

        // adiciona as aчѕes р DataGrid
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);

        // cria o modelo da DataGrid, montando sua estrutura
        $this->datagrid->createModel();

        // monta a pсgina atravщs de uma tabela
        $table = new TTable;
        $table->width='100%';

        //Tэtulo da pсgina
        $tbtitulo = new TTable;
        $Titulo = new TLabel('Cadastro das fases de resoluчуo');
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

        // cria uma linha para o formulсrio
        $row = $table->addRow();
        $row->addCell($this->form);

        // cria uma linha para a datagrid
        $row = $table->addRow();
        $row->addCell($this->datagrid);

        // adiciona a tabela р pсgina
        parent::add($table);
    }
    
    function onReload()
    {
		$tpusuario = array();
		$tpusuario = ABDFaseResolucao::ListarTodosArray();
        $this->datagrid->clear();
        if ($tpusuario)
        {
            foreach ($tpusuario as $tpu)
            {
                // adiciona o objeto na DataGrid
                $this->datagrid->addItem($tpu);
            }
        }

        // finaliza a transaчуo
        $this->loaded = true;
    }

    function onSave()
    {
    	// inicia transaчуo com o banco 'pg_livro'
        // obtщm os dados no formulсrio em um objeto Cidade
        $FaseResolucao = $this->form->getData('ABDFaseResolucao');
    	$mensagem = $FaseResolucao->Atualiza();  
        // recarrega listagem
        $this->onReload();
        new TMessage('info', $mensagem);
    }    
    
    function onEdit($param)
    {
        // obtщm o parтmetro $key
        $tpusuario = ABDFaseResolucao::CarregaFaseResolucao($param['key']);
        $this->form->setData($tpusuario);
        $this->onReload();
    }
    
    
    function onDelete($param)
    {
        // obtщm o parтmetro $key
        $key=$param['key'];

        // define duas aчѕes
        $action1 = new TAction(array($this, 'Delete'));
        $action2 = new TAction(array($this, 'teste'));

        // define os parтmetros de cada aчуo
        $action1->setParameter('key', $key);
        $action2->setParameter('key', $key);

        // exibe um diсlogo ao usuсrio
        new TQuestion('Deseja realmente excluir o registro?', $action1, $action2);
    }
    
    function Delete($param)
    {
        // obtщm o parтmetro $key
        //$key=$param['key'];

		$tpusuario = new ABDFaseResolucao();
		$tpusuario->id = $param['key'];
		$mensagem = $tpusuario->Exclui();
        
        // recarrega a datagrid
        $this->onReload();

        // exibe mensagem de sucesso
        new TMessage('info', $mensagem);
    }

    
    
    function show()
    {
        // se a listagem ainda nуo foi carregada
        if (!$this->loaded)
        {
            $this->onReload();
        }
        parent::show();
    }
}
    
?>