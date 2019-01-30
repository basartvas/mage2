<?php

namespace InStore\PickUp\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use InStore\PickUp\Api\Data\ProductInterface;

interface ProductRepositoryInterface
{
    /**
     * @param int $id
     * @return \InStore\PickUp\Api\Data\ProductInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    function getById(int $id);

    /**
     * @param \InStore\PickUp\Api\Data\ProductInterface $product
     * @return \InStore\PickUp\Api\Data\ProductInterface
     */
    function save(ProductInterface $product);

    /**
     * @param \InStore\PickUp\Api\Data\ProductInterface $product
     * @return void
     */
    function delete(ProductInterface $product);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \InStore\PickUp\Api\Data\ProductSearchResultInterface
     */
    function getList(SearchCriteriaInterface $criteria);
}