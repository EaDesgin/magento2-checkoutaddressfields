<!--
Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
See LICENSE for license details.
-->
define(
    [
        'jquery',
        "underscore",
        'ko',
        'uiComponent',
        'mage/calendar'
    ],
    function ($, _, ko, Component) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Eadesigndev_Checkoutaddressfields/checkout/delivery-date'
            },

            initialize: function () {
                this._super();
                ko.bindingHandlers.datepicker = {
                    init: function (element, valueAccessor, allBindingsAccessor) {
                        var $el = $(element);

                        var options = {minDate: 1};
                        $el.datepicker(options);

                        var writable = valueAccessor();
                        if (!ko.isObservable(writable)) {
                            var propWriters = allBindingsAccessor()._ko_property_writers;
                            if (propWriters && propWriters.datepicker) {
                                writable = propWriters.datepicker;
                            } else {
                                return;
                            }
                        }
                        writable($(element).datepicker("getDate"));

                    },
                    update: function (element, valueAccessor) {
                        var widget = $(element).data("DateTimePicker");
                        if (widget) {
                            var date = ko.utils.unwrapObservable(valueAccessor());
                            widget.date(date);
                        }
                    }
                };
                return this;
            }
        });
    }
);
