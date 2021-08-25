<?php
/**
 * classe TPanel
 * painel de posi��es fixas
 */
class TPanel extends TElement
{
    /**
     * m�todo __construct()
     * instancia objeto TPanel.
     * @param $width     = largura do painel
     * @param $height = altura do painel
     */
    public function __construct($width, $height)
    {
        // instancia objeto TStyle
        // para definir as caracter�sticas do painel
        $painel_style = new TStyle('tpanel');
        $painel_style->position          = 'relative';
        $painel_style->width             = $width;
        $painel_style->height            = $height;
        $painel_style->border            = '2px solid';
        $painel_style->border_color      = 'grey';
        $painel_style->background_color = '#f0f0f0';
        
        // exibe o estilo na tela
        $painel_style->show();
        parent::__construct('div');
        $this->class = 'tpanel';
    }
    
    /**
     * m�todo put()
     * posiciona um objeto no painel
     * @param $widget = objeto a ser inserido no painel
     * @param $col     = coluna em pixels.
     * @param $row     = linha em pixels.
     */
    public function put($widget, $col, $row)
    {
        // cria uma camada para o widget
        $camada = new TElement('div');
        
        // define a posi��o da camada
        $camada->style = "position:absolute; left:{$col}px; top:{$row}px;";
        
        // adiciona o objeto (widget) � camada rec�m-criada
        $camada->add($widget);
        
        // adiciona widget no array de elementos
        parent::add($camada);
    }
}
?>