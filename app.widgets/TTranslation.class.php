<?php
/**
 * classe TTranslation
 * classe utilit�ria para tradu��o de textos
 */
class TTranslation
{
    private static $instance;   // inst�ncia de TTranslation
    private $lang;              // linguagem destino

    /**
     * m�todo __construct()
     * instancia um objeto TTranslation
     */
    private function __construct()
    {
        $this->messages['en'][] = 'Function';
        $this->messages['en'][] = 'Table';
        $this->messages['en'][] = 'Tool';
        $this->messages['pt'][] = 'Fun��o';
        $this->messages['pt'][] = 'Tabela';
        $this->messages['pt'][] = 'Ferramenta';
        $this->messages['it'][] = 'Funzione';
        $this->messages['it'][] = 'Tabelle';
        $this->messages['it'][] = 'Strumento';
    }

    /**
     * m�todo getInstance()
     * retorna a �nica inst�ncia de TTranslation
     */
    public static function getInstance()
    {
        // se n�o existe inst�ncia ainda
        if (empty(self::$instance))
        {
            // instancia um objeto
            self::$instance = new TTranslation;
        }
        // retorna a inst�ncia
        return self::$instance;
    }

    /**
     * m�todo setLanguage()
     * define a linguagem a ser utilizada
     * @param $lang = linguagem (en,pt,it)
     */
    public static function setLanguage($lang)
    {
        $instance = self::getInstance();
        $instance->lang = $lang;
    }

    /**
     * m�todo getLanguage()
     * retorna a linguagem atual
     */
    public static function getLanguage()
    {
        $instance = self::getInstance();
        return $instance->lang;
    }

    /**
     * m�todo Translate()
     * traduz uma palavra para a linguagem definida
     * @param $word = Palavra a ser traduzida
     */
    public function Translate($word)
    {
        // obt�m a inst�ncia atual
        $instance = self::getInstance();
        // busca o �ndice num�rico da palavra dentro do vetor
        $key = array_search($word, $instance->messages['en']);
        // obt�m a linguagem para tradu��o
        $language = self::getLanguage();
        // retorna a palavra traduzida
        // vetor indexado pela linguagem e pela chave
        return $instance->messages[$language][$key];
    }
} // fim da classe TTranslation

/**
 * m�todo _t()
 * fachada para o m�todo Translate da classe Translation
 * @param $word = Palavra a ser traduzida
 */
function _t($word)
{
    return TTranslation::Translate($word);
}
?>
