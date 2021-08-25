<?php
/**
 * classe TFile
 * classe para constru��o de bot�es de sele��o de arquivos
 */
class TFile extends TField
{
    /**
     * m�todo show()
     * exibe o widget na tela
     */
    public function show()
    {
        // atribui as propriedades da TAG
        $this->tag->name = $this->name;    // nome da TAG
        $this->tag->value = $this->value;  // valor da TAG
        $this->tag->type = 'file';         // tipo de input
        
        // se o campo n�o � edit�vel
        if (!parent::getEditable())
        {
            // desabilita a TAG input
            $this->tag->readonly = "1";
            $this->tag->class = 'tfield_disabled'; // classe CSS
        }
        // exibe a tag
        $this->tag->show();
    }
}
?>