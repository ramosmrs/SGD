<?php
/**
 * classe TRadioButton
 * classe para constru��o de r�dio
 */
class TRadioButton extends TField
{
    /**
     * m�todo show()
     * exibe o widget na tela
     */
    public function show()
    {
        // atribui as propriedades da TAG
        $this->tag->name = $this->name;
        $this->tag->value = $this->value;
        $this->tag->type = 'radio';
        
        // se o campo n�o � edit�vel
        if (!parent::getEditable())
        {
            // desabilita a TAG input
            $this->tag->readonly = "1";
            $this->tag->class = 'tfield_disabled';		 // classe CSS
        }
        // exibe a tag
        $this->tag->show();
    }
}
?>