<?php

namespace InStore\PickUp\Controller\Adminhtml\Pickup;

use Magento\Backend\App\Action\Context;
use InStore\PickUp\Api\StoreRepositoryInterface as StoreRepository;
use InStore\PickUp\Model\Store;
use InStore\PickUp\Model\StoreFactory;
use Magento\Framework\Exception\LocalizedException;


class Save extends \Magento\Backend\App\Action
{
    /**
     * @var StoreFactory
     */
    private $storeFactory;

    /**
     * @var StoreRepository
     */
    private $storeRepository;

    /**
     * @param Context $context
     * @param StoreFactory $storeFactory
     * @param StoreRepository $storeRepository
     */
    public function __construct(
        Context $context,
        StoreFactory $storeFactory,
        StoreRepository $storeRepository
    ) {
        $this->storeFactory = $storeFactory;
        $this->storeRepository = $storeRepository;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getParams();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Store::STATUS_ENABLED;
            }
            if (empty($data['pickup_store_id'])) {
                $data['pickup_store_id'] = null;
            }

            /** @var \InStore\PickUp\Model\Store $model */
            $model = $this->storeFactory->create();

            $id = $this->getRequest()->getParam('pickup_store_id');
            if ($id) {
                try {
                    $model = $this->storeRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This Store no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->storeRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the Store.'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['pickup_store_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Store.'));
            }

            return $resultRedirect->setPath('*/*/edit', ['pickup_store_id' => $this->getRequest()->getParam('pickup_store_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
