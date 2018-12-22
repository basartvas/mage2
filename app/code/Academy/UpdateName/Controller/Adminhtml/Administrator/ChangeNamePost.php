<?php

namespace Academy\UpdateName\Controller\Adminhtml\Administrator;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\RedirectFactory;


class ChangeNamePost extends Action
{

    protected $resultPageFactory;
    protected $resultRedirectFactory;
    protected $session;
    protected $adminUser;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        RedirectFactory $resultRedirectFactory,
        \Magento\Backend\Model\Auth\Session $session,
        \Magento\User\Model\User $adminUser
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->session = $session;
        $this->adminUser = $adminUser;
    }


    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $validated_params = $this->validatedParams();

            $username = $this->session->getUser()->getUserName();
            $user = $this->adminUser->loadByUsername($username);
            $user->setFirstName($validated_params['first-name']);
            $user->setLastName($validated_params['last-name']);
            $user->save();
            $this->messageManager->addSuccessMessage(
                __('You have changed your name successfully!')
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->resultRedirectFactory->create()->setPath('adminnewpage/administrator/changename');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            return $this->resultRedirectFactory->create()->setPath('adminnewpage/administrator/changename');
        }
        return $this->resultRedirectFactory->create()->setPath('adminnewpage/administrator/changename');
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