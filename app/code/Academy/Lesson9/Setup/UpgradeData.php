<?php

namespace Academy\Lesson9\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\BlockRepository;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\PageRepository;

/**
 * Class UpgradeData
 * @package Academy\Lesson9\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var BlockFactory
     */
    protected $blockFactory;

    /**
     * @var BlockRepository
     */
    protected $blockRepository;

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * UpgradeData constructor.
     * @param BlockFactory $blockFactory
     * @param BlockRepository $blockRepository
     * @param PageFactory $pageFactory
     * @param PageRepository $pageRepository
     */
    public function __construct(
        BlockFactory $blockFactory,
        BlockRepository $blockRepository,
        PageFactory $pageFactory,
        PageRepository $pageRepository
    ) {
        $this->blockFactory = $blockFactory;
        $this->blockRepository = $blockRepository;
        $this->pageFactory = $pageFactory;
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        if (version_compare($context->getVersion(), '1.1.0', '<=')) {
            $block = $this->blockFactory->create();
            $block->setTitle('My Block')
                ->setIdentifier('my-cms-block')
                ->setContent('{{widget type="Academy\Lesson9\Block\Widget\Posts" some_title="Title" some_text="Text"}}')
                ->setIsActive(true);
            $this->blockRepository->save($block);
        }
        if (version_compare($context->getVersion(), '1.1.0', '<=')) {
            $page = $this->pageFactory->create();
            $page->setTitle('My CMS page')
                ->setIdentifier('my-cms-page')
                ->setContent('{{block class="Magento\Cms\Block\Block"    block_id="my-cms-block"}}')
                ->setIsActive(true)
                ->setPageLayout('1column');
            $this->pageRepository->save($page);
        }
    }
}
