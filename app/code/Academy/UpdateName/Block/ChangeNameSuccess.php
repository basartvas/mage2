<?php

namespace Academy\UpdateName\Block;

use Magento\Framework\View\Element\Template;

class ChangeNameSuccess extends Template
{
    protected function _prepareLayout()
    {

    }

    public function getChangenameUrl()
    {
        return $this->getUrl('update_name/user/changename');
    }
}