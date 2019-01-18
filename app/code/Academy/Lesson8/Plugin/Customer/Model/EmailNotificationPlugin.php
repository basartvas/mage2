<?php

namespace Academy\Lesson8\Plugin\Customer\Model;

use Magento\Customer\Model\EmailNotification;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class EmailNotificationPlugin
 * @package Academy\Lesson8\Plugin\Customer\Model
 */
class EmailNotificationPlugin
{
    const XML_PATH_IS_CONFIRM = 'email_settings/registration/send';
    const NEW_ACCOUNT_EMAIL_REGISTERED = 'customer/create_account/email_template';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfigInterface;

    /**
     * EmailNotificationPlugin constructor.
     * @param ScopeConfigInterface $scopeConfigInterface
     */
    public function __construct(
        ScopeConfigInterface $scopeConfigInterface
    ) {
        $this->scopeConfigInterface = $scopeConfigInterface;
    }

    /**
     * @return bool
     */
    protected function isConfirmationRequired()
    {
        return (bool)$this->scopeConfigInterface->getValue(
            self::XML_PATH_IS_CONFIRM,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param EmailNotification $subject
     * @param callable $proceed
     * @param CustomerInterface $customer
     * @param string $type
     * @param string $backUrl
     * @param int $storeId
     * @param null $sendemailStoreId
     */
    public function aroundNewAccount(
        EmailNotification $subject,
        callable $proceed,
        CustomerInterface $customer,
        $type = self::NEW_ACCOUNT_EMAIL_REGISTERED,
        $backUrl = '',
        $storeId = 0,
        $sendemailStoreId = null
    ) {
        if($this->isConfirmationRequired()){
            $proceed(
                $customer,
                $type,
                $backUrl,
                $storeId,
                $sendemailStoreId
            );
        }
    }
}