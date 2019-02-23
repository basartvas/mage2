<?php

namespace InStore\PickUp\Plugin;

use Magento\Catalog\Ui\DataProvider\Product\Form\ProductDataProvider;
use Magento\Framework\Registry;
use InStore\PickUp\Model\ResourceModel\Product\CollectionFactory;


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
    private $collection;

    public function __construct(
        Registry $registry,
        CollectionFactory $productCollectionFactory
    ) {
        $this->registry = $registry;
        $this->collection = $productCollectionFactory->create();
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
        $items = $this->collection->getItems();
        $loadedData = [];
        /** @var \InStore\PickUp\Model\Product $product */
        foreach ($items as $product) {
            $loadedData[] = $product->getData();
        }

        $result[$product_id]['product']['pickup_stock'] = $loadedData;
        //$stock_data['pickup_stores_product_stock'] = $loadedData;
        return $result;
    }
}