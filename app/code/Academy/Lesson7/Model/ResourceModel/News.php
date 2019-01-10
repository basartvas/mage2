<?php
declare(strict_types=1);

namespace Academy\Lesson7\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Sample
 * @package Academy\Lesson7\Model\ResourceModel
 */
class News extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('news', 'id');
    }
}