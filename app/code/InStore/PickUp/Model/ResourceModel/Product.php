<?php

namespace InStore\PickUp\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Product extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('product_in_store', 'entity_id');
    }
}