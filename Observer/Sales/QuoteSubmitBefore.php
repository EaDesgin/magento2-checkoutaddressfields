<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Observer\Sales;

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
            $order->getBillingAddress()->setWithCompany($quote->getBillingAddress()->getWithCompany())->save();
            $order->getBillingAddress()->setBankName($quote->getBillingAddress()->getBankName())->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        try {
            $order->getShippingAddress()->setWithCompany($quote->getShippingAddress()->getWithCompany())->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
