<?php

namespace Academy\Lesson8\Plugin\Controller\Account;

use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Class LoginPostPlugin
 * @package Academy\Lesson8\Plugin\Controller\Account
 */
class LoginPostPlugin
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepositoryInterface;

    /**
     * LoginPostPlugin constructor.
     * @param Context $context
     * @param Session $customerSession
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->context = $context;
        $this->customerSession = $customerSession;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
    }

    /**
     * @param \Magento\Customer\Controller\Account\LoginPost $subject
     * @param $result
     * @return mixed
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\State\InputMismatchException
     */
    public function afterExecute(
        \Magento\Customer\Controller\Account\LoginPost $subject,
        $result
    ) {
        $id = $this->customerSession->getCustomer()->getId();
        $customer = $this->customerRepositoryInterface->getById($id);
        $loginNumber = $customer->getCustomAttribute('login_number')->getValue();
        $customer->setCustomAttribute('login_number', ($loginNumber + 1));
        $this->customerRepositoryInterface->save($customer);
        return $result;
    }
}