<?php

namespace Academy\UpdateName\Block\User;

use Magento\Framework\View\Element\Template;
use Academy\UpdateName\Helper\Data as Helper;

class ChangeNameSuccess extends Template
{
    public function getChangeNamePath()
    {
        return Helper::USER_CHANGE_NAME_PATH;
    }
}