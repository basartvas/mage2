<?php

namespace InStore\PickUp\Model;

use InStore\PickUp\Api\OfficeManagementInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class OfficeManagement implements OfficeManagementInterface
{
    private $repository;
    private $searchCriteriaBuilder;

    public function __construct(
        StoreRepository $repository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }


    public function fetchOffices(
        $postcode, $city
    ) {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('store_address', "%$postcode%", 'like')
            ->addFilter('store_address', "%$city%", 'like')
            ->create();
        $items = $this->repository->getList($searchCriteria)->getItems();
        $loadedData = [];
        /** @var \InStore\PickUp\Model\Product $product */
        foreach ($items as $product) {
            $loadedData[] = $product->getData();
        }
        return $loadedData;
    }
}