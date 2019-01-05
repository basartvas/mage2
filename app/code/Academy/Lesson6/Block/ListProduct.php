<?php

namespace Academy\Lesson6\Block;

class ListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
    public function getMaterials(){
        return $this->addAttribute('name');
    }

    public function getProductDetailsHtml(\Magento\Catalog\Model\Product $product)
    {
        $html = $this->getLayout()->createBlock('Magento\Framework\View\Element\Template')->setProduct($product)->setTemplate('Academy_Lesson6::list-product.phtml')->toHtml();
        $renderer = $this->getDetailsRenderer($product->getTypeId());
        if ($renderer) {
            $renderer->setProduct($product);
            return $html.$renderer->toHtml();
        }
        return '';
    }
}
