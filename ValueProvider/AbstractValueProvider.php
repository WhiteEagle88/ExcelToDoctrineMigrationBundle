<?php

namespace Sibers\ExcelToDoctrineMigrationBundle\ValueProvider;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Sibers\ExcelToDoctrineMigrationBundle\Migration\Mapping;

/**
 * AbstractValueProvider
 *
 * @author Dmitry Bykov <dmitry.bykov@sibers.com>
 */
abstract class AbstractValueProvider implements IValueProvider
{
    /**
     * @var array Default options 
     */
    protected $options = array();
    
    /**
     * Constructor
     * 
     * @param array $options default options
     */
    public function __construct(array $options = null)
    {
        if (null !== $options) {
            $this->options = $options;
        }
    }
    
    /**
     * Returns options
     * 
     * @param array $options custom options
     */
    protected function getOptions(Mapping $mapping)
    {
        $customOptions = $mapping->getValueProviderOptions();
        
        if (is_array($customOptions)) {
            return array_replace($this->options, $customOptions);
        }
        
        return self::$options;
    }
    
    /**
     * Returns value
     * 
     * @param Worksheet $wSheet active work sheet
     * @param integer $row row
     * @param string $column column name
     * @param string $type type of column
     * 
     * @return mixed
     */
    protected function getExcelValue(Worksheet $wSheet, $row, $column, $type)
    {
        $cellCoordinate = $column . $row;
        $cell           = $wSheet->getCell($cellCoordinate);
        
        if (Mapping::TYPE_EXCEL_FORMULA === $type) {
            return $cell->getCalculatedValue();
        } else {
            return $cell->getValue();
        }
    }
}
