<?php
namespace SHOP\Admin\Library;

class ReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($column, $row, $worksheetName = '') {
        if ($row == 1 ) {
                return true;
        }
        return false;
    }
}