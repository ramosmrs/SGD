<?php
/*
 * classe FormDemanda
 * formulário de cadastro de Usuários
 */
class DemandaForm extends TPage
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
        $this->form = new TForm('form_Demanda');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formulário
        $this->form->add($table);

        // cria os campos do formulário
        $codigo     = new TEntry('id');
        $tpDemanda  = new TCombo('tipodemanda');
        $Prioridade = new TCombo('prioridade');
        $Situacao   = new TCombo('situacao');
        $Titulo     = new TEntry('titulo');
        $descricao  = new TText('descricao');
        $dataentrada = new TEntry('dataentrada');

        // define alguns atributos para os campos do formulário
        $codigo->setEditable(FALSE);
        $codigo->setSize(20);
        $Titulo->setSize(300);
        $descricao->setSize(500, 200);
        $dataentrada->setSize(160);
        $dataentrada->setEditable(false);

        // adiciona uma linha para o campo código
        $row=$table->addRow();
        $row->addCell(new TLabel('Código:'));
        $row->addCell($codigo);

        // adiciona uma linha para o campo tipo de demanda
        $ColTipoDemanda = ABDTipoDemanda::ListarTodosArray();
        // adiciona objetos na combo
        foreach ($ColTipoDemanda as $object1)
        {
            $items1[$object1->id] = $object1->descricao;
        }
        $tpDemanda->addItems($items1);
        $row=$table->addRow();
        $row->addCell(new TLabel('Tipo de Demanda:'));
        $row->addCell($tpDemanda);
        
        // adiciona uma linha para o campo prioridade
		$ColPrioridade = ABDPrioridade::ListarTodosArray();
        foreach ($ColPrioridade as $object2)
        {
            $items2[$object2->id] = $object2->descricao;
        }
        $Prioridade->addItems($items2);
        $row=$table->addRow();
        $row->addCell(new TLabel('Prioridade:'));
        $row->addCell($Prioridade);

        // adiciona uma linha para o campo endereço
		$ColSituacao = ABDSituacao::ListarTodosArray();
        foreach ($ColSituacao as $object3)
        {
            $items3[$object3->id] = $object3->descricao;
        }
        $Situacao->addItems($items3);
        $row=$table->addRow();
        $row->addCell(new TLabel('Situação:'));
        $row->addCell($Situacao);

        // adiciona uma linha para o campo telefone
        $row=$table->addRow();
        $row->addCell(new TLabel('Título:'));
        $row->addCell($Titulo);

        // adiciona uma linha para o campo cidade
        $row=$table->addRow();
        $row->addCell(new TLabel('Descrição:'));
        $row->addCell($descricao);

        // adiciona uma linha para o campo cidade
        $row=$table->addRow();
        $row->addCell(new TLabel('Data de entrada:'));
        $row->addCell($dataentrada);
        
        // cria um botão de ação para o formulário
        $button1=new TButton('action1');

        // define a ação do botão
        $button1->setAction(new TAction(array($this, 'onSave')), 'Salvar');

        // adiciona uma linha para a ação do formulário
        $row=$table->addRow();
        $row->addCell('');
        $row->addCell($button1);

        // define quais são os campos do formulário
        $this->form->setFields(array($codigo, $tpDemanda, $Prioridade, $Situacao, $Titulo, $descricao, $dataentrada, $button1));

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
			        $Demanda = ABDDemanda::CarregaDemanda(intval($param['key']),1);
			        $Demanda->tipodemanda = $Demanda->tipodemanda->id;
			        $Demanda->prioridade = $Demanda->prioridade->id;
			        $Demanda->situacao = $Demanda->situacao->id;
			        $this->form->setData($Demanda);
            	}
            }
        }
        
        catch (Exception $e)   // em caso de exceção
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
        $Demanda = $this->form->getData('ABDDemanda');
    	$mensagem = $Demanda->Atualiza();  
        new TMessage('info', $mensagem);
    }
}
?>
