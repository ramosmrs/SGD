<?php
/**
 * classe TParagraph
 * classe para exibi��o de par�grafos
 */
class TParagraph extends TElement
{
    /**
     * m�todo construtor
     * instancia objeto TParagraph
     * @param $texto = texto a ser exibido
     */
    public function __construct($text)
    {
        parent::__construct('p');
        // atribui o conte�do do texto
        parent::add($text);
    }
    
    /**
     * m�todo setAlign()
     * define o alinhamento do texto
     * @param $align = alinhamento do texto
     */
    function setAlign($align)
    {
        $this->align = $align;
    }
}
?>