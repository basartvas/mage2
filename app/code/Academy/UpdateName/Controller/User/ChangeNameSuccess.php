<?php

namespace Academy\UpdateName\Controller\User;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Academy\UpdateName\Helper\Data as Helper;

class ChangeNameSuccess extends Action
{
    protected $pageFactory;
    protected $customerSession;
    protected $redirectFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Session $customerSession,
        RedirectFactory $redirectFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->customerSession = $customerSession;
        $this->redirectFactory = $redirectFactory;
    }

    public function execute()
    {
        if ($this->customerSession->isLoggedIn()) {
            return $this->pageFactory->create();
        }
        return $this->redirectFactory->create()->setPath(Helper::LOGIN_PATH);
    }
}