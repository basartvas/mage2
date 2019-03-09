<?php

namespace InStore\PickUp\Api;

interface OfficeManagementInterface
{
/**
* Find offices for the customer
*
* @param string $postcode
* @param string $city
* @return \InStore\PickUp\Api\Data\StoreInterface[]
*/
public function fetchOffices($postcode, $city);
}