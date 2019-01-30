<?php

namespace InStore\PickUp\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface StoreSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \InStore\PickUp\Api\Data\StoreInterface[]
     */
    public function getItems();

    /**
     * @param \InStore\PickUp\Api\Data\StoreInterface[]
     * @return void
     */
    public function setItems(array $items);
}