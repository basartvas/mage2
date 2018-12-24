<?php

namespace Academy\UpdateName\Block\User;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Session;

class Index extends Template
{
    protected $customerSession;

    public function __construct(
        Context $context,
        Session $customerSession
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
    }

    public function getUserName()
    {
        return $this->customerSession->getCustomer()->getName();
    }

}