<?php
namespace InStore\PickUp\Setup;

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
        if (!$installer->tableExists('pickup_store')) {
            $table = $installer->getConnection()->newTable($installer->getTable('pickup_store'))
                ->addColumn(
                    'pickup_store_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'primary' => true,
                        'auto_increment' => true,
                        'unsigned' => true
                    ],
                    'PickUp Store Id'
                )
                ->addIndex(
                    $installer->getIdxName('pickup_store', ['pickup_store_id']),
                    ['pickup_store_id'])
                ->addColumn(
                    'store_name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false
                    ],
                    'PickUp Store Name'
                )
                ->addIndex(
                    $installer->getIdxName('pickup_store', ['store_name']),
                    ['store_name'])
                ->addColumn(
                    'store_address',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false
                    ],
                    'PickUp Store Address'
                )
                ->addColumn(
                    'store_contacts',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false
                    ],
                    'PickUp Store Contacts'
                )
                ->addColumn(
                    'creation_time',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT
                    ],
                    'Creation Time'
                )
                ->addColumn(
                    'update_time',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT_UPDATE
                    ],
                    'Update Time'
                )
                ->addColumn(
                    'is_active',
                    Table::TYPE_BOOLEAN,
                    null,
                    [
                        'nullable' => false
                    ],
                    'Is Active'
                )
                ->addColumn(
                    'store_id',
                    Table::TYPE_SMALLINT,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Store View'
                )
                ->addIndex(
                    $installer->getIdxName('store_id', ['store_id']),
                    ['store_id'])
                ->addForeignKey(
                    $installer->getFkName(
                        'pickup_store',
                        'store_id',
                        'store',
                        'store_id'
                    ),
                    'store_id',
                    $installer->getTable('store'),
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('PickUp Stores');
            $installer->getConnection()->createTable($table);
        }

        if (!$installer->tableExists('product_in_store')) {
            $table = $installer->getConnection()->newTable($installer->getTable('product_in_store'));
            $table->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'primary' => true,
                    'auto_increment' => true,
                    'unsigned' => true
                ],
                'Entity Id'
                )
                ->addColumn(
                'product_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'primary' => false,
                    'auto_increment' => false,
                    'unsigned' => true
                ],
                'Product in Store Id'
                )
                ->addColumn(
                    'pickup_store_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'PickUp Store Id'
                )
                ->addColumn(
                    'qty_in_store',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'QTY in Store'
                )
                ->addColumn(
                    'creation_time',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' =>Table::TIMESTAMP_INIT
                    ],
                    'Creation Time'
                )
                ->addColumn(
                    'update_time',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' =>Table::TIMESTAMP_INIT_UPDATE
                    ],
                    'Update Time'
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'product_in_store',
                        'pickup_store_id',
                        'pickup_store',
                        'pickup_store_id'
                    ),
                    'pickup_store_id',
                    $installer->getTable('pickup_store'),
                    'pickup_store_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('Products in PickUp Stores');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}