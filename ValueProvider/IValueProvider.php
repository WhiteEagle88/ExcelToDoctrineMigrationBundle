<?php
namespace Sibers\ExcelToDoctrineMigrationBundle\ValueProvider;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Sibers\ExcelToDoctrineMigrationBundle\Migration\Mapping;

/**
 * Value provider interface
 * 
 * @author Dmitry Bykov <dmitry.bykov@sibers.com>
 */
interface IValueProvider
{
    /**
     * Returns value
     * 
     * @param Worksheet $wSheet active sheet
     * @param integer $row row
     * @param \Sibers\ExcelToDoctrineMigrationBundle\Migration\Mapping $mapping mapping
     */
    public function getValue(Worksheet $wSheet, $row, Mapping $mapping);
}
