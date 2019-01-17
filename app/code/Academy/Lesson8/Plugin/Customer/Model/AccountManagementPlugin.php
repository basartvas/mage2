<?php

namespace Academy\Lesson8\Plugin\Customer\Model;

use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class AccountManagementPlugin
{
    protected $scopeConfigInterface;

    public function __construct(
        ScopeConfigInterface $scopeConfigInterface
    ) {
        $this->scopeConfigInterface = $scopeConfigInterface;
    }

    public function aroundSendEmailConfirmation(
        AccountManagement $subject,
        callable $proceed,
        CustomerInterface $customer,
        $redirectUrl
    ) {
        if($this->scopeConfigInterface->getValue('email_settings\registration\send', ScopeInterface::SCOPE_STORE)){
            $proceed();
        }
    }
}