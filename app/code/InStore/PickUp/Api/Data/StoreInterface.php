<?php

namespace InStore\PickUp\Api\Data;

interface StoreInterface
{
    /**
     * @return int
     */
    public function getPickupStoreId();

    /**
     * @param int $id
     * @return void
     */
    public function setPickupStoreId(int $id);

    /**
     * @return string
     */
    public function getStoreName();

    /**
     * @param string $storeName
     * @return void
     */
    public function setStoreName(string $storeName);

    /**
     * @return string
     */
    public function getStoreAddress();

    /**
     * @param string $storeAddress
     * @return void
     */
    public function setStoreAddress(string $storeAddress);

    /**
     * @return string
     */
    public function getStoreContacts();

    /**
     * @param string $storeContacts
     * @return void
     */
    public function setStoreContacts(string $storeContacts);

    /**
     * @return string
     */
    public function getCreationTime();

    /**
     * @param string $stamp
     * @return void
     */
    public function setCreationTime(string $stamp);

    /**
     * @return string
     */
    public function getUpdateTime();

    /**
     * @param string $stamp
     * @return void
     */
    public function setUpdateTime(string $stamp);

    /**
     * @return bool
     */
    public function getIsActive();

    /**
     * @param bool $flag
     * @return void
     */
    public function setIsActive(bool $flag);

    /**
     * @return int
     */
    public function getStoreId();

    /**
     * @param int $id
     * @return void
     */
    public function setStoreId(int $id);
}