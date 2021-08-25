<?php
/**
 * class TDataGridAction
 * representa uma a��o de uma listagem
 */
class TDataGridAction extends TAction
{
    private $image;
    private $label;
    private $field;
    
    /**
     * m�todo setImage()
     * atribui uma imagem � a��o
     * @param $image = local do arquivo de imagem
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
    
    /**
     * m�todo getImage()
     * retorna a imagem da a��o
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * m�todo setLabel()
     * define o r�tulo de texto da a��o
     * @param $label = r�tulo de texto da a��o
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
    /**
     * m�todo getLabel()
     * retorna o r�tulo de texto da a��o
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * m�todo setField()
     * define o nome do campo do banco de dados que ser� passado juntamente com a a��o
     * @param $field = nome do campo do banco de dados
     */
    public function setField($field)
    {
        $this->field = $field;
    }
    
    /**
     * m�todo getField()
     * retorna o nome do campo de dados definido pelo m�todo setField()
     */
    public function getField()
    {
        return $this->field;
    }
}
?>