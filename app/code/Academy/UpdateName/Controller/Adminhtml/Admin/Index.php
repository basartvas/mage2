<?php

namespace Academy\UpdateName\Controller\Adminhtml\Admin;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Auth\Session;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;
    protected $adminSession;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Session $adminSession)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->adminSession = $adminSession;
    }

    public function execute()
    {
        $adminName = $this->adminSession->getUser()->getName();
        $resultPageObject = $this->resultPageFactory->create();
        $resultPageObject->getLayout()->getBlock('update_admin_index')->setAdminName($adminName);
        return $resultPageObject;
    }
}
?>