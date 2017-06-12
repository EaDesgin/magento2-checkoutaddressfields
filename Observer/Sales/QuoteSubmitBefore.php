<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Observer\Sales;

use Eadesigndev\Checkoutaddressfields\Block\Checkout\Address\Fields\ShippingLayoutProcessor;
use Eadesigndev\Checkoutaddressfields\Model\Data\OrderFields;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\QuoteRepository;
use Magento\Sales\Model\Order;
use Psr\Log\LoggerInterface;

class QuoteSubmitBefore implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    /**
     * QuoteSubmitBefore constructor.
     * @param QuoteRepository $quoteRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        QuoteRepository $quoteRepository,
        LoggerInterface $logger
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->logger = $logger;
    }

    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(
        Observer $observer
    ) {

        /** @var Order $order */
        $order = $observer->getOrder();

        $quote = $this->quoteRepository->get($order->getQuoteId());

        try {
            $this->orderBillingAddressFields($order, $quote);

            $this->orderShippingAddressFields($order, $quote);

            $order->setData(
                ShippingLayoutProcessor::DELIVERY_DATE,
                $quote->getShippingAddress()->getData(ShippingLayoutProcessor::DELIVERY_DATE)
            );
            $order->setData(
                OrderFields::COMMENT_FIELD_NAME,
                $quote->getData(OrderFields::COMMENT_FIELD_NAME)
            );
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }

    /**
     * @param $order
     * @param $quote
     * @return $this
     */
    private function orderBillingAddressFields($order, $quote)
    {
        $order->getBillingAddress()->setData(
            ShippingLayoutProcessor::WITH_COMPANY,
            $quote->getBillingAddress()->getData(ShippingLayoutProcessor::WITH_COMPANY)
        );

        $order->getBillingAddress()->setData(
            ShippingLayoutProcessor::REGISTRY_COMMERCE,
            $quote->getBillingAddress()->getData(ShippingLayoutProcessor::REGISTRY_COMMERCE)
        );

        $order->getBillingAddress()->setData(
            ShippingLayoutProcessor::BANK_NAME,
            $quote->getBillingAddress()->getData(ShippingLayoutProcessor::BANK_NAME)
        );

        $order->getBillingAddress()->setData(
            ShippingLayoutProcessor::BANK_ACCOUNT,
            $quote->getBillingAddress()->getData(ShippingLayoutProcessor::BANK_ACCOUNT)
        )->save();

        return $this;
    }

    /**
     * @param $order
     * @param $quote
     * @return $this
     */
    private function orderShippingAddressFields($order, $quote)
    {
        $order->getShippingAddress()->setData(
            ShippingLayoutProcessor::WITH_COMPANY,
            $quote->getShippingAddress()->getData(ShippingLayoutProcessor::WITH_COMPANY)
        );

        $order->getShippingAddress()->setData(
            ShippingLayoutProcessor::REGISTRY_COMMERCE,
            $quote->getShippingAddress()->getData(ShippingLayoutProcessor::REGISTRY_COMMERCE)
        );

        $order->getShippingAddress()->setData(
            ShippingLayoutProcessor::BANK_NAME,
            $quote->getShippingAddress()->getData(ShippingLayoutProcessor::BANK_NAME)
        );

        $order->getShippingAddress()->setData(
            ShippingLayoutProcessor::BANK_ACCOUNT,
            $quote->getShippingAddress()->getData(ShippingLayoutProcessor::BANK_ACCOUNT)
        )->save();

        return $this;
    }
}
