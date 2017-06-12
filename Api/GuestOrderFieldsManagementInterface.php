<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Api;

use Eadesigndev\Checkoutaddressfields\Api\Data\OrderFieldsInterface;

/**
 * Interface for saving the checkout comment to the quote for guest orders
 */
interface GuestOrderFieldsManagementInterface
{
    /**
     * @param string $cartId
     * @param OrderFieldsInterface $orderComment
     * @return mixed
     */
    public function saveOrderComment(
        $cartId,
        OrderFieldsInterface $orderComment
    );
}
