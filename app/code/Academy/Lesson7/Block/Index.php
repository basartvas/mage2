<?php

namespace Academy\Lesson7\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $newsRepo;
    protected $searchCriteriaBuilder;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Academy\Lesson7\Model\NewsRepository $newsRepo,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->newsRepo = $newsRepo;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }

    public function getNewsOne()
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('author', 'Tom%', 'like')->create();
        $items = $this->newsRepo->getList($searchCriteria)->getTotalCount();
        return $items;
    }
}