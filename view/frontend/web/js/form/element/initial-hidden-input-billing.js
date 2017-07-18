/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
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
         * See what fields we need to show, if is person we do not show the company.
         */
        afterLoadProcessor: function () {

            var selectedCompany = $(".select-company-billing input[type='radio']:checked").val();

            if (selectedCompany === '0') {
                this.hide()
            }
        }
    });
});
