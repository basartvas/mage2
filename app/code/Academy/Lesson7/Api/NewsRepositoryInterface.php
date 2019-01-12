<?php

namespace Academy\Lesson7\Api;

use Academy\Lesson7\Model\News;

interface NewsRepositoryInterface
{
    /**
     * @param News $news
     * @return mixed
     */
    function save(News $news);

    /**
     * @param int $id
     * @return mixed
     */
    function getById(int $id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return mixed
     */
    function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria);

    /**
     * @param News $news
     * @return mixed
     */
    function delete(News $news);

    /**
     * @param int $id
     * @return mixed
     */
    function deleteById(int $id);
}