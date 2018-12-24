<?php

namespace Academy\UpdateName\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Model\Auth\Session;

class Index extends Template
{
    protected $adminSession;

    public function __construct(
        Context $context,
        Session $adminSession
    ) {
        parent::__construct($context);
        $this->adminSession = $adminSession;
    }

    public function getAdminName()
    {
        return $this->adminSession->getUser()->getName();
    }

}