<?php

namespace InStore\PickUp\Model\Store;

use InStore\PickUp\Model\ResourceModel\Store\CollectionFactory;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \InStore\PickUp\Model\ResourceModel\Store\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $storeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $storeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $storeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \InStore\PickUp\Model\Store $store */
        foreach ($items as $store) {
            $this->loadedData[$store->getPickupStoreId()] = $store->getData();
        }
        return $this->loadedData;
    }
}
