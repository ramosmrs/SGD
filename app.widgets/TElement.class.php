<?php
/**
 * classe TElement
 * classe para abstra��o de tags HTML
 */
class TElement
{
    private $name;          // nome da TAG
    private $properties;    // propriedades da TAG
    protected $children;
    
    /**
     * m�todo construtor
     * instancia uma tag html
     * @param $name     = nome da tag
     */
    public function __construct($name)
    {
        // define o nome do elemento
        $this->name = $name;
    }
    
    /**
     * m�todo __set()
     * intercepta as atribui��es � propriedades do objeto
     * @param $name      = nome da propriedade
     * @param $value     = valor
     */
    public function __set($name, $value)
    {
        // armazena os valores atribu�dos
        // ao array properties
        $this->properties[$name] = $value;
    }
    
    /**
     * m�todo add()
     * adiciona um elemento filho
     * @param $child = objeto filho
     */
    public function add($child)
    {
        $this->children[] = $child;
    }
    
    /**
     * m�todo open()
     * exibe a tag de abertura na tela
     */
    private function open()
    {
        // exibe a tag de abertura
        echo "<{$this->name}";
        if ($this->properties)
        {
            // percorre as propriedades
            foreach ($this->properties as $name=>$value)
            {
                echo " {$name}=\"{$value}\"";
            }
        }
        echo '>';
    }
    
    /**
     * m�todo show()
     * exibe a tag na tela, juntamente com seu conte�do
     */
    public function show()
    {
        // abre a tag
        $this->open();
        echo "\n";
        // se possui conte�do
        if ($this->children)
        {
            // percorre todos objetos filhos
            foreach ($this->children as $child)
            {
                // se for objeto
                if (is_object($child))
                {
                    $child->show();
                }
                else if ((is_string($child)) or (is_numeric($child)))
                {
                    // se for texto
                    echo $child;
                }
            }
            // fecha a tag
            $this->close();
        }
    }
    
    /**
     * m�todo close()
     * Fecha uma tag HTML
     */
    private function close()
    {
        echo "</{$this->name}>\n";
    }
}
?>