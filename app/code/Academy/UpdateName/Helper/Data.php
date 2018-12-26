<?php

namespace Academy\UpdateName\Helper;

use Magento\Framework\App\Helper\AbstractHelper;


class Data extends AbstractHelper
{
    const LOGIN_PATH = 'customer/account/login';
    const USER_CHANGE_NAME_PATH = 'update/user/changename';
    const USER_CHANGE_NAME_POST = 'update/user/changenamepost';
    const USER_CHANGE_NAME_SUCCESS_PATH = 'update/user/changenamesuccess';
    const ADMIN_CHANGE_NAME_PATH = 'update/admin/changename';
    const ADMIN_CHANGE_NAME_POST = 'update/admin/changenamepost';
    const ADMIN_CHANGE_NAME_SUCCESS_PATH = 'update/admin/changenamesuccess';
}