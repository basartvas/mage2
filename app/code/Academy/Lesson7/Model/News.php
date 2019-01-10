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
}