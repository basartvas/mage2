<?php

namespace InStore\PickUp\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Store extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('pickup_store', 'pickup_store_id');
    }
}