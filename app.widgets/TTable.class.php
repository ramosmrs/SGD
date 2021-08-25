<?php
/**
 * classe TTable
 * respons�vel pela exibi��o de tabelas
 */
class TTable extends TElement
{
    /**
     * m�todo construtor
     * instancia uma nova tabela
     */
    public function __construct()
    {
        parent::__construct('table');
    }
    
    /**
     * m�todo addRow
     * agrega um novo objeto linha (TTableRow) na tabela
     */
    public function addRow()
    {
        // instancia objeto linha
        $row = new TTableRow;
        
        // armazena no array de linhas
        parent::add($row);
        return $row;
    }
}
?>