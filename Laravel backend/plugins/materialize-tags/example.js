var citynames = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
        url: 'https://raw.githubusercontent.com/henrychavez/materialize-tags/master/examples/assets/data/citynames.json',
        filter: function(list) {
            return $.map(list, function(cityname) {
                return { name: cityname };
            });
        }
    }
});

citynames.initialize();

$('input.typeaheader').materialtags({
    typeaheadjs: {
        name: 'citynames',
        displayKey: 'name',
        valueKey: 'name',
        source: citynames.ttAdapter()
    }
});
$('input.tagchars').materialtags({
    maxChars: 8
});

$('input.maxTags').materialtags({
    maxTags: 3
});
