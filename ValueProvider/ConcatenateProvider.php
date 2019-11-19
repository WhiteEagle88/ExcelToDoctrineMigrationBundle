<?php
namespace Sibers\ExcelToDoctrineMigrationBundle\ValueProvider;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Sibers\ExcelToDoctrineMigrationBundle\Migration\Mapping;

/**
 * Concatenate Provider
 *
 * @author Dmitry Bykov <dmitry.bykov@sibers.com>
 */
class ConcatenateProvider extends AbstractValueProvider
{
    /**
     * @var default options 
     */
    protected $options = array(
        'glue' => ' '
    );
    
    /**
     * {@inheritDoc}
     */
    public function getValue(Worksheet $wSheet, $row, Mapping $mapping)
    {
        $excelColumns = $mapping->getExcelColumns();
        $type         = $mapping->getType();
        $values       = array();
        $options      = $this->getOptions($mapping); 
        
        foreach($excelColumns as $column) {
            $values[] = $this->getExcelValue($wSheet, $row, $column, $type);
        }
        
        return trim(implode($options['glue'], $values), ' ');
    }
}
