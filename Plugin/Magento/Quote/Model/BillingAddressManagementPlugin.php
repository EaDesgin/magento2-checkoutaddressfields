<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Plugin\Magento\Quote\Model;

use Magento\Framework\Exception\CouldNotSaveException;


/**
 * Class BillingAddressManagement
 * @package Eadesigndev\Checkoutaddressfields\Plugin\Magento\Quote\Model
 */
class BillingAddressManagementPlugin
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
                $address->setWithCompany($withCompany);
                $registryCommerce = $extAttributes->getRegistryCommerce();
                $address->setRegistryCommerce($registryCommerce);
                $bankName = $extAttributes->getBankName();
                $address->setBankName($bankName);
                $bankAccount = $extAttributes->getBankAccount();
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
