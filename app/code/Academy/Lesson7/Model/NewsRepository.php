<?php
declare(strict_types=1);

namespace Academy\Lesson7\Model;

use Academy\Lesson7\Model\ResourceModel\News as NewsResource;
use Academy\Lesson7\Model\ResourceModel\News\CollectionFactory as NewsCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Academy\Lesson7\Api\NewsRepositoryInterface as NewsRepositoryInterface;

class NewsRepository implements NewsRepositoryInterface
{
    protected $newsResource;
    protected $newsFactory;
    protected $newsCollectionFactory;
    protected $searchResultsInterfaceFactory;
    protected $collectionProcessor;

    public function __construct(
        NewsResource $newsResource,
        NewsFactory $newsFactory,
        NewsCollectionFactory $newsCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsInterfaceFactory
    ) {
        $this->newsResource = $newsResource;
        $this->newsFactory = $newsFactory;
        $this->newsCollectionFactory = $newsCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
    }

    public function save(News $news)
    {
        try {
            $this->newsResource->save($news);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the news: %1', $exception->getMessage()),
                $exception
            );
        }
        return $news;
    }

    public function getById(int $id)
    {
        $news = $this->newsFactory->create();
        $this->newsResource->load($news, $id);
        if (!$news->getId()) {
            throw new NoSuchEntityException(__('News with id "%1" does not exist.', $id));
        }
        return $news;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        $collection = $this->newsCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);
        $searchResults = $this->searchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function delete(News $news)
    {
        try {
            $this->newsResource->delete($news);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the news: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById(int $id)
    {
        return $this->delete($this->getById($id));
    }

}


