<?php

namespace InStore\PickUp\Plugin;

use Magento\Catalog\Ui\DataProvider\Product\Form\ProductDataProvider;
use Magento\Framework\Registry;
use InStore\PickUp\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;


/**
 * Class ProductDataProviderPlugin
 * @package InStore\PickUp\Plugin
 */
class ProductDataProviderPlugin
{
    private $registry;

    /**
     * @var \InStore\PickUp\Model\ResourceModel\Product\Collection
     */
    private $repository;
    private $searchCriteriaBuilder;

    public function __construct(
        Registry $registry,
        ProductRepository $repository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->registry = $registry;
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function afterGetData(
        ProductDataProvider $subject,
        $result
    ) {
        /** @var \Magento\Catalog\Model\Product $product */
        //separwate method getProductId
        $product = $this->registry->registry('product');
        $product_id = $product->getId();

        //PrepareData method
        //$stock_data = $result[$product_id]['product']['stock_data'];
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('product_id', $product_id, 'eq')->create();
        $items = $this->repository->getList($searchCriteria)->getItems();
        $loadedData = [];
        /** @var \InStore\PickUp\Model\Product $product */
        foreach ($items as $product) {
            $loadedData[] = $product->getData();
        }
        $result[$product_id]['product']['pickup_stock'] = $loadedData;
        return $result;
    }
}