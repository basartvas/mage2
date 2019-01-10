<?php

namespace Academy\Lesson7\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $newsFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Academy\Lesson7\Model\NewsFactory $newsFactory
    )
    {
        $this->newsFactory = $newsFactory;
        parent::__construct($context);
    }

    public function getNewsOne()
    {
        $news = $this->newsFactory->create();
        $news = $news->load(1);
        return var_dump($news->getData());
    }
}