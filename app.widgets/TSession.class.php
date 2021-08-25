<?php
/**
 * classe TSession
 * gerencia uma se��o com o usu�rio
 */
class TSession
{
    /**
     * m�todo construtor
     * inicializa uma se��o
     */
    function __construct()
    {
        session_start();
    }

    /**
     * m�todo setValue()
     * armazena uma vari�vel na se��o
     * @param $var     = Nome da vari�vel
     * @param $value = Valor
     */
    function setValue($var, $value)
    {
        $_SESSION[$var] = $value;
    }

    /**
     * m�todo getValue()
     * retorna uma vari�vel da se��o
     * @param $var = Nome da vari�vel
     */
    function getValue($var)
    {
        if (isset($_SESSION[$var]))
        {
            return $_SESSION[$var];
        }
    }

    /**
     * m�todo freeSession()
     * destr�i os dados de uma se��o
     */
    function freeSession()
    {
        $_SESSION = array();
        session_destroy();
    }
}
?>
