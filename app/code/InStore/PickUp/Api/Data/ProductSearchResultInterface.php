<?php

namespace InStore\PickUp\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ProductSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \InStore\PickUp\Api\Data\ProductInterface[]
     */
    public function getItems();

    /**
     * @param \InStore\PickUp\Api\Data\ProductInterface[]
     * @return void
     */
    public function setItems(array $items);
}