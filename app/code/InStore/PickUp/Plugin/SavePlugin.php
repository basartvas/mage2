<?php

namespace InStore\PickUp\Plugin;

use Magento\Catalog\Controller\Adminhtml\Product\Save;
use InStore\PickUp\Api\ProductRepositoryInterface as ProductRepository;
use InStore\PickUp\Model\ProductFactory;
use Magento\Framework\Message\ManagerInterface;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class ProductDataProviderPlugin
 * @package InStore\PickUp\Plugin
 */
class SavePlugin
{
    private $productRepository;
    private $productFactory;
    private $messageManager;

    public function __construct(
        ProductRepository $productRepository,
        ProductFactory $productFactory,
        ManagerInterface $messageManager
    ) {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        $this->messageManager = $messageManager;
    }

    public function afterExecute(
        Save $subject,
        $result
    ) {
        $data = $subject->getRequest()->getPostValue();
        $id = $subject->getRequest()->getParam('id');
        $pickupStock = $data['product']['pickup_stock'];

        /*
        try {
            $model = $this->productRepository->getById($productId);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage(__('Please revisit PickUp Stock for the Product'));
            return $result;
        }
        */
        foreach ($pickupStock as $pickupProduct){
            $pickupProduct['product_id'] = $id;
            /** @var \InStore\PickUp\Model\Product $model */
            $model = $this->productFactory->create();
            //$model->setProductId($id);
            $model->setData($pickupProduct);
            try {
                $this->productRepository->save($model);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $result;
    }
}