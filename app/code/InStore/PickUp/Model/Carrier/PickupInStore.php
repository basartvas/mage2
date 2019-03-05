<?php

namespace InStore\PickUp\Model\Carrier;

use Magento\Framework\App\Config\ScopeConfigInterface;
/*use Magento\Framework\DataObject;*/
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
/*use Magento\Shipping\Model\Config;*/
use Magento\Shipping\Model\Rate\ResultFactory;
/*use Magento\Store\Model\ScopeInterface;*/
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
/*use Magento\Quote\Model\Quote\Address\RateResult\Method;*/
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Psr\Log\LoggerInterface;

class PickupInStore extends AbstractCarrier implements CarrierInterface
{
    protected $code = 'pickup_shipping_method';
    protected $isFixed = true;
    protected $rateResultFactory;
    protected $rateMethodFactory;
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        array $data = []
    )
    {
        $this->rateResultFactory = $rateResultFactory;
        $this->rateMethodFactory = $rateMethodFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    public function getAllowedMethods()
    {
        return [$this->getCarrierCode() => __($this->getConfigData('name'))];
    }

    public function collectRates(RateRequest $request)
    {
        if (!$this->isActive())
        {
            return false;
        }
        $result = $this->rateResultFactory->create();
        $shippingPrice = $this->getConfigData('price');

        $method = $this->rateMethodFactory->create();

        $method->setCarrier($this->getCarrierCode());
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod($this->getCarrierCode());
        $method->setMethodTitle($this->getConfigData('name'));

        $method->setPrice($shippingPrice);
        $method->setCost($shippingPrice);

        $result->append($method);
        return $result;
    }
}
