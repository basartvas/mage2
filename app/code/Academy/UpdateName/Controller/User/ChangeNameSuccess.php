<?php

namespace Academy\UpdateName\Controller\User;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;


class ChangeNameSuccess extends Action
{
    protected $pageFactory;
    protected $customerSession;
    protected $redirectFactory;

    /**
     * ChangeNameSuccess constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Session $customerSession
     * @param RedirectFactory $redirectFactory
     */
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

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if ($this->customerSession->isLoggedIn()) {
            return $this->pageFactory->create();
        } else {
            return $this->redirectFactory->create()->setPath('customer/account/login');
        }
    }
}