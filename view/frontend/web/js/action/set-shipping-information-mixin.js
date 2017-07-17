define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote',
    'Eadesigndev_Checkoutaddressfields/js/model/checkout/shipping-date-value'
], function ($, wrapper, quote, shippingDateValue) {
    'use strict';

    return function (setShippingInformationAction) {
        return wrapper.wrap(setShippingInformationAction, function (originalAction, messageContainer) {

            var shippingAddress = quote.shippingAddress(),
                cityField = $('input[name="city"]');

            /**
             * Specific requirement for the current project
             */
            if (cityField !== undefined) {
                if (cityField.is(':disabled')) {
                    shippingAddress.city = 'Iasi';
                    shippingAddress.regionId = 302;
                    shippingAddress.regionCode = 'IS';
                    shippingAddress.region = 'Iasi';
                }
            }

            if (shippingAddress['extension_attributes'] === undefined) {
                shippingAddress['extension_attributes'] = {};
            }

            console.log(shippingAddress.customAttributes);

            if (shippingAddress.customAttributes !== undefined) {
                $.each(shippingAddress.customAttributes, function (key, value) {

                    if ($.isPlainObject(value)) {
                        value = value['value'];
                    }

                    shippingAddress['customAttributes'][key] = value;
                    shippingAddress['extension_attributes'][key] = value;

                    if (key === 'with_company' && value == '0') {
                        shippingAddress['customAttributes'][key] = '';
                        shippingAddress['extension_attributes'][key] = '';
                        shippingAddress['customAttributes']['with_company'] = 0;
                        shippingAddress['extension_attributes']['with_company'] = 0;
                    }

                });
            }

            shippingDateValue.orderDate();

            return originalAction(messageContainer);
        });
    };
});