<?php

namespace Academy\UpdateName\Controller\User;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Message\ManagerInterface;

class ChangeNamePost extends Action
{
    protected $page_factory;
    protected $redirect_factory;
    protected $customer_repository;
    protected $customer_session;
    protected $messageManager;


    public function __construct(Context $context,
                                PageFactory $page_factory,
                                RedirectFactory $redirect_factory,
                                CustomerRepositoryInterface $customer_repository,
                                Session $customer_session,
                                ManagerInterface $messageManager)
    {
        $this->page_factory = $page_factory;
        $this->redirect_factory = $redirect_factory;
        $this->customer_repository = $customer_repository;
        $this->customer_session = $customer_session;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $validated_params = $this->validatedParams();
            $customer = $this->customer_repository->getById(
                $this->customer_session->getCustomerId()
            );
            $customer->setFirstname($validated_params['first-name']);
            $customer->setLastname($validated_params['last-name']);
            $this->customer_repository->save($customer);
            $this->messageManager->addSuccessMessage(
                __('You have changed your name successfully!')
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->redirect_factory->create()->setPath('update_name/user/changename');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            return $this->redirect_factory->create()->setPath('update_name/user/changename');
        }
        return $this->redirect_factory->create()->setPath('update_name/user/changenamesuccess');
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
