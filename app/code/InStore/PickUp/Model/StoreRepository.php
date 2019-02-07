<?php
declare(strict_types=1);

namespace InStore\PickUp\Model;

use InStore\PickUp\Model\StoreFactory;
use InStore\PickUp\Model\ResourceModel\Store as StoreResource;
use InStore\PickUp\Model\ResourceModel\Store\CollectionFactory as StoreCollectionFactory;
use InStore\PickUp\Api\StoreRepositoryInterface;
use InStore\PickUp\Api\Data\StoreInterface;

use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class StoreRepository implements StoreRepositoryInterface
{
    protected $storeFactory;
    protected $storeResource;
    protected $storeCollectionFactory;
    protected $searchResultFactory;
    protected $collectionProcessor;

    public function __construct(
        StoreFactory $storeFactory,
        StoreResource $storeResource,
        StoreCollectionFactory $storeCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsInterfaceFactory
    ) {
        $this->storeFactory = $storeFactory;
        $this->storeResource = $storeResource;
        $this->storeCollectionFactory = $storeCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultFactory = $searchResultsInterfaceFactory;
    }

    function getById(int $id)
    {
        $store = $this->storeFactory->create();
        $this->storeResource->load($store, $id);
        if(!$store->getId()) {
            throw new NoSuchEntityException(__('Pickup Store with id "%1" does not exist.', $id));
        }
        return $store;
    }

    function save(StoreInterface $store)
    {
        try {
            $this->storeResource->save($store);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('Could not save the Pickup Store: %1', $e->getMessage()),
                $e
            );
        }
        return true;
    }

    function delete(StoreInterface $store)
    {
        try {
            $this->storeResource->delete($store);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Pickup Store: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->storeCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}