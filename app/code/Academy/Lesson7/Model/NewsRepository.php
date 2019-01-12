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

/**
 * Class NewsRepository
 * @package Academy\Lesson7\Model
 */
class NewsRepository implements NewsRepositoryInterface
{
    /**
     * @var NewsResource
     */
    protected $newsResource;

    /**
     * @var NewsFactory
     */
    protected $newsFactory;

    /**
     * @var NewsCollectionFactory
     */
    protected $newsCollectionFactory;

    /**
     * @var SearchResultsInterfaceFactory
     */
    protected $searchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * NewsRepository constructor.
     * @param NewsResource $newsResource
     * @param NewsFactory $newsFactory
     * @param NewsCollectionFactory $newsCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultsInterfaceFactory
     */
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

    /**
     * @param News $news
     * @return News|mixed
     * @throws CouldNotSaveException
     */
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

    /**
     * @param int $id
     * @return News|mixed
     * @throws NoSuchEntityException
     */
    public function getById(int $id)
    {
        $news = $this->newsFactory->create();
        $this->newsResource->load($news, $id);
        if (!$news->getId()) {
            throw new NoSuchEntityException(__('News with id "%1" does not exist.', $id));
        }
        return $news;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Magento\Framework\Api\SearchResultsInterface|mixed
     */
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

    /**
     * @param News $news
     * @return bool|mixed
     * @throws CouldNotDeleteException
     */
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

    /**
     * @param int $id
     * @return bool|mixed
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id)
    {
        return $this->delete($this->getById($id));
    }
}


