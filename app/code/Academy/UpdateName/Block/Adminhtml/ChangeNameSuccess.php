<?php

namespace Academy\UpdateName\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Academy\UpdateName\Helper\Data as Helper;

class ChangeNameSuccess extends Template
{
    public function getChangeNamePath()
    {
        return Helper::ADMIN_CHANGE_NAME_PATH;
    }
}