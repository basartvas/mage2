<?php

namespace InStore\PickUp\Api\Data;

interface ProductInterface
{
    /**
     * @return int
     */
    public function getProductId();

    /**
     * @param int $id
     * @return void
     */
    public function setProductId($id);

    /**
     * @return string
     */
    public function getSku();

    /**
     * @param string $sku
     * @return void
     */
    public function setSku($sku);

    /**
     * @return int
     */
    public function getPickupStoreId();

    /**
     * @param int $storeId
     * @return void
     */
    public function setPickupStoreId($storeId);

    /**
     * @return int
     */
    public function getQtyInStore();

    /**
     * @param int $qty
     * @return void
     */
    public function setQtyInStore($qty);

    /**
     * @return string
     */
    public function getCreationTime();

    /**
     * @param string $stamp
     * @return void
     */
    public function setCreationTime($stamp);

    /**
     * @return string
     */
    public function getUpdateTime();

    /**
     * @param string $stamp
     * @return void
     */
    public function setUpdateTime($stamp);
}