<?php
/**
 * classe TWindow
 * TWindow � um container que exibe seu conte�do em uma camada simulando uma janela
 */
class TWindow
{
    private $x;          // coluna
    private $y;          // linha
    private $width;      // largura
    private $height;     // altura
    private $title;      // t�tulo da janela
    private $content;    // conte�do da janela
    static private $counter;    // contador
    
    /**
     * m�todo construtor
     * incrementa o contador de janelas
     */
    public function __construct($title)
    {
        // incrementa o contador de janelas
        // para exibir cada um com um ID diferente
        self::$counter ++;
        $this->title = $title;
    }
    
    /**
     * m�todo setPosition()
     * define a coluna e linha (x,y) que a janela ser� exibido na tela
     * @param $x    = coluna (em pixels)
     * @param $y    = linha (em pixels)
     */
    public function setPosition($x, $y)
    {
        // atribui os pontos cardinais do canto superior esquerdo da janela
        $this->x = $x;
        $this->y = $y;
    }
    
    /*
     * m�todo setSize()
     * define a largura e altura da janela em tela
     * @param $width    = largura (em pixels)
     * @param $height = altura (em pixels)
     */
    public function setSize($width, $height)
    {
        // atribui as dimens�es
        $this->width = $width;
        $this->height = $height;
    }
    
    /*
     * m�todo add()
     * adiciona um conte�do � janela
     * @param $content = conte�do a ser adicionado
     */
    public function add($content)
    {
        $this->content = $content;
    }
    
    /*
     * m�todo show()
     * exibe a janela na tela
     */
    public function show()
    {
        $window_id = 'TWindow'.self::$counter;
        
        // instancia objeto TStyle para definir as caracter�sticas
        // de posicionamento e dimens�o da camada criada
        $style= new TStyle($window_id);
        $style->position       = 'absolute';
        $style->left           = $this->x;
        $style->top            = $this->y;
        $style->width          = $this->width;
        $style->height         = $this->height;
        $style->background     = '#e0e0e0';
        $style->border         = '1px solid #000000';
        $style->z_index        = "10000";
        
        // exibe o estilo em tela
        $style->show();
        
        // cria tag <div> para a camada que representar� a janela
        $painel = new TElement('div');
        $painel->id      = $window_id; // define o ID
        $painel->class = $window_id;   // define a classe CSS
        
        // instancia objeto TTable
        $table = new TTable;
        
        // define as propriedades da tabela
        $table->width = '100%';
        $table->height = '100%';
        $table->style = 'border-collapse:collapse';
        
        // adiciona uma linha para o t�tulo
        $row1 = $table->addRow();
        $row1->bgcolor = '#707070';
        $row1->height = '20px';
        
        // adiciona uma c�lula para o t�tulo
        $titulo = $row1->addCell("<font face=Arial size=2 color=white><b>{$this->title}</b></font>");
        $titulo->width = '100%';
        
        // cria um link com a��o para esconder o <div>
        $link = new TElement('a');
        $link->add(new TImage("app.images/ico_close.png"));
        $link->onclick = "document.getElementById('$window_id').style.display='none'";
        
        // adiciona uma c�lula com o link de fechar
        $cell = $row1->addCell($link);
        
        // cria uma linha para o conte�do
        $row2 = $table->addRow();
        $row2->valign = 'top';
        
        // adiciona o conte�do ocupando duas colunas (colspan)
        $cell = $row2->addCell($this->content);
        $cell->colspan = 2;
        
        // adiciona a tabela ao painel
        $painel->add($table);
        
        // exibe o painel
        $painel->show();
    }
}
?>