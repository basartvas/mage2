<?php

namespace Academy\Lesson7\Api;

use  Academy\Lesson7\Model\News;

interface NewsRepositoryInterface
{
    function save(News $news);

    function getById(int $id);

    function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria);

    function delete(News $news);

    function deleteById(int $id);
}