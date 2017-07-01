define(
    [
        'jquery',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/url',
        'Magento_Checkout/js/model/error-processor'
    ],
    function ($, customer, quote, urlBuilder, urlFormatter, errorProcessor) {
        'use strict';

        return {

            /**
             * Make an ajax PUT request to store the order comment in the quote.
             *
             * @returns {Boolean}
             */
            orderDate: function () {
                var isCustomer = customer.isLoggedIn();

                var quoteId = quote.getQuoteId();
                var url;

                if (isCustomer) {
                    url = urlBuilder.createUrl('/carts/mine/set-order-comment', {})
                } else {
                    url = urlBuilder.createUrl('/guest-carts/:cartId/set-order-comment', {cartId: quoteId});
                }

                var payload = {
                    cartId: quoteId,
                    orderComment: {
                        date: $('input[name="delivery_date"]').val(),
                    }
                };

                if (!payload.orderComment.date) {
                    return true;
                }

                var result = true;
                console.log(urlFormatter.build(url))


                $.ajax({
                    url: urlFormatter.build(url),
                    data: JSON.stringify(payload),
                    global: false,
                    contentType: 'application/json',
                    type: 'PUT',
                    async: false
                }).done(
                    function (response) {
                        result = true;
                    }
                ).fail(
                    function (response) {
                        result = false;
                        errorProcessor.process(response);
                    }
                );

                return result;
            }
        };
    }
);