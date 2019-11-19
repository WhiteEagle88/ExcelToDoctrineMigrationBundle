<?php
namespace Sibers\ExcelToDoctrineMigrationBundle\ValueProvider;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Sibers\ExcelToDoctrineMigrationBundle\Migration\Mapping;

/**
 * Date value Provider
 *
 * @author Dmitry Bykov <dmitry.bykov@sibers.com>
 */
class DateProvider extends AbstractValueProvider
{
    /**
     * @var default options 
     */
    protected $options = array(
        'dateFormat' => 'd.m.Y'
    );
    
    /**
     * @inheritDoc
     */
    public function getValue(Worksheet $wSheet, $row, Mapping $mapping)
    {
        $excelColumns = $mapping->getExcelColumns();
        $column       = $excelColumns[0] . $row;
        $cell         = $wSheet->getCell($column);
        
        if ($cell && Date::isDateTime($cell)) {
            $value = Date::excelToDateTimeObject($cell->getValue());
        } else {
            $options = $this->getOptions($mapping);
            $value = \DateTime::createFromFormat(
                $options['dateFormat'],
                trim($cell->getValue())
            );
        }
        
        return $value;
    }
}
