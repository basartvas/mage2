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
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    function save(StoreInterface $store);

    /**
     * @param \InStore\PickUp\Api\Data\StoreInterface $store
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    function delete(StoreInterface $store);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    function getList(SearchCriteriaInterface $criteria);
}