<?php

namespace InStore\PickUp\Plugin;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\ShippingInterface;
use Magento\Quote\Model\ShippingAssignment;
use InStore\PickUp\Model\Carrier\PickupInStore;


class ShippingAssignmentPlugin
{

public function beforeSetShipping($subject, ShippingInterface $value)
{
$method = $value->getMethod();
/** @var AddressInterface $address */
$address = $value->getAddress();
if ($method === 'pickup_shipping_method'.'_'.'pickup_shipping_method'
&& $address->getExtensionAttributes()
&& $address->getExtensionAttributes()->getPickupStore()
) {
$address->setPickupStore($address->getExtensionAttributes()->getPickupStore());
}
elseif ($method !==  'pickup_shipping_method'.'_'.'pickup_shipping_method') {
//reset inpost machine when changing shipping method
$address->setPickupStore(null);
}
return [$value];
}
}