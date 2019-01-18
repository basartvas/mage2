<?php

namespace Academy\Lesson8\Plugin\Model;

use Magento\Quote\Model\Quote;
use Magento\Framework\App\Config\ScopeConfigInterface;
    
class QuotePlugin

{
    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    protected function getMinPrice()
    {
        return $this->scopeConfig->getValue(
            'catalog/price/minimal',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function beforeAddProduct(
        Quote $subject,
        \Magento\Catalog\Model\Product $product,
        $request = null,
        $processMode = \Magento\Catalog\Model\Product\Type\AbstractType::PROCESS_MODE_FULL
    ) {
        if ($product->getPrice() < $this->getMinPrice()) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Product that you are trying to add is not available.')
            );
        }
        return [$product, $request, $processMode];
    }
}