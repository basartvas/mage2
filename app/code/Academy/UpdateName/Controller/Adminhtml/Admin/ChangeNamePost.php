<?php

namespace Academy\UpdateName\Controller\Adminhtml\Admin;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\Auth\Session;
use Magento\User\Model\ResourceModel\User;

class ChangeNamePost extends Action
{
    protected $resultPageFactory;
    protected $resultRedirectFactory;
    protected $adminSession;
    protected $userResource;


    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        RedirectFactory $resultRedirectFactory,
        Session $adminSession,
        User $userResource
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->adminSession = $adminSession;
        $this->userResource = $userResource;
    }


    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$this->getRequest()->isPost()) {
            return $resultRedirect->setPath('*/*/');
        }
        try {
            $validatedParams = $this->validatedParams();
            $user = $this->adminSession->getUser();
            $user->setFirstName($validatedParams['first-name']);
            $user->setLastName($validatedParams['last-name']);
            $this->userResource->save($user);
            $this->messageManager->addSuccessMessage(
                __('You have changed your name successfully!')
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect->setPath('update/admin/changename');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            return $resultRedirect->setPath('update/admin/changename');
        }
        return $resultRedirect->setPath('update/admin/changenamesuccess');
    }

    private function validatedParams()
    {
        $request = $this->getRequest();
        if (trim($request->getParam('first-name')) === '') {
            throw new LocalizedException(__('First Name is missing'));
        }
        if (trim($request->getParam('last-name')) === '') {
            throw new LocalizedException(__('Last Name is missing'));
        }
        return $request->getParams();
    }
}
