<?php
namespace Academy\Lesson9\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class Posts
 * @package Academy\Lesson9\Block\Widget
 */
class Posts extends Template implements BlockInterface
{
    protected $_template = "widget/posts.phtml";
}