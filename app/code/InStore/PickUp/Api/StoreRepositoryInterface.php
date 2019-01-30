<?php

namespace InStore\PickUp\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use InStore\PickUp\Api\Data\StoreInterface;

interface StoreRepositoryInterface
{
    /**
     * @param int $id
     * @return \InStore\PickUp\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    function getById(int $id);

    /**
     * @param \InStore\PickUp\Api\Data\StoreInterface $store
     * @return \InStore\PickUp\Api\Data\StoreInterface
     */
    function save(StoreInterface $store);

    /**
     * @param \InStore\PickUp\Api\Data\StoreInterface $store
     * @return void
     */
    function delete(StoreInterface $store);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \InStore\PickUp\Api\Data\StoreSearchResultInterface
     */
    function getList(SearchCriteriaInterface $criteria);
}