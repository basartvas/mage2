<?php

namespace InStore\PickUp\Controller\Adminhtml\Pickup;

use Magento\Backend\App\Action\Context;
use InStore\PickUp\Api\StoreRepositoryInterface as StoreRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use InStore\PickUp\Api\Data\StoreInterface;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'InStore_PickUp::pickup_stores';

    /**
     * @var \InStore\PickUp\Api\StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param StoreRepository $storeRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        StoreRepository $storeRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->storeRepository = $storeRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $storeId) {
                    /** @var \InStore\PickUp\Model\Store $store */
                    $store = $this->storeRepository->getById($storeId);
                    try {
                        $store->setData(array_merge($store->getData(), $postItems[$storeId]));
                        $this->storeRepository->save($store);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithStoreId(
                            $store,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message
     *
     * @param StoreInterface $store
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithStoreId(StoreInterface $store, $errorText)
    {
        return '[Store ID: ' . $store->getPickupStoreId() . '] ' . $errorText;
    }
}
