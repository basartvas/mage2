<?php

namespace Academy\Lesson6\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Response\RedirectInterface;

class BackToOverview extends Template
{
    /**
     * @var RedirectInterface
     */
    protected $redirectInterface;

    /**
     * BackToOverview constructor.
     * @param Context $context
     * @param RedirectInterface $redirectInterface
     */
    public function __construct(
        Context $context,
        RedirectInterface $redirectInterface
    ){
        parent::__construct($context);
        $this->redirectInterface = $redirectInterface;
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->redirectInterface->getRefererUrl();
    }
}
