(function(){
	var creditInput = document.getElementById('credit-input');
      if (creditInput) {
        new Formatter(creditInput, {
            'pattern': '{{9999}}-{{9999}}-{{9999}}-{{9999}}'
        });
      }
      var phoneInput = document.getElementById('phone-input');
      if (phoneInput) {
        new Formatter(phoneInput, {
            'pattern': '({{999}}) {{999}}.{{9999}}',
            'persistent': true
        });
      }

      var formatDate = document.getElementById('format-date');
      if (formatDate) {
        new Formatter(formatDate, {
            'pattern': '{{99}}/{{99}}/{{9999}}'
        });
      }

      var formatPhoneExt = document.getElementById('format-phone-ext');
      if (formatPhoneExt) {
        new Formatter(formatPhoneExt, {
            'pattern': '({{999}}) {{999}} - {{9999}} / {{a999}}'
        });
      }

      var formatCurrency = document.getElementById('format-currency');
      if (formatCurrency) {
        new Formatter(formatCurrency, {
            'pattern': '${{999}}.{{99}}'
        });
      }

      var formatInternationalPhone = document.getElementById('format-international-phone');
      if (formatInternationalPhone) {
        new Formatter(formatInternationalPhone, {
            'pattern': '+3{{9}} {{999}} {{999}} {{999}}'
        });
      }

      var formatTaxId = document.getElementById('format-tax-id');
      if (formatTaxId) {
        new Formatter(formatTaxId, {
            'pattern': '{{99}} - {{9999999}}'
        });
      }

      var formatSsn = document.getElementById('format-ssn');
      if (formatSsn) {
        new Formatter(formatSsn, {
            'pattern': '{{999}} - {{99}} - {{9999}}'
        });
      }

      var formatProductKey = document.getElementById('format-product-key');
      if (formatProductKey) {
        new Formatter(formatProductKey, {
            'pattern': '{{a*}} - {{999}} - {{a999}}'
        });
      }

      var formatOrderNumber = document.getElementById('format-order-number');
      if (formatOrderNumber) {
        new Formatter(formatOrderNumber, {
            'pattern': '{{aaa}} - {{999}} - {{***}}'
        });
      }

      var formatIsbn = document.getElementById('format-isbn');
      if (formatIsbn) {
        new Formatter(formatIsbn, {
            'pattern': '{{999}} - {{99}} - {{999}} - {{9999}} - {{9}}'
        });
      }

      var formatPersistent = document.getElementById('format-persistent');
      if (formatPersistent) {
        new Formatter(formatPersistent, {
            'pattern': '+3 ({{999}}) {{999}} - {{99}} - {{99}}'
        });
      }
})();
