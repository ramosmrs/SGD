<?php
/**
 * classe TImage
 * classe para exibi��o de imagens
 */
class TImage extends TElement
{
    private $source; // localiza��o da imagem
    
    /**
     * m�todo construtor
     * instancia objeto TImage
     * @param $source = localiza��o da imagem
     */
    public function __construct($source)
    {
        parent::__construct('img');
        
        // atribui a localiza��o da imagem
        $this->src = $source;
        $this->border = 0;
    }
}
?>