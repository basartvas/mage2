<?php
declare(strict_types=1);

namespace Academy\Lesson7\Model;

use Academy\Lesson7\{
    Api\Data\NewsInterface,
    Model\ResourceModel\News as NewsResource
};

use Magento\Framework\{
    DataObject\IdentityInterface,
    Model\AbstractModel
};

/**
 * Class News
 * @package Academy\Lesson7\Model
 */
class News extends AbstractModel implements NewsInterface, IdentityInterface
{
    const CACHE_TAG = 'academy_lesson7_news';
    protected $_cacheTag = 'academy_lesson7_news';
    protected $_eventPrefix = 'academy_lesson7_news';

    protected function _construct()
    {
        $this->_init(NewsResource::class);
    }

    /**
     * @return array|string[]
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->_getData('id');
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->getData('identifier');
    }

    /**
     * @param string $identifier
     * @return News|mixed
     */
    public function setIdentifier(string $identifier)
    {
        return $this->setData('identifier', $identifier);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData('identifier');
    }

    /**
     * @param string $title
     * @return News|mixed
     */
    public function setTitle(string $title)
    {
        return $this->setData('title', $title);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData('content');
    }

    /**
     * @param string $content
     * @return News|mixed
     */
    public function setContent(string $content)
    {
        return $this->setData('content', $content);
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->getData('author');
    }

    /**
     * @param string $author
     * @return News|mixed
     */
    public function setAuthor(string $author)
    {
        return $this->setData('author', $author);
    }

    /**
     * @return string
     */
    public function getCreationTime(): string
    {
        return $this->getData('creation_time');
    }

    /**
     * @return string
     */
    public function getUpdateTime(): string
    {
        return $this->getData('update_time');
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->getData('is_active');
    }

    /**
     * @param bool $isActive
     * @return News|mixed
     */
    public function setIsActive(bool $isActive)
    {
        return $this->setData('isActive', $isActive);
    }

    /**
     * @return int
     */
    public function getSortOrder(): int
    {
        return $this->getData('sort_order');
    }

    /**
     * @param int $sortOrder
     * @return News|mixed
     */
    public function setSortOrder(int $sortOrder)
    {
        return $this->setData('sortOrder', $sortOrder);
    }
}