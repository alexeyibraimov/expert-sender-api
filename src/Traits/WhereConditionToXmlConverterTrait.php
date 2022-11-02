<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Traits;

use AlexeyIbraimov\ExpertSenderApi\Model\WhereCondition;

/**
 * Where condition to xml converter trait
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
trait WhereConditionToXmlConverterTrait
{
    /**
     * Convert where condition into xml
     *
     * @param WhereCondition $whereCondition Where condition
     * @param \XMLWriter $xmlWriter Xml writer
     */
    public function convertWhereConditionToXml(WhereCondition $whereCondition, \XMLWriter $xmlWriter)
    {
        $xmlWriter->startElement('Where');
        $xmlWriter->writeElement('ColumnName', $whereCondition->getColumnName());
        $xmlWriter->writeElement('Operator', $whereCondition->getOperator()->getValue());
        $xmlWriter->writeElement('Value', $whereCondition->getValue());
        $xmlWriter->endElement(); // Where
    }
}
