<?php
/**
 * classe TText
 * classe para constru��o de caixas de texto
 */
class TText extends TField
{
    private $width;
    private $height;
    
    /**
     * m�todo construtor
     * instancia um novo objeto
     * @param $name = nome do campo
     */
    public function __construct($name)
    {
        // executa o m�todo construtor da classe-pai.
        parent::__construct($name);
        
        // cria uma tag HTML do tipo <textarea >
        $this->tag = new TElement('textarea');
        $this->tag->class = 'tfield';        // classe CSS
        
        // define a altura padr�o da caixa de texto
        $this->height= 100;
    }
    
    /**
     * m�todo setSize()
     * define o tamanho de um campo de texto
     * @param $width     = largura
     * @param $height = altura
     */
    public function setSize($width, $height)
    {
        $this->size    = $width;
        $this->height = $height;
    }
    
    /* m�todo show()
     * exibe o widget na tela
     */
    public function show()
    {
        $this->tag->name = $this->name; // nome da TAG
        $this->tag->style = "width:{$this->size};height:{$this->height}"; // tamanho em pixels
        
        // se o campo n�o � edit�vel
        if (!parent::getEditable())
        {
            // desabilita a TAG input
            $this->tag->readonly = "1";
            $this->tag->class = 'tfield_disabled'; // classe CSS
        }
        
        // adiciona conte�do ao textarea
        $this->tag->add(htmlspecialchars($this->value));
        
        // exibe a tag
        $this->tag->show();
    }
}
?>