<?php

namespace Academy\Lesson6\Block;

use Magento\Framework\View\Element\Template;

class BackToDashboard extends Template
{
    public function getBackUrl()
    {
        return $this->getUrl('customer/account/');
    }
}
