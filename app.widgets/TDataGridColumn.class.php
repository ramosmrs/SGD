<?php
/**
 * class TDataGridColumn
 * representa uma coluna de uma listagem
 */
class TDataGridColumn
{
    private $name;
    private $label;
    private $align;
    private $width;
    private $action;
    private $transformer;
    
    /**
     * m�todo __construct()
     * instancia uma coluna nova
     * @param $name = nome da coluna no banco de dados
     * @param $label = r�tulo de texto que ser� exibido
     * @param $align = alinhamento da coluna (left, center, right)
     * @param $width = largura da coluna (em pixels)
     */
    public function __construct($name, $label, $align, $width)
    {
        // atribui os par�metros �s propriedades do objeto
        $this->name = $name;
        $this->label = $label;
        $this->align = $align;
        $this->width = $width;
    }
    
    /**
     * m�todo getName()
     * retorna o nome da coluna no banco de dados
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * m�todo getLabel()
     * retorna o nome do r�tulo de texto da coluna
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * m�todo getAlign()
     * retorna o alinhamento da coluna (left, center, right)
     */
    public function getAlign()
    {
        return $this->align;
    }
    
    /**
     * m�todo getWidth()
     * retorna a largura da coluna (em pixels)
     */
    public function getWidth()
    {
        return $this->width;
    }
    
    /**
     * m�todo setAction()
     * define uma a��o a ser executada quando o usu�rio
     * clicar sobre o t�tulo da coluna
     * @param $action = objeto TAction contendo a a��o
     */
    public function setAction(TAction $action)
    {
        $this->action = $action;
    }
    
    /**
     * m�todo getAction()
     * retorna a a��o vinculada � coluna
     */
    public function getAction()
    {
        // verifica se a coluna possui a��o
        if ($this->action)
        {
            return $this->action->serialize();
        }
    }
    
    /**
     * m�todo setTransformer()
     * define uma fun��o (callback) a ser aplicada sobre
     * todo dado contido nesta coluna
     * @param $callback = fun��o do PHP ou do usu�rio
     */
    public function setTransformer($callback)
    {
        $this->transformer = $callback;
    }
    
    /**
     * m�todo getTransformer()
     * retorna a fun��o (callback) aplicada � coluna
     */
    public function getTransformer()
    {
        return $this->transformer;
    }
}
?>