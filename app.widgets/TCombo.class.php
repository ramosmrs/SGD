<?php
/**
 * classe TCombo
 * classe para constru��o de combo boxes
 */
class TCombo extends TField
{
    private $items; // array contendo os itens da combo
    
    /**
     * m�todo construtor
     * instancia a combo box
     * @param $name = nome do campo
     */
    public function __construct($name)
    {
        // executa o m�todo construtor da classe-pai.
        parent::__construct($name);
        
        // cria uma tag HTML do tipo <select>
        $this->tag = new TElement('select');
        $this->tag->class = 'tfield';       // classe CSS
    }
    
    /**
     * m�todo addItems()
     * adiciona items � combo box
     * @param $items = array de itens
     */
    public function addItems($items)
    {
        $this->items = $items;
    }
    
    /**
     * m�todo show()
     * exibe o widget na tela
     */
    public function show()
    {
        // atribui as propriedades da TAG
        $this->tag->name = $this->name;      // nome da TAG
        $this->tag->style = "width:{$this->size}"; // tamanho em pixels
        
        // cria uma TAG <option> com um valor padr�o
        $option = new TElement('option');
        $option->add('');
        $option->value = '0';    // valor da TAG
        
        // adiciona a op��o � combo
        $this->tag->add($option);
        if ($this->items)
        {
            // percorre os itens adicionados
            foreach ($this->items as $chave => $item)
            {
                // cria uma TAG <option> para o item
                $option = new TElement('option');
                $option->value = $chave; // define o �ndice da op��o
                $option->add($item);     // adiciona o texto da op��o
                
                // caso seja a op��o selecionada
                if ($chave == $this->value)
                {
                    // seleciona o item da combo
                    $option->selected = 1;
                }
                // adiciona a op��o � combo
                $this->tag->add($option);
            }
        }
        
        // verifica se o campo � edit�vel
        if (!parent::getEditable())
        {
            // desabilita a TAG input
            $this->tag->readonly = "1";
            $this->tag->class = 'tfield_disabled'; // classe CSS
        }
        
        // exibe a combo
        $this->tag->show();
    }
}
?>