<?php
/**
 * classe TAction
 * encapsula uma a��o
 */
class TAction
{
    private $action;
    private $param;
    
    /**
     * m�todo __construct()
     * instancia uma nova a��o
     * @param $action = m�todo a ser executado
     */
    public function __construct($action)
    {
        $this->action = $action;
    }
    
    /**
     * m�todo setParameter()
     * acrescenta um par�metro ao m�todo a ser executdao
     * @param $param = nome do par�metro
     * @param $value = valor do par�metro
     */
    public function setParameter($param, $value)
    {
        $this->param[$param] = $value;
    }
    
    /**
     * m�todo serialize()
     * transforma a a��o em uma string do tipo URL
     */
    public function serialize()
    {
        // verifica se a a��o � um m�todo
        if (is_array($this->action))
        {
            // obt�m o nome da classe
            $url['class'] = get_class($this->action[0]);
            // obt�m o nome do m�todo
            $url['method'] = $this->action[1];
        }
        else if (is_string($this->action)) // � uma string
        {
            // obt�m o nome da fun��o
            $url['method'] = $this->action;
        }
        // verifica se h� par�metros
        if ($this->param)
        {
            $url = array_merge($url, $this->param);
        }
        // monta a URL
        return '?' . http_build_query($url);
    }
}
?>