<?php

namespace InStore\PickUp\Model;

use InStore\PickUp\{
    Api\Data\StoreInterface,
    Model\ResourceModel\Store as StoreResource
};

use Magento\Framework\{
    DataObject\IdentityInterface,
    Model\AbstractModel
};

class Store extends AbstractModel implements StoreInterface, IdentityInterface
{
    /**
     * @var string
     */
    const CACHE_TAG = 'instore_pickup_store';

    /**
     * @var string
     */
    protected $_cacheTag = 'instore_pickup_store';

    /**
     * @var string
     */
    protected $_eventPrefix = 'instore_pickup_store';

    /**
     * Store's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * return void
     */
    protected function _construct()
    {
        $this->_init(StoreResource::class);
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
    public function getPickupStoreId(): int
    {
        return (int)$this->getData('pickup_store_id');
    }

    /**
     * @param int $id
     * @return void
     */
    public function setPickupStoreId(int $id)
    {
        $this->setData('pickup_store_id', $id);
    }

    /**
     * @return string
     */
    public function getStoreName(): string
    {
        return $this->getData('store_name');
    }

    /**
     * @param string $storeName
     * @return void
     */
    public function setStoreName(string $storeName)
    {
        $this->setData('store_name', $storeName);
    }

    /**
     * @return string
     */
    public function getStoreAddress(): string
    {
        return $this->getData('store_address');
    }

    /**
     * @param string $storeAddress
     * @return void
     */
    public function setStoreAddress(string $storeAddress)
    {
        $this->setData('store_address', $storeAddress);
    }

    /**
     * @return string
     */
    public function getStoreContacts(): string
    {
        return $this->getData('store_contacts');
    }

    /**
     * @param string $storeContacts
     * @return void
     */
    public function setStoreContacts(string $storeContacts)
    {
        $this->setData('store_contacts', $storeContacts);
    }

    /**
     * @return string
     */
    public function getCreationTime(): string
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

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->getData('is_active');
    }

    /**
     * @param bool $flag
     * @return void
     */
    public function setIsActive(bool $isActive)
    {
        $this->setData('isActive', $isActive);
    }

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return $this->getData('store_id');
    }

    /**
     * @param int $id
     * @return void
     */
    public function setStoreId(int $id)
    {
        $this->setData('store_id', $id);
    }

    /**
     * Prepare store's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}