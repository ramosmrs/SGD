<?php
/**
 * classe TQuestion
 * Exibe perguntas ao usu�rio
 */
class TQuestion
{
    /**
     * m�todo construtor
     * instancia objeto TQuestion
     * @param $message = pergunta ao usu�rio
     * @param $action_yes = a��o para resposta positiva
     * @param $action_no = a��o para resposta negativa
     */
    function __construct($message, TAction $action_yes, TAction $action_no)
    {
        $style = new TStyle('tquestion');
        $style->position     = 'absolute';
        $style->left         = '30%';
        $style->top          = '30%';
        $style->width        = '300';
        $style->height       = '150';
        $style->border_width = '1px';
        $style->color         = 'black';
        $style->background    = '#DDDDDD';
        $style->border        = '4px solid #000000';
        $style->z_index       = '10000000000000000';
        
        // converte os nomes de m�todos em URL's
        $url_yes = $action_yes->serialize();
        $url_no = $action_no->serialize();
        
        // exibe o estilo na tela
        $style->show();
        
        // instancia o painel para exibir o di�logo
        $painel = new TElement('div');
        $painel->class = "tquestion";
        
        // cria um bot�o para a resposta positiva
        $button1 = new TElement('input');
        $button1->type = 'button';
        $button1->value = 'Sim';
        $button1->onclick="javascript:location='$url_yes'";
        
        // cria um bot�o para a resposta negativa
        $button2 = new TElement('input');
        $button2->type = 'button';
        $button2->value = 'N�o';
        $button2->onclick="javascript:location='$url_no'";
        
        // cria uma tabela para organizar o layout
        $table = new TTable;
        $table->align = 'center';
        $table->cellspacing = 10;
        
        // cria uma linha para o �cone e a mensagem
        $row=$table->addRow();
        $row->addCell(new TImage('app.images/question.png'));
        $row->addCell($message);
        
        // cria uma linha para os bot�es
        $row=$table->addRow();
        $row->addCell($button1);
        $row->addCell($button2);
        
        // adiciona a tabela ao pain�l
        $painel->add($table);
        
        // exibe o pain�l
        $painel->show();
    }
}
?>