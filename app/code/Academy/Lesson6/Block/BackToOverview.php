<?php

namespace Academy\Lesson6\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Response\RedirectInterface;

class BackToOverview extends Template
{
    protected $redirectInterface;

    public function __construct(
        Context $context,
        RedirectInterface $redirectInterface
    ){
        parent::__construct($context);
        $this->redirectInterface = $redirectInterface;
    }

    public function getBackUrl()
    {
        return $this->redirectInterface->getRefererUrl();
    }
}
