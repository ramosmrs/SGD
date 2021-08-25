<?php
/* classe TButton
 * respons�vel por exibir um bot�o
 */
class TButton extends TField
{
    private $action;
    private $label;
    private $formName;
    
    /**
     * m�todo setAction
     * define a a��o do bot�o (fun��o a ser executada)
     * @param $action = a��o do bot�o
     * @param $label    = r�tulo do bot�o
     */
    public function setAction($action, $label)
    {
        $this->action = $action;
        $this->label = $label;
    }
    
    /**
     * m�todo setFormName
     * define o nome do formul�rio para a a��o bot�o
     * @param $name = nome do formul�rio
     */
    public function setFormName($name)
    {
        $this->formName = $name;
        
    }
    
    /**
    * m�todo show()
    * exibe o bot�o
    */
    public function show()
    {
        $url = $this->action->serialize();
        // define as propriedades do bot�o
        $this->tag->name    = $this->name;    // nome da TAG
        $this->tag->type    = 'button';       // tipo de input
        $this->tag->value   = $this->label;   // r�tulo do bot�o
        // se o campo n�o � edit�vel
        if (!parent::getEditable())
        {
            $this->tag->disabled = "1";
            $this->tag->class = 'tfield_disabled'; // classe CSS
        }
        // define a a��o do bot�o
        $this->tag->onclick =	"document.{$this->formName}.action='{$url}'; ".
                                "document.{$this->formName}.submit()";
        // exibe o bot�o
        $this->tag->show();
    }
}
?>