<?php

namespace InStore\PickUp\Model\Store;

use InStore\PickUp\Model\ResourceModel\Store\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

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
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $storeCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $storeCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
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
            $this->loadedData[$store->getId()] = $store->getData();
        }

        $data = $this->dataPersistor->get('instore_pickup_store');
        if (!empty($data)) {
            $store = $this->collection->getNewEmptyItem();
            $store->setData($data);
            $this->loadedData[$store->getId()] = $store->getData();
            $this->dataPersistor->clear('instore_pickup_store');
        }

        return $this->loadedData;
    }
}
