<?php

namespace Academy\UpdateName\Block;

use Magento\Framework\View\Element\Template;

class ChangeName extends Template
{
    protected function _prepareLayout()
    {

    }

    public function getFormAction()
    {
        return $this->getUrl('update_name/user/changenamepost');
    }
}