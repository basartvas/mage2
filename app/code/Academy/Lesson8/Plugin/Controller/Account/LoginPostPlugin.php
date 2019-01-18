<?php

namespace Academy\Lesson8\Plugin\Controller\Account;

use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Magento\Customer\Api\CustomerRepositoryInterface;

class LoginPostPlugin
{
    protected $context;
    protected $customerSession;
    protected $customerRepositoryInterface;

    public function __construct(
        Context $context,
        Session $customerSession,
        CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->context = $context;
        $this->customerSession = $customerSession;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
    }
    public function afterExecute(
        \Magento\Customer\Controller\Account\LoginPost $subject,
        $result)
    {
        $id = $this->customerSession->getCustomer()->getId();
        $customer = $this->customerRepositoryInterface->getById($id);
        $loginNumber = $customer->getCustomAttribute('login_number')->getValue();
        $customer->setCustomAttribute('login_number', ($loginNumber + 1));
        $this->customerRepositoryInterface->save($customer);
        return $result;
    }
}