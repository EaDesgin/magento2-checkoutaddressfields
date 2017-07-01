<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Model;

use Eadesigndev\Checkoutaddressfields\Api\Data\OrderFieldsInterface;
use Eadesigndev\Checkoutaddressfields\Api\OrderFieldsManagementInterface;
use Eadesigndev\Checkoutaddressfields\Model\Data\OrderFields;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\Quote;

class OrderFieldsManagement implements OrderFieldsManagementInterface
{
    /**
     * Quote repository.
     *
     * @var CartRepositoryInterface
     */
    private $quoteRepository;

    /**
     *
     * @param CartRepositoryInterface $quoteRepository Quote repository.
     */
    public function __construct(
        CartRepositoryInterface $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param $cartId
     * @param OrderFieldsInterface $orderComment
     * @return null|string
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveOrderComment(
        $cartId,
        OrderFieldsInterface $orderComment
    ) {
        /** @var Quote $quote */
        $quote = $this->quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }

        $comment = $orderComment->getComment();
        $date = $orderComment->getDate();

        try {
            $quote->setData(OrderFields::COMMENT_FIELD_NAME, strip_tags($comment));
            if ($date) {
                $quote->setData(OrderFields::DATE_FIELD_NAME, $date);
            }
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('The order comment could not be saved'));
        }

        return $comment;
    }
}
