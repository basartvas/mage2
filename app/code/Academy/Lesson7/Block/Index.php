<?php

namespace Academy\Lesson7\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $newsRepo;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Academy\Lesson7\Model\NewsRepository $newsRepo
    )
    {
        $this->newsRepo = $newsRepo;
        parent::__construct($context);
    }

  public function getNewsOne()
    {
        $news = $this->newsRepo->getById(1)->getAuthor();
        return var_dump($news);
    }
}