<?php

class DemandaControleFiltro extends TPage
{
    private $form;     // formulário de buscas
    private $datagrid; // listagem
    private $loaded;

    public function __construct()
    {
    	$_SESSION['demanda'] = new Demanda();
//    	$_SESSION['demanda']->prioridade->descricao = '';
//    	$_SESSION['demanda']->tipodemanda->descricao = '';
//    	$_SESSION['demanda']->situacao->descricao = '';
//    	$_SESSION['demanda']->descricao = '';
    	
        parent::__construct();
        // instancia um formulário
        $this->form = new TForm('form_busca_Demanda');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formulário
        $this->form->add($table);

        // cria dois botões de ação para o formulário
        $new_button = new TButton('cadastra');

        // define as ações dos botões
        $form = new DemandaForm();
        $new_button->setAction(new TAction(array($form, 'onEdit')), 'Nova Demanda');
        
        $historico = new HistoricoDemandaControle();

        // adiciona uma linha para aas ações do formulário
        $row=$table->addRow();
        $row->addCell($new_button);

        // define quais são os campos do formulário
        $this->form->setFields(array($new_button));

        // instancia objeto DataGrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->align = 'left';
        // instancia as colunas da DataGrid
        $codigo     = new TDataGridColumn('id',    'Código', 'right', 50);
        $data       = new TDataGridColumn('dataentrada',  'Data', 'left', 120);
        $tit        = new TDataGridColumn('titulo',  'Título', 'left', 200);
        $situacao   = new TDataGridColumn('situacao',  'Situação', 'left', 140);
        $prioridade = new TDataGridColumn('prioridade',  'Prioridade', 'left', 70);
	$usuario    = new TDataGridColumn('usuario', 'Responsável  (a partir de)', 'leftt', 260); 

        // adiciona as colunas à DataGrid
        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($data);
        $this->datagrid->addColumn($tit);
        $this->datagrid->addColumn($situacao);
        $this->datagrid->addColumn($prioridade);
	$this->datagrid->addColumn($usuario);

        // instancia duas ações da DataGrid
        $action1 = new TDataGridAction(array($form, 'onEdit'));
        $action1->setLabel('Editar');
        $action1->setImage('ico_edit.png');
        $action1->setField('id');

/*        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel('Deletar');
        $action2->setImage('ico_delete.png');
        $action2->setField('id');
*/
        $action2 = new TDataGridAction(array($historico, 'onEdit'));
        $action2->setLabel('Histórico');
        $action2->setImage('ico_view.png');
        $action2->setField('id');
        
        // adiciona as ações à DataGrid
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);

        // cria o modelo da DataGrid, montando sua estrutura
        $this->datagrid->createModel();

        // monta a página através de uma tabela
        $table = new TTable;
        $table->width='100%';

        //Título da página
        $tbtitulo = new TTable;
        $Titulo = new TLabel('Cadastro das demandas por usuário');
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
	$tpDemanda = array();
	$tpDemanda = ABDDemanda::ListarTodosUsuarioArray();
        $this->datagrid->clear();
        if ($tpDemanda)
        {
            foreach ($tpDemanda as $tpu)
            {
                // adiciona o objeto na DataGrid
                $this->datagrid->addItem($tpu);
            }
        }

        $this->loaded = true;
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

		$tpDemanda = new ABDDemanda();
		$tpDemanda->id = $param['key'];
		$mensagem = $tpDemanda->Exclui();
        
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
