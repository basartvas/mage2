<?php

namespace Academy\UpdateName\Controller\User;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;


class ChangeName extends Action
{
    protected $resultPageFactory;
    protected $customerSession;
    protected $redirectFactory;

    public function __construct(Context $context,
                                PageFactory $resultPageFactory,
                                Session $customerSession,
                                RedirectFactory $redirectFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->customerSession = $customerSession;
        $this->redirectFactory = $redirectFactory;
    }

    public function execute()
    {
        if ($this->customerSession->isLoggedIn()) {
            $resultPageFactory = $this->resultPageFactory->create();
            return $resultPageFactory;
        } else {
            return $this->redirectFactory->create()->setPath('customer/account/login');
        }
    }
}