define([
    'jquery',
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/shipping-service',
    'InStore_PickUp/js/view/checkout/shipping/office-service',
    'mage/translate',
], function ($, ko, Component, quote, shippingService, officeService, t) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'InStore_PickUp/checkout/shipping/instore-pickup-form-template'
        },

        initialize: function (config) {
            this.offices = ko.observableArray();
            this.selectedOffice = ko.observable();
            this._super();
        },

        initObservable: function () {
            this._super();
            /*this.showOfficeSelection = ko.computed(function() {
                return this.ofices().length != 0
            }, this);*/
            this.showOfficeSelection = ko.computed(function() {
                return true
            }, this);

            this.selectedMethod = ko.computed(function() {
                var method = quote.shippingMethod();
                var selectedMethod = method != null ? method.carrier_code + '_' + method.method_code : null;
                return selectedMethod;
            }, this);

            quote.shippingMethod.subscribe(function(method) {
                var selectedMethod = method != null ? method.carrier_code + '_' + method.method_code : null;
                /*if (selectedMethod == 'pickup_shipping_method_pickup_shipping_method') {
                    this.reloadOffices();
                }*/
                this.reloadOffices();
            }, this);

            this.selectedOffice.subscribe(function(office) {
                if (quote.shippingAddress().extensionAttributes == undefined) {
                    quote.shippingAddress().extensionAttributes = {};
                }
                quote.shippingAddress().extensionAttributes.carrier_office = office;
            });


            return this;
        },

        setOfficeList: function(list) {
            this.offices(list);
        },

        reloadOffices: function() {
            officeService.getOfficeList(quote.shippingAddress(), this);
            var defaultOffice = this.offices()[0];
            if (defaultOffice) {
                this.selectedOffice(defaultOffice);
            }
        },

        getOffice: function() {
            var office;
            if (this.selectedOffice()) {
                for (var i in this.offices()) {
                    var m = this.offices()[i];
                    if (m.name == this.selectedOffice()) {
                        office = m;
                    }
                }
            }
            else {
                office = this.offices()[0];
            }

            return office;
        },

        initSelector: function() {
            var startOffice = this.getOffice();
        }
    });
});