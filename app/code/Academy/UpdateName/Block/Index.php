<?php

namespace Academy\UpdateName\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    protected function _prepareLayout()
    {

    }

    public function getChangeHref()
    {
        return $this->getUrl('update_name/user/changename');
    }
}