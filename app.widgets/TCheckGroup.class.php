<?php
/**
 * classe TCheckGroup
 * classe para exibi��o um grupo de CheckButtons
 */
class TCheckGroup extends TField
{
    private $layout = 'vertical';
    private $items;
    
    /**
     * m�todo setLayout()
     * define a dire��o das op��es (vertical ou horizontal)
     */
    public function setLayout($dir)
    {
        $this->layout = $dir;
    }
    
    /* m�todo addItems($items)
     * adiciona itens ao check group
     * @param $items = um vetor indexado de itens
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
        if ($this->items)
        {
            // percorre cada uma das op��es do r�dio
            foreach ($this->items as $index => $label)
            {
                $button = new TCheckButton("{$this->name}[]");
                $button->setValue($index);
                
                // verifica se deve ser marcado
                if (@in_array($index, $this->value))
                {
                    $button->setProperty('checked', '1');
                }
                $button->show();
                $obj = new TLabel($label);
                $obj->show();
                if ($this->layout == 'vertical')
                {
                    // exibe uma tag de quebra de linha
                    $br = new TElement('br');
                    $br->show();
                    echo "\n";
                }
            }
        }
    }
}
?>