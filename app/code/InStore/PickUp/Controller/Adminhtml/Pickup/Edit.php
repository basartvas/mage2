<?php
namespace InStore\PickUp\Controller\Adminhtml\Pickup;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use InStore\PickUp\Api\StoreRepositoryInterface as StoreRepository;
use InStore\PickUp\Model\StoreFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends \Magento\Backend\App\Action
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
        $id = $this->getRequest()->getParam('pickup_store_id');
        $resultPage = $this->resultPageFactory->create();
        if($id){
            try {
                $store = $this->storeRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(
                    $e->getMessage()
                );
                return $this->resultRedirectFactory->create()->setPath('*/*/');
            }
            $resultPage->getConfig()->getTitle()->prepend($store->getStoreName());
            return $resultPage;
        }
        $resultPage->getConfig()->getTitle()->prepend(__('New Store'));
        return $resultPage;

    }
}
