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
 * @method ResourceModel\News getResource()
 * @method ResourceModel\News\Collection getCollection()
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

    public function getId(): int
    {
        return (int)$this->_getData('id');
    }

    public function getIdentifier(): string
    {
        return $this->getData('identifier');
    }

    public function setIdentifier(string $identifier)
    {
        return $this->setData('identifier', $identifier);
    }

    public function getTitle(): string
    {
        return $this->getData('identifier');
    }

    public function setTitle(string $title)
    {
        return $this->setData('title', $title);
    }

    public function getContent(): string
    {
        return $this->getData('content');
    }

    public function setContent(string $content)
    {
        return $this->setData('content', $content);
    }

    public function getAuthor(): string
    {
        return $this->getData('author');
    }

    public function setAuthor(string $author)
    {
        return $this->setData('author', $author);
    }

    public function getCreationTime(): string
    {
        return $this->getData('creation_time');
    }

    public function getUpdateTime(): string
    {
        return $this->getData('update_time');
    }

    public function getIsActive(): bool
    {
        return $this->getData('is_active');
    }

    public function setIsActive(bool $isActive)
    {
        return $this->setData('isActive', $isActive);
    }

    public function getSortOrder(): int
    {
        return $this->getData('sort_order');
    }

    public function setSortOrder(int $sortOrder)
    {
        return $this->setData('sortOrder', $sortOrder);
    }
}