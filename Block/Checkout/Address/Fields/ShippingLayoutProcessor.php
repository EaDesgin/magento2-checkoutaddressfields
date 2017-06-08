<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Block\Checkout\Address\Fields;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\DataObject\Copy\Config as CopyConfig;

/**
 * Class ShippingLayoutProcessor add the fields to checkout billing address
 * @package Eadesigndev\Checkoutaddressfields\Block\Checkout\Address\Fields
 */
class ShippingLayoutProcessor implements LayoutProcessorInterface
{
    /**
     * @var CopyConfig
     */
    private $copyConfig;

    /**
     * Fields constructor.
     * @param CopyConfig $copyConfig
     */
    public function __construct(CopyConfig $copyConfig)
    {
        $this->copyConfig = $copyConfig;
    }

    /**
     * Adding fields to the checkout
     * @param array $result
     * @return array
     */
    public function process($result)
    {

        $result = $this->filedWithCompany($result, 'with_company');
        $result = $this->filedWithBank($result, 'bank_name');
        $result = $this->filedWithBankAccount($result, 'bank_account');
        $result = $this->fieldDeliveryDate($result, 'delivery_date');

        return $result;
    }

    /**
     * Select company or person
     * @param $result
     * @param $fieldName
     * @return mixed
     */
    public function filedWithCompany($result, $fieldName)
    {

        $withCompany = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/checkbox-set',
                'tooltip' => [
                    'description' => 'Company',
                ],
            ],
            'dataScope' => 'shippingAddress.custom_attributes.' . $fieldName,
            'label' => null,
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'validation' => [
                'required-entry' => true
            ],
            'options' => [
                [
                    'value' => '0',
                    'label' => 'Person',
                ],
                [
                    'value' => '1',
                    'label' => 'Business',
                ]
            ],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'id' => $fieldName
        ];

        $result
        ['components']
        ['checkout']
        ['children']
        ['steps']
        ['children']
        ['shipping-step']
        ['children']
        ['shippingAddress']
        ['children']
        ['shipping-address-fieldset']
        ['children']
        ['replacement_with_company'] = $withCompany;

        return $result;
    }

    /**
     * Select company or person
     * @param $result
     * @param $fieldName
     * @return mixed
     */
    public function filedWithBank($result, $fieldName)
    {

        $withCompany = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.' . $fieldName,
            'label' => __('Bank'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 5,
            'validation' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
        ];

        $result
        ['components']
        ['checkout']
        ['children']
        ['steps']
        ['children']
        ['shipping-step']
        ['children']
        ['shippingAddress']
        ['children']
        ['shipping-address-fieldset']
        ['children']
        [$fieldName] = $withCompany;

        return $result;
    }

    /**
     * Select company or person
     * @param $result
     * @param $fieldName
     * @return mixed
     */
    public function filedWithBankAccount($result, $fieldName)
    {

        $withCompany = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.' . $fieldName,
            'label' => __('Bank Account'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 6,
            'validation' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'id'=>$fieldName
        ];

        $result
        ['components']
        ['checkout']
        ['children']
        ['steps']
        ['children']
        ['shipping-step']
        ['children']
        ['shippingAddress']
        ['children']
        ['shipping-address-fieldset']
        ['children']
        [$fieldName] = $withCompany;

        return $result;
    }

    /**
     * Adding delivery date to the checkout
     * @param $result
     * @param $fieldName
     * @return mixed
     */
    public function fieldDeliveryDate($result, $fieldName)
    {
        $deliveryDate = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/date',
                'options' => [],
                'id' => $fieldName
            ],
            'dataScope' => 'shippingAddress.custom_attributes.' . $fieldName,
            'label' => 'Delivery Date',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [
                'required-entry' => true
            ],
            'sortOrder' => 5,
            'id' => $fieldName
        ];

        $result
        ['components']
        ['checkout']
        ['children']
        ['steps']
        ['children']
        ['shipping-step']
        ['children']
        ['shippingAddress']
        ['children']
        ['shipping-address-fieldset']
        ['children']
        [$fieldName] = $deliveryDate;

        return $result;
    }
}
