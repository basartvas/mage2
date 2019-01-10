<?php
declare(strict_types=1);

namespace Academy\Lesson7\Model\ResourceModel\News;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
/**
 * Class Collection
 * @package Academy\Lesson7\Model\ResourceModel\News
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    protected function _construct()
    {
        $this->_init(
            \Academy\Lesson7\Model\News::class,
            \Academy\Lesson7\Model\ResourceModel\News::class
        );
    }
}