<?php

namespace Academy\UpdateName\Controller\User;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;


class ChangeNamePost extends Action
{
    protected $page_factory;
    protected $redirect_factory;
    protected $customer_repository;
    protected $customer_session;


    public function __construct(Context $context,
                                PageFactory $page_factory,
                                RedirectFactory $redirect_factory,
                                CustomerRepositoryInterface $customer_repository,
                                Session $customer_session)
    {
        $this->page_factory = $page_factory;
        $this->redirect_factory = $redirect_factory;
        $this->customer_repository = $customer_repository;
        $this->customer_session = $customer_session;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws LocalizedException
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\State\InputMismatchException
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        } else {
            $validated_params = $this->validatedParams();

            $customer = $this->customer_repository->getById(
                $this->customer_session->getCustomerId()
            );

            $customer->setFirstname($validated_params['first-name']);
            $customer->setLastname($validated_params['last-name']);

            $this->customer_repository->save($customer);

            return $this->redirect_factory->create()->setPath('customer/account');

        }
    }

    /**
     * @return array
     * @throws LocalizedException
     */
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
