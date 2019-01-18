<?php

namespace Academy\Lesson8\Plugin\Model;

use Magento\Quote\Model\Quote;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class QuotePlugin
 * @package Academy\Lesson8\Plugin\Model
 */
class QuotePlugin
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * QuotePlugin constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     */
    protected function getMinPrice()
    {
        return $this->scopeConfig->getValue(
            'catalog/price/minimal',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param Quote $subject
     * @param \Magento\Catalog\Model\Product $product
     * @param null $request
     * @param string $processMode
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function beforeAddProduct(
        Quote $subject,
        \Magento\Catalog\Model\Product $product,
        $request = null,
        $processMode = \Magento\Catalog\Model\Product\Type\AbstractType::PROCESS_MODE_FULL
    ) {
        if ($product->getTypeId() == 'simple' && $product->getPrice() < $this->getMinPrice()) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Product that you are trying to add is not available.')
            );
        }
        return [$product, $request, $processMode];
    }
}