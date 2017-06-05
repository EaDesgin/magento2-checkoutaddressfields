<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

/**
 * Class InstallData
 * @package Eadesigndev\Checkoutaddressfields\Setup
 */
class InstallData implements InstallDataInterface
{

    private $customerSetupFactory;

    /**
     * Constructor
     *
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
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
            'label' => 'with_company',
            'input' => 'text',
            'type' => 'varchar',
            'source' => '',
            'required' => true,
            'position' => 333,
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

        $installer = $setup;

        $installer->getConnection()->addColumn(
            $installer->getTable('quote_address'),
            'with_company',
            [
                'comment' => 'Company or person',
                'type' => 'text',
                'length' => 255
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_address'),
            'with_company',
            [
                'comment' => 'Company or person',
                'type' => 'text',
                'length' => 255
            ]
        );
    }
}
