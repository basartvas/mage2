<?php

namespace Academy\UpdateName\Block\User;

use Magento\Framework\View\Element\Template;
use Academy\UpdateName\Helper\Data as Helper;

class ChangeName extends Template
{
    public function getChangeNamePost()
    {
        return Helper::USER_CHANGE_NAME_POST;
    }
}