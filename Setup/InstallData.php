<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Quote\Setup\QuoteSetup;
use Magento\Quote\Setup\QuoteSetupFactory;
use Magento\Sales\Setup\SalesSetup;
use Magento\Sales\Setup\SalesSetupFactory;

/**
 * Class InstallData
 * @package Eadesigndev\Checkoutaddressfields\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @var SalesSetupFactory
     */
    private $salesSetupFactory;

    /**
     * @var QuoteSetupFactory
     */
    private $quoteSetupFactory;

    /**
     * InstallData constructor.
     * @param CustomerSetupFactory $customerSetupFactory
     * @param SalesSetupFactory $salesSetupFactory
     * @param QuoteSetupFactory $quoteSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        SalesSetupFactory $salesSetupFactory,
        QuoteSetupFactory $quoteSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->salesSetupFactory = $salesSetupFactory;
        $this->quoteSetupFactory = $quoteSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute('customer_address', 'with_company', [
            'label' => 'With or without',
            'input' => 'text',
            'type' => 'varchar',
            'source' => '',
            'required' => false,
            'position' => 0,
            'visible' => true,
            'system' => false,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_filterable_in_grid' => true,
            'is_searchable_in_grid' => true,
            'backend' => ''
        ]);

        $customerSetup->addAttribute('customer_address', 'registry_commerce', [
            'label' => 'Registry of Commerce',
            'input' => 'text',
            'type' => 'varchar',
            'source' => '',
            'required' => false,
            'position' => 1,
            'visible' => true,
            'system' => false,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_filterable_in_grid' => true,
            'is_searchable_in_grid' => true,
            'backend' => ''
        ]);

        $customerSetup->addAttribute('customer_address', 'bank_name', [
            'label' => 'Bank Name',
            'input' => 'text',
            'type' => 'varchar',
            'source' => '',
            'required' => false,
            'position' => 2,
            'visible' => true,
            'system' => false,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_filterable_in_grid' => true,
            'is_searchable_in_grid' => true,
            'backend' => ''
        ]);

        $customerSetup->addAttribute('customer_address', 'bank_account', [
            'label' => 'Bank account',
            'input' => 'text',
            'type' => 'varchar',
            'source' => '',
            'required' => false,
            'position' => 3,
            'visible' => true,
            'system' => false,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_filterable_in_grid' => true,
            'is_searchable_in_grid' => true,
            'backend' => ''
        ]);

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', 'with_company')
            ->addData(['used_in_forms' => [
                'adminhtml_customer_address',
                'customer_address_edit',
                'customer_register_address'
            ]]);

        $attribute->save();

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', 'registry_commerce')
            ->addData(['used_in_forms' => [
                'adminhtml_customer_address',
                'customer_address_edit',
                'customer_register_address'
            ]]);

        $attribute->save();

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', 'bank_name')
            ->addData(['used_in_forms' => [
                'adminhtml_customer_address',
                'customer_address_edit',
                'customer_register_address'
            ]]);

        $attribute->save();

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', 'bank_account')
            ->addData(['used_in_forms' => [
                'adminhtml_customer_address',
                'customer_address_edit',
                'customer_register_address'
            ]]);

        $attribute->save();

        $installer = $setup;

        $installer->getConnection()->addColumn(
            $installer->getTable('quote_address'),
            'with_company',
            [
                'comment' => 'Company or person',
                'type' => Table::TYPE_TEXT,
                'length' => 255
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('quote_address'),
            'registry_commerce',
            [
                'comment' => 'Registry of commerce number',
                'type' =>  Table::TYPE_TEXT,
                'length' => 255
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable('quote_address'),
            'bank_name',
            [
                'comment' => 'Bank Name',
                'type' =>  Table::TYPE_TEXT,
                'length' => 255
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable('quote_address'),
            'bank_account',
            [
                'comment' => 'Bank account',
                'type' =>  Table::TYPE_TEXT,
                'length' => 255
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_address'),
            'with_company',
            [
                'comment' => 'Company or person',
                'type' =>  Table::TYPE_TEXT,
                'length' => 255
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_address'),
            'registry_commerce',
            [
                'comment' => 'Registry of commerce number',
                'type' =>  Table::TYPE_TEXT,
                'length' => 255
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_address'),
            'bank_name',
            [
                'comment' => 'Company or person',
                'type' =>  Table::TYPE_TEXT,
                'length' => 255
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_address'),
            'bank_account',
            [
                'comment' => 'Bank account',
                'type' =>  Table::TYPE_TEXT,
                'length' => 255
            ]
        );

        /** @var QuoteSetup $quoteInstaller */
        $quoteInstaller = $this->quoteSetupFactory->create(
            ['resourceName' => 'quote_setup', 'setup' => $setup]
        );

        /** @var SalesSetup $salesInstaller */
        $salesInstaller = $this->salesSetupFactory->create(
            ['resourceName' => 'sales_setup', 'setup' => $setup]
        );

        $quoteInstaller->addAttribute(
            'quote',
            'order_comment',
            ['type' => Table::TYPE_TEXT, 'length' => '64k', 'nullable' => true]
        );
        $quoteInstaller->addAttribute(
            'quote',
            'delivery_date',
            ['type' => Table::TYPE_DATETIME, 'length' => null, 'nullable' => true]
        );

        $salesInstaller->addAttribute(
            'order',
            'order_comment',
            ['type' => Table::TYPE_TEXT, 'length' => '64k', 'nullable' => true, 'grid' => true]
        );
        $salesInstaller->addAttribute(
            'order',
            'delivery_date',
            ['type' => Table::TYPE_DATETIME, 'length' => null, 'nullable' => true, 'grid' => true]
        );
    }
}
