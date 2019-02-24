<?php

namespace InStore\PickUp\Model;

use InStore\PickUp\{
    Api\Data\ProductInterface,
    Model\ResourceModel\Product as ProductResource};

use Magento\Framework\{
    DataObject\IdentityInterface,
    Model\AbstractModel
};

class Product extends AbstractModel implements ProductInterface, IdentityInterface
{
    /**
     * @var string
     */
    const CACHE_TAG = 'instore_pickup_product';

    /**
     * @var string
     */
    protected $_cacheTag = 'instore_pickup_product';

    /**
     * @var string
     */
    protected $_eventPrefix = 'instore_pickup_product';

    /**
     * return void
     */
    protected function _construct()
    {
        $this->_init(ProductResource::class);
    }

    /**
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getEntId(): int
    {
        return (int)$this->getData('entity_id');
    }

    /**
     * @param int $id
     * @return void
     */
    public function setEntId(int $id)
    {
        $this->setData('entity_id', $id);
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return (int)$this->getData('product_id');
    }

    /**
     * @param int $id
     * @return void
     */
    public function setProductId(int $id)
    {
        $this->setData('product_id', $id);
    }

    /**
     * @return int
     */
    public function getPickupStoreId(): int
    {
        return $this->getData('pickup_store_id');
    }

    /**
     * @param int $storeId
     * @return void
     */
    public function setPickupStoreId(int $storeId)
    {
        $this->setData('pickup_store_id', $storeId);
    }

    /**
     * @return int
     */
    public function getQtyInStore(): int
    {
        return $this->getData('qty_in_store');
    }

    /**
     * @param int $qty
     * @return void
     */
    public function setQtyInStore(int $qty)
    {
        $this->setData('qty_in_store', $qty);
    }

    /**
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData('creation_time');
    }

    /**
     * @param string $stamp
     * @return void
     */
    public function setCreationTime(string $stamp)
    {
        $this->setData('creation_time', $stamp);
    }

    /**
     * @return string
     */
    public function getUpdateTime(): string
    {
        return $this->getData('update_time');
    }

    /**
     * @param string $stamp
     * @return void
     */
    public function setUpdateTime(string $stamp)
    {
        $this->setData('update_time', $stamp);
    }

}