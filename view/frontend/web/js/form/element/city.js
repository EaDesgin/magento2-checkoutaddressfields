/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/abstract'
], function ($, _, registry, Abstract) {
    'use strict';

    return Abstract.extend({

        defaults: {
            imports: {
                country: '${ $.parentName }.country_id:value'
            }
        },

        country: function () {
            var country = registry.get(this.parentName + '.' + 'country_id'),
                city = registry.get(this.parentName + '.' + 'city'),
                region = registry.get(this.parentName + '.' + 'region_id');

            if (country) {
                city.disable();
                country.disable();
                // region.disable();
            }
        }

    });
});
