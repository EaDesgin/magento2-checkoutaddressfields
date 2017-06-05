<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Plugin\Magento\Quote\Model;

//use Magento\Checkout\Api\Data\ShippingInformationInterface;
//use Magento\Checkout\Model\ShippingInformationManagement;
//use Magento\Quote\Model\QuoteRepository;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Model\ShippingAddressManagement;

/**
 * Class ShippingAddressManagementPlugin
 * @package Eadesigndev\Checkoutaddressfields\Plugin\Magento\Quote\Model
 */
class ShippingAddressManagementPlugin
{

    /**
     * @param ShippingAddressManagement $subject
     * @param $cartId
     * @param AddressInterface $address
     */
    public function beforeAssign(
        ShippingAddressManagement $subject,
        $cartId,
        AddressInterface $address
    ) {
        $extAttributes = $address->getExtensionAttributes();
        $field = $extAttributes->getWithCompany();
        $address->setWithCompany($field);
    }

//    /**
//     * @var QuoteRepository
//     */
//    private $quoteRepository;
//
//    /**
//     * ShippingAddressManagementPlugin constructor.
//     * @param QuoteRepository $quoteRepository
//     */
//    public function __construct(
//        QuoteRepository $quoteRepository
//    ) {
//        $this->quoteRepository = $quoteRepository;
//    }
//
//    /**
//     * @param ShippingInformationManagement $subject
//     * @param $cartId
//     * @param ShippingInformationInterface $addressInformation
//     */
//    public function beforeSaveAddressInformation(
//        ShippingInformationManagement $subject,
//        $cartId,
//        ShippingInformationInterface $addressInformation
//    ) {
//        $extAttributes = $addressInformation->getExtensionAttributes();
//        $deliveryDate = $extAttributes->getData('with_company');
//        $quote = $this->quoteRepository->getActive($cartId);
//        $quote->setData('with_company', $deliveryDate);
//    }
}
