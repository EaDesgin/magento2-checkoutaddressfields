<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Plugin\Magento\Quote\Model;

use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Class ShippingAddressManagementPlugin
 * @package Eadesigndev\Checkoutaddressfields\Plugin\Magento\Quote\Model
 */
class ShippingAddressManagementPlugin
{

    /**
     * @param $subject
     * @param $cartId
     * @param $address
     * @throws CouldNotSaveException
     */
    public function beforeAssign(
        $subject,
        $cartId,
        $address
    ) {
        $extAttributes = $address->getExtensionAttributes();
        if ($extAttributes) {
            try {
                $withCompany = $extAttributes->getWithCompany();

                $registryCommerce = '';
                $bankName = '';
                $bankAccount = '';
                if ($withCompany) {
                    $registryCommerce = $extAttributes->getRegistryCommerce();
                    $bankName = $extAttributes->getBankName();
                    $bankAccount = $extAttributes->getBankAccount();
                }

                $address->setWithCompany($withCompany);
                $address->setRegistryCommerce($registryCommerce);
                $address->setBankName($bankName);
                $address->setBankAccount($bankAccount);
            } catch (\Exception $e) {
                throw new CouldNotSaveException(
                    __('One custom field could not be added to the address.'),
                    $e
                );
            }
        }
    }
}
