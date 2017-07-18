define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper,quote) {
    'use strict';

    return function (setBillingAddressAction) {
        return wrapper.wrap(setBillingAddressAction, function (originalAction, messageContainer) {

            var billingAddress = quote.billingAddress(),
                withCompany = 1;

            if(billingAddress != undefined) {

                if (billingAddress['extension_attributes'] === undefined) {
                    billingAddress['extension_attributes'] = {};
                }

                withCompany = billingAddress.customAttributes.with_company;

                if (billingAddress.customAttributes != undefined) {
                    $.each(billingAddress.customAttributes, function (key, value) {

                        if($.isPlainObject(value)){
                            value = value['value'];
                        }

                        if (withCompany == '0') {
                            billingAddress['extension_attributes'][key] = '';
                            billingAddress['extension_attributes']['with_company'] = 0;
                        } else {
                            billingAddress['extension_attributes'][key] = value;
                        }
                    });
                }
            }

            return originalAction(messageContainer);
        });
    };
});