<?php

namespace Academy\UpdateName\Controller\Adminhtml\Administrator;

use Magento\Backend\App\Action;

class ChangeName extends Action
{

    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }


    public function execute()
    {
        return  $resultPage = $this->resultPageFactory->create();
    }
}
?>