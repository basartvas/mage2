<?php

namespace InStore\PickUp\Model\ResourceModel\Product;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'entity_id';
    protected function _construct()
    {
        $this->_init(
            \InStore\PickUp\Model\Product::class,
            \InStore\PickUp\Model\ResourceModel\Product::class
        );
    }
}