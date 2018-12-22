<?php

namespace Academy\UpdateName\Controller\Adminhtml\Administrator;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Auth\Session;

class Index extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    protected $adminSession;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Session $adminSession)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->adminSession = $adminSession;
    }

    /**
     * Load the page defined in view/adminhtml/layout/exampleadminnewpage_helloworld_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $admin_name = $this->adminSession->getUser()->getName();
        $page_object = $this->resultPageFactory->create();
        $page_object->getLayout()->getBlock('adminnewpage_administrator_index')->setAdminName($admin_name);
        return $page_object;
    }
}
?>