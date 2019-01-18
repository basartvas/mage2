<?php

namespace Academy\Lesson8\Observer;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Cms\Model\Page;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class HideMinPriceProducts implements \Magento\Framework\Event\ObserverInterface
{
    protected $productRepository;
    protected $page;
    protected $actionFlag;
    protected $redirect;
    protected $scopeConfigInterface;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ActionFlag $actionFlag,
        RedirectInterface $redirect,
        ScopeConfigInterface $scopeConfigInterface
    ) {
        $this->productRepository = $productRepository;
        $this->actionFlag = $actionFlag;
        $this->redirect = $redirect;
        $this->scopeConfigInterface = $scopeConfigInterface;
    }

    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $minPrice = $this->scopeConfigInterface->getValue(
            'catalog/price/minimal',
            ScopeInterface::SCOPE_STORE
        );
        $id = $observer->getEvent()->getRequest()->getParam('id');
        $product = $this->productRepository->getById($id);
        $price = $product->getPrice();
        $typeId = $product->getTypeId();
        if($typeId == 'simple' && $price < $minPrice) {
            $controller = $observer->getControllerAction();
            $this->actionFlag->set('', Action::FLAG_NO_DISPATCH, true);
            $this->redirect->redirect($controller->getResponse(), Page::NOROUTE_PAGE_ID);
        } else {
            return $this;
        }
    }
}

