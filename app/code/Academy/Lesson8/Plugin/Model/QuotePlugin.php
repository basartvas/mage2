<?php

namespace Academy\Lesson8\Plugin\Model;

use Magento\Quote\Model\Quote;

class QuotePlugin

{
    public function beforeAddProduct(
        Quote $subject,
        \Magento\Catalog\Model\Product $product,
        $request = null,
        $processMode = \Magento\Catalog\Model\Product\Type\AbstractType::PROCESS_MODE_FULL
    ) {
        if ($product->getPrice() < 60) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Product that you are trying to add is not available.')
            );
        }

        return [$product, $request, $processMode];
    }
}