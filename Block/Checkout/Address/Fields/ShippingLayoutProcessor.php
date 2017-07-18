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
    const WITH_COMPANY = 'with_company';
    const REGISTRY_COMMERCE = 'registry_commerce';
    const BANK_NAME = 'bank_name';
    const BANK_ACCOUNT = 'bank_account';
    const DELIVERY_DATE = 'delivery_date';

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
        $result = $this->filedWithRegistryCommerce($result, 'registry_commerce');
        $result = $this->filedWithBank($result, 'bank_name');
        $result = $this->filedWithBankAccount($result, 'bank_account');
        $result = $this->fieldRegionId($result, 'region_id');

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
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/company-select',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/checkbox-set',
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
                    'value' => 0,
                    'label' => 'Person',
                ],
                [
                    'value' => 1,
                    'label' => 'Business',
                ]
            ],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'value' => 0,
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
     * Registry of commerce
     * @param $result
     * @param $fieldName
     * @return mixed
     */
    public function filedWithRegistryCommerce($result, $fieldName)
    {

        $withCompany = [
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/initial-hidden-input',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/initial-hidden-input'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.' . $fieldName,
            'label' => __('Registry of commerce'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 5,
            'validation' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'class' => 'company-related',
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
        ['replacement_' . $fieldName] = $withCompany;

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
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/initial-hidden-input',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/initial-hidden-input'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.' . $fieldName,
            'label' => __('Bank'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 5,
            'validation' => [],
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
        ['replacement_' . $fieldName] = $withCompany;

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
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/initial-hidden-input',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/initial-hidden-input'
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
        ['replacement_' . $fieldName] = $withCompany;

        return $result;
    }

    /**
     * Adding delivery date to the checkout
     * @param $result
     * @param $fieldName
     * @return mixed
     */
    public function fieldRegionId($result, $fieldName)
    {
        $deliveryDate = [
            'component' => 'Magento_Ui/js/form/element/region',
            'config' => [
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/region_id',
                'template' => 'ui/form/field',
                'customEntry' => 'shippingAddress.region',
            ],
            'filterBy'=>[
                'target'=> '${ $.provider }:${ $.parentScope }.country_id',
                'field' => 'country_id'
            ],
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
