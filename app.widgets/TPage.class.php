<?php
/**
 * classe TPage
 * classe para controle do fluxo de execu��o
 */
class TPage extends TElement
{
    /**
     * m�todo __construct()
     */
    public function __construct()
    {
        // define o elemento que ir� representar
        parent::__construct('html');
    }
    
    /**
     * m�todo show()
     * exibe o conte�do da p�gina
     */
    public function show()
    {
        $this->run();
        parent::show();
    }
    
    /**
     * m�todo run()
     * executa determinado m�todo de acordo com os par�metros recebidos
     */
    public function run()
    {
        if ($_GET)
        {
            $class = isset($_GET['class']) ? $_GET['class'] : NULL;
            $method = isset($_GET['method']) ? $_GET['method'] : NULL;
            if ($class)
            {
                $object = $class == get_class($this) ? $this : new $class;
                if (method_exists($object, $method))
                {
                    call_user_func(array($object, $method), $_GET);
                }
            }
            else if (function_exists($method))
            {
                call_user_func($method, $_GET);
            }
        }
    }
}
?>