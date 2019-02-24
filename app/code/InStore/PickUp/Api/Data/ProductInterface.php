<?php

namespace InStore\PickUp\Api\Data;

interface ProductInterface
{
    /**
     * @return int
     */
    public function getEntId();

    /**
     * @param int $id
     * @return void
     */
    public function setEntId(int $id);

    /**
     * @return int
     */
    public function getProductId();

    /**
     * @param int $id
     * @return void
     */
    public function setProductId(int $id);

    /**
     * @return int
     */
    public function getPickupStoreId();

    /**
     * @param int $storeId
     * @return void
     */
    public function setPickupStoreId(int $storeId);

    /**
     * @return int
     */
    public function getQtyInStore();

    /**
     * @param int $qty
     * @return void
     */
    public function setQtyInStore(int $qty);

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
}