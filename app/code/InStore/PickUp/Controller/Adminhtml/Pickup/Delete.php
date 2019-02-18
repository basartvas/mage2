<?php
namespace InStore\PickUp\Controller\Adminhtml\Pickup;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use InStore\PickUp\Api\StoreRepositoryInterface as StoreRepository;
use InStore\PickUp\Model\StoreFactory;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \InStore\PickUp\Api\StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * @var StoreFactory
     */
    protected $storeFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param StoreRepository $storeRepository
     * @param StoreFactory $storeFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        StoreRepository $storeRepository,
        StoreFactory $storeFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->storeRepository = $storeRepository;
        $this->storeFactory = $storeFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        try {
            $store = $this->storeRepository->getById($id);
            $this->storeRepository->delete($store);
            $this->messageManager->addSuccessMessage(
                __('Store was successfully deleted.')
            );
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                $e->getMessage()
            );
        }
    }
}