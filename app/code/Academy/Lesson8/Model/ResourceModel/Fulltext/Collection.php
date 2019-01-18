<?php

namespace Academy\Lesson8\Model\ResourceModel\Fulltext;

class Collection extends \Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection
{
    protected function _renderFiltersBefore()
    {
        $minPrice = $this->_scopeConfig->getValue(
            'catalog/price/minimal',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $this->addFieldToFilter('price', ['from'=>"$minPrice"]);
        return parent::_renderFiltersBefore();
    }
}
