<?php

namespace InStore\PickUp\Block\Adminhtml\Pickup\Edit;

use Magento\Backend\Block\Template\Context;
use InStore\PickUp\Api\StoreRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * @param Context $context
     * @param StoreRepositoryInterface $storeRepository
     */
    public function __construct(
        Context $context,
        StoreRepositoryInterface $storeRepository
    ) {
        $this->context = $context;
        $this->storeRepository = $storeRepository;
    }

    /**
     * Return PickUp Store ID
     *
     * @return int|null
     */
    public function getStoreId()
    {
        $id = $this->context->getRequest()->getParam('pickup_store_id');
        if($id){
            try {
                return $this->storeRepository->getById($id)->getStoreId();
            } catch (NoSuchEntityException $e) {
            }
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
