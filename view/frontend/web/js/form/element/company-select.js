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

        /**
         * Add the checked on load on the person.
         * This is not the best solution but will do for now.
         * @param target
         * @returns {exports}
         */
        afterLoadProcessor: function (target) {
            var $target = $(target), person;

            if ($target.parent().prev().find('input').length) {
                person = $target.parent().prev().find('input');
                if (person.is(':checked')) {
                    return this;
                }
                if ($target.is(':checked')) {
                    return this;
                }
                person.trigger('click');
            }
        },

        /**
         * Hide the company inputs if the user/load has as checked the
         * person input on company select.
         * @param radios
         * @returns {exports}
         */
        changeProcessor: function (radios) {

            var inputs = $("input[name^='custom_attributes'], input[name='vat_id'], input[name='company']"),
                parents = inputs.parents('div.field');

            if (radios.value === 1) {
                parents.show();
                inputs.prop('disabled', false);
                return this;
            }

            parents.hide();
            inputs.prop('disabled', true);
            return this;
        }
    });
});
