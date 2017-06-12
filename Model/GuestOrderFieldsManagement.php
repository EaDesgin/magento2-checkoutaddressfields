<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Model;

use Eadesigndev\Checkoutaddressfields\Api\Data\OrderFieldsInterface;
use Eadesigndev\Checkoutaddressfields\Api\GuestOrderFieldsManagementInterface;
use Eadesigndev\Checkoutaddressfields\Api\OrderFieldsManagementInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;

class GuestOrderFieldsManagement implements GuestOrderFieldsManagementInterface
{

    /**
     * @var QuoteIdMaskFactory
     */
    private $quoteIdMaskFactory;

    /**
     * @var OrderFieldsManagementInterface
     */
    private $orderCommentManagement;

    /**
     * GuestOrderFieldsManagement constructor.
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param OrderFieldsManagementInterface $orderCommentManagement
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        OrderFieldsManagementInterface $orderCommentManagement
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->orderCommentManagement = $orderCommentManagement;
    }

    /**
     * @param $cartId
     * @param OrderFieldsInterface $orderComment
     * @return mixed
     */
    public function saveOrderComment(
        $cartId,
        OrderFieldsInterface $orderComment
    ) {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->orderCommentManagement->saveOrderComment($quoteIdMask->getQuoteId(), $orderComment);
    }
}
