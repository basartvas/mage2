<?php

namespace Academy\UpdateName\Controller\Adminhtml\Admin;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\Auth\Session;
use Magento\User\Model\User;


class ChangeNamePost extends Action
{
    protected $resultPageFactory;
    protected $resultRedirectFactory;
    protected $adminSession;
    protected $adminUser;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        RedirectFactory $resultRedirectFactory,
        Session $adminSession,
        User $adminUser
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->adminSession = $adminSession;
        $this->adminUser = $adminUser;
    }


    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $validatedParams = $this->validatedParams();

            $username = $this->adminSession->getUser()->getUserName();
            $user = $this->adminUser->loadByUsername($username);
            $user->setFirstName($validatedParams['first-name']);
            $user->setLastName($validatedParams['last-name']);
            $user->save();
            $this->messageManager->addSuccessMessage(
                __('You have changed your name successfully!')
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->resultRedirectFactory->create()->setPath('update/admin/changename');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            return $this->resultRedirectFactory->create()->setPath('update/admin/changename');
        }
        return $this->resultRedirectFactory->create()->setPath('update/admin/changenamesuccess');
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
?>