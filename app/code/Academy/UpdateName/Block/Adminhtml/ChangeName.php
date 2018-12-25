<?php

namespace Academy\UpdateName\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Academy\UpdateName\Helper\Data as Helper;

class ChangeName extends Template
{
    public function getChangeNamePost()
    {
        return Helper::ADMIN_CHANGE_NAME_POST;
    }
}