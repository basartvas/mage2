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
    protected $pageFactory;
    protected $redirectFactory;
    protected $customerRepository;
    protected $customerSession;
    protected $messageManager;


    public function __construct(Context $context,
                                PageFactory $pageFactory,
                                RedirectFactory $redirectFactory,
                                CustomerRepositoryInterface $customerRepository,
                                Session $customerSession,
                                ManagerInterface $messageManager)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->redirectFactory = $redirectFactory;
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
    }

    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $validated_params = $this->validatedParams();
            $customer = $this->customerRepository->getById(
                $this->customerSession->getCustomerId()
            );
            $customer->setFirstname($validated_params['first-name']);
            $customer->setLastname($validated_params['last-name']);
            $this->customerRepository->save($customer);
            $this->messageManager->addSuccessMessage(
                __('You have changed your name successfully!')
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->redirectFactory->create()->setPath('update/user/changename');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            return $this->redirectFactory->create()->setPath('update/user/changename');
        }
        return $this->redirectFactory->create()->setPath('update/user/changenamesuccess');
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
