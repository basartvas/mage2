<?php

namespace Academy\Lesson8\Model\ResourceModel\Fulltext;

class Collection extends \Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection
{
    protected function _renderFiltersBefore()
    {
        /*$this->scopeConfig->ge*/
        $this->addFieldToFilter('price', ['from'=>46]);
        return parent::_renderFiltersBefore();
    }
}
