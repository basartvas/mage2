<?php
namespace Academy\Lesson7\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('news')) {
            $table = $installer->getConnection()->newTable($installer->getTable('news'));
            $table->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'primary' => true,
                    'auto_increment' => true,
                    'unsigned' => true
                ],
                'ID'
            )
                ->addColumn(
                    'identifier',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                    ],
                    'Identifier'
                )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                    ],
                    'Identifier'
                )

                ->setComment('News');
            $installer->getConnection()->createTable($table);
        }

        title,
        content,
        author,
        creation_time,
        update_time,
        is_active,
        sort_order
        $installer->endSetup();
    }
}
