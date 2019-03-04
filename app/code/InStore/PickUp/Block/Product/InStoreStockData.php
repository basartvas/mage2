<?php

namespace InStore\PickUp\Block\Product;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use InStore\PickUp\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;

class InStoreStockData extends Template
{
    protected $registry;
    protected $product = null;
    protected $repository;
    protected $searchCriteriaBuilder;

    public function __construct (
        Context $context,
        Registry $registry,
        ProductRepository $repository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data
    ) {
        $this->repository = $repository;
        $this->registry = $registry;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    protected function getProductId()
    {
        if (!$this->product) {
            $this->product = $this->registry->registry('product');
        }
        return $this->product->getId();
    }

    public function getInStoreStock()
    {
        $stock = [];
        $productId = $this->getProductId();
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('product_id', $productId, 'eq')->create();
        $stockInStores = $this->repository->getList($searchCriteria)->getItems();
        foreach($stockInStores as $storeStock){
            array_push($stock, $storeStock->getData());
        }
        return $stock;
    }
}