var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-billing-address': {
                'Eadesigndev_Checkoutaddressfields/js/action/set-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/set-shipping-information': {
                'Eadesigndev_Checkoutaddressfields/js/action/set-shipping-information-mixin': true
            },
            'Magento_Checkout/js/action/create-shipping-address': {
                'Eadesigndev_Checkoutaddressfields/js/action/create-shipping-address-mixin': true
            },
            'Magento_Checkout/js/action/place-order': {
                'Eadesigndev_Checkoutaddressfields/js/action/set-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/create-billing-address': {
                'Eadesigndev_Checkoutaddressfields/js/action/set-billing-address-mixin': true
            }
        }
    }
};