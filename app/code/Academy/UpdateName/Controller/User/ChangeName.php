<?php

namespace Academy\UpdateName\Controller\User;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;


class ChangeName extends Action
{
    protected $page_factory;
    protected $customer_session;
    protected $redirect_factory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $page_factory
     * @param Session $customer_session
     * @param RedirectFactory $redirect_factory
     */
    public function __construct(Context $context,
                                PageFactory $page_factory,
                                Session $customer_session,
                                RedirectFactory $redirect_factory)
    {
        $this->page_factory = $page_factory;
        $this->customer_session = $customer_session;
        $this->redirect_factory = $redirect_factory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if ($this->customer_session->isLoggedIn()) {
            $page_object = $this->page_factory->create();
            return $page_object;
        } else {
            $result_redirect =  $this->redirect_factory->create();
            $result_redirect->setPath('customer/account/login');
            return $result_redirect;
        }
    }
}