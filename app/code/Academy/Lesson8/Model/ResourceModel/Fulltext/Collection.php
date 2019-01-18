<?php

namespace Academy\Lesson8\Model\ResourceModel\Fulltext;

use Magento\Store\Model\ScopeInterface;

/**
 * Class Collection
 * @package Academy\Lesson8\Model\ResourceModel\Fulltext
 */
class Collection extends \Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection
{
    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _renderFiltersBefore()
    {
        $minPrice = $this->_scopeConfig->getValue(
            'catalog/price/minimal',
            ScopeInterface::SCOPE_STORE
        );
        $this->addFieldToFilter('price', ['from'=>"$minPrice"]);
        return parent::_renderFiltersBefore();
    }
}
