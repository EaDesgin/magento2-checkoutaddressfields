<?php

/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

/**
 * Class BillingLayoutProcessor
 * @package Eadesigndev\Checkoutaddressfields\Plugin\Checkout
 */
class BillingLayoutProcessor
{
    /**
     * @param LayoutProcessor $subject
     * @param array $result
     * @return array|mixed
     */
    public function afterProcess(
        LayoutProcessor $subject,
        array $result
    )
    {

        $paymentForms = $result['components']['checkout']['children']['steps']['children']
        ['billing-step']['children']['payment']['children']
        ['payments-list']['children'];

        $paymentMethodForms = array_keys($paymentForms);

        if (!isset($paymentMethodForms)) {
            return $result;
        }

        foreach ($paymentMethodForms as $paymentMethodForm) {
            $paymentMethodCode = str_replace('-form', '', $paymentMethodForm, $paymentMethodCode);
            $result = $this->filedWithCompany($result, 'with_company', $paymentMethodForm, $paymentMethodCode);
            $result = $this->filedWithRegistryCommerce(
                $result,
                'registry_commerce',
                $paymentMethodForm,
                $paymentMethodCode
            );
            $result = $this->filedWithBank($result, 'bank_name', $paymentMethodForm, $paymentMethodCode);
            $result = $this->filedWithBankAccount($result, 'bank_account', $paymentMethodForm, $paymentMethodCode);
            $result = $this->filedCompany($result, 'company', $paymentMethodForm, $paymentMethodCode);
            $result = $this->filedVat($result, 'vat_id', $paymentMethodForm, $paymentMethodCode);
        }

        return $result;
    }

    /**
     * Select company or person
     * @param $result
     * @param $fieldName
     * @param $paymentMethodForm
     * @param $paymentMethodCode
     * @return array
     */
    public function filedWithCompany($result, $fieldName, $paymentMethodForm, $paymentMethodCode)
    {

        $field = [
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/company-select',
            'config' => [
                'customScope' => 'billingAddress' . $paymentMethodCode . '.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/checkbox-set-billing',
                'tooltip' => [
                    'description' => 'Company',
                ],
            ],
            'dataScope' => 'billingAddress' . $paymentMethodCode . '.custom_attributes.' . $fieldName,
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
        ['billing-step']
        ['children']
        ['payment']
        ['children']
        ['payments-list']
        ['children']
        [$paymentMethodForm]
        ['children']
        ['form-fields']
        ['children']
        [$fieldName] = $field;

        return $result;
    }

    /**
     * Registry of commerce
     * @param $result
     * @param $fieldName
     * @param $paymentMethodForm
     * @param $paymentMethodCode
     * @return array
     */
    public function filedWithRegistryCommerce($result, $fieldName, $paymentMethodForm, $paymentMethodCode)
    {

        $field = [
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/initial-hidden-input-billing',
            'config' => [
                'customScope' => 'billingAddress' . $paymentMethodCode . '.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/initial-hidden-input'
            ],
            'dataScope' => 'billingAddress' . $paymentMethodCode . '.custom_attributes.' . $fieldName,
            'label' => __('Registry of commerce'),
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
        ['billing-step']
        ['children']
        ['payment']
        ['children']
        ['payments-list']
        ['children']
        [$paymentMethodForm]
        ['children']
        ['form-fields']
        ['children']
        [$fieldName] = $field;

        return $result;
    }

    /**
     * Select company or person
     * @param $result
     * @param $fieldName
     * @param $paymentMethodForm
     * @param $paymentMethodCode
     * @return array
     */
    public function filedWithBank($result, $fieldName, $paymentMethodForm, $paymentMethodCode)
    {

        $field = [
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/initial-hidden-input-billing',
            'config' => [
                'customScope' => 'billingAddress' . $paymentMethodCode . '.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/initial-hidden-input'
            ],
            'dataScope' => 'billingAddress' . $paymentMethodCode . '.custom_attributes.' . $fieldName,
            'label' => __('Bank'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 4,
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
        ['billing-step']
        ['children']
        ['payment']
        ['children']
        ['payments-list']
        ['children']
        [$paymentMethodForm]
        ['children']
        ['form-fields']
        ['children']
        [$fieldName] = $field;

        return $result;
    }

    /**
     * Select company or person
     * @param $result
     * @param $fieldName
     * @param $paymentMethodForm
     * @param $paymentMethodCode
     * @return array
     */
    public function filedWithBankAccount($result, $fieldName, $paymentMethodForm, $paymentMethodCode)
    {

        $field = [
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/initial-hidden-input-billing',
            'config' => [
                'customScope' => 'billingAddress' . $paymentMethodCode . '.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/initial-hidden-input'
            ],
            'dataScope' => 'billingAddress' . $paymentMethodCode . '.custom_attributes.' . $fieldName,
            'label' => __('Bank Account'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 3,
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
        ['billing-step']
        ['children']
        ['payment']
        ['children']
        ['payments-list']
        ['children']
        [$paymentMethodForm]
        ['children']
        ['form-fields']
        ['children']
        [$fieldName] = $field;

        return $result;
    }

    /**
     * Select company or person
     * @param $result
     * @param $fieldName
     * @param $paymentMethodForm
     * @param $paymentMethodCode
     * @return array
     */
    public function filedCompany($result, $fieldName, $paymentMethodForm, $paymentMethodCode)
    {

        $field = [
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/initial-hidden-input-billing',
            'config' => [
                'customScope' => 'billingAddress' . $paymentMethodCode,
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/initial-hidden-input',
                'tooltip' => null,
            ],
            'dataScope' => 'billingAddress' . $paymentMethodCode . $fieldName,
            'dataScopePrefix' => 'billingAddress' . $paymentMethodCode,
            'label' => __('Company'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 1,
            'validation' => [],
            'options' => [],
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
        ['billing-step']
        ['children']
        ['payment']
        ['children']
        ['payments-list']
        ['children']
        [$paymentMethodForm]
        ['children']
        ['form-fields']
        ['children']
        [$fieldName] = $field;

        return $result;
    }

    /**
     * Select company or person
     * @param $result
     * @param $fieldName
     * @param $paymentMethodForm
     * @param $paymentMethodCode
     * @return array
     */
    public function filedVat($result, $fieldName, $paymentMethodForm, $paymentMethodCode)
    {

        $field = [
            'component' => 'Eadesigndev_Checkoutaddressfields/js/form/element/initial-hidden-input-billing',
            'config' => [
                'customScope' => 'billingAddress' . $paymentMethodCode,
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Eadesigndev_Checkoutaddressfields/form/element/initial-hidden-input',
                'tooltip' => null,
            ],
            'dataScope' => 'billingAddress' . $paymentMethodCode . $fieldName,
            'dataScopePrefix' => 'billingAddress' . $paymentMethodCode,
            'label' => __('VAT number'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 1,
            'validation' => [],
            'options' => [],
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
        ['billing-step']
        ['children']
        ['payment']
        ['children']
        ['payments-list']
        ['children']
        [$paymentMethodForm]
        ['children']
        ['form-fields']
        ['children']
        [$fieldName] = $field;

        return $result;
    }
}
