<?php

namespace Academy\Lesson8\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        if (\version_compare( $context->getVersion(), '1.1.0', '<=' )) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'login_number',
                [
                    'type'         => 'int',
                    'label'        => 'Login Number',
                    'input'        => 'int',
                    'required'     => false,
                    'visible'      => false,
                    'user_defined' => false,
                    'position'     => 999,
                    'system'       => 0,
                ]
            );
        }
        $setup->endSetup();
    }
}