<?php

namespace Sibers\ExcelToDoctrineMigrationBundle\ValueProvider;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Sibers\ExcelToDoctrineMigrationBundle\Migration\Mapping;

/**
 * ScalarProvider
 *
 * @author Dmitry Bykov <dmitry.bykov@sibers.com>
 */
class ScalarProvider extends AbstractValueProvider
{
    /**
     * Provider name
     */
    const NAME = 'scalar';
    
    /**
     * {@inheritDoc}
     */
    public function getValue(Worksheet $wSheet, $row, Mapping $mapping)
    {
        $excelColumns = $mapping->getExcelColumns();
        $column       = $excelColumns[0];
        $type         = $mapping->getType();
        
        return $this->getExcelValue($wSheet, $row, $column, $type);
    }
}
