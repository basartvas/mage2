<?php
declare(strict_types=1);

namespace InStore\PickUp\Model;

use InStore\PickUp\Model\ProductFactory;
use InStore\PickUp\Model\ResourceModel\Product as ProductResource;
use InStore\PickUp\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use InStore\PickUp\Api\ProductRepositoryInterface;
use InStore\PickUp\Api\Data\ProductInterface;

use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class ProductRepository implements ProductRepositoryInterface
{
    protected $productFactory;
    protected $productResource;
    protected $productCollectionFactory;
    protected $searchResultFactory;
    protected $collectionProcessor;
    protected $searchResultsFactory;

    public function __construct(
        ProductFactory $productFactory,
        ProductResource $productResource,
        ProductCollectionFactory $productCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsInterfaceFactory
    ) {
        $this->productFactory = $productFactory;
        $this->productResource = $productResource;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsInterfaceFactory;
    }

    function getById(int $id)
    {
        $product = $this->productFactory->create();
        $this->productResource->load($product, $id);
        if(!$product->getId()) {
            throw new NoSuchEntityException(__('Product with id "%1" does not exist.', $id));
        }
        return $product;
    }

    function save(ProductInterface $product)
    {
        try {
            $this->productResource->save($product);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('Could not save the Product: %1', $e->getMessage()),
                $e
            );
        }
        return true;
    }

    function delete(ProductInterface $product)
    {
        try {
            $this->productResource->delete($product);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Product: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->productCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}