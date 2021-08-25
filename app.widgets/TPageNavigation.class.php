<?php
/**
 * classe TPageNavigation
 * Cria uma barra de navega��o para um TDataGrid
 */
class TPageNavigation
{
    private $action;
    private $pageSize;
    private $currentPage;
    private $totalRecords;
    
    /**
     * m�todo ()
     *
     * @param  $xxxx    = xxxx
     */
    function setAction(TAction $action)
    {
        $this->action = $action;
    }
    
    /**
     * m�todo ()
     *
     * @param  $xxxx    = xxxx
     */
    function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
    }
    
    /**
     * m�todo ()
     *
     * @param  $xxxx    = xxxx
     */
    function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }
    
    /**
     * m�todo ()
     *
     * @param  $xxxx    = xxxx
     */
    function setTotalRecords($totalRecords)
    {
        $this->totalRecords = $totalRecords;
    }
    
    /**
     * m�todo ()
     *
     * @param  $xxxx    = xxxx
     */
    function show()
    {
        $pages = ceil($this->totalRecords / $this->pageSize);
        
        for ($n=1; $n <= $pages; $n++)
        {
            $offset = ($n -1) * $this->pageSize;
            
            $action = $this->action;
            $action->setParameter('offset', $offset);
            $action->setParameter('page',   $n);
            
            $url = $action->serialize();
            $label = ($this->currentPage == $n) ? "<u><b>$n</b></u>" : $n;
            echo "<a href='$url'>{$label}</a>&nbsp;&nbsp;";
        }
    }
}
?>