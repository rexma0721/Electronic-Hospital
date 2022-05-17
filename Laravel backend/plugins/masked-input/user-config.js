$(function() {
    $.mask.definitions['~'] = "[+-]";
    $("#masked-date1").mask("99/99/9999",{placeholder:"mm/dd/yyyy",completed:function(){alert("completed!");}});
    $(".phone").mask("(999) 999-9999");
    $("#masked-phoneExt").mask("(999) 999-9999? x99999");
    $("#masked-iphone").mask("+33 999 999 999");
    $("#masked-tin").mask("99-9999999");
    $("#masked-ssn").mask("999-99-9999");
    $("#masked-product").mask("a*-999-a999", { placeholder: " " });
    $("#masked-eyescript").mask("~9.99 ~9.99 999");
    $("#masked-po").mask("PO: aaa-999-***");
    $("#masked-pct").mask("99%");
    $("#masked-phoneAutoclearFalse").mask("(999) 999-9999", { autoclear: false, completed:function(){alert("completed autoclear!");} });
    $("#masked-phoneExtAutoclearFalse").mask("(999) 999-9999? x99999", { autoclear: false });
    $("#masked-datepicker").mask("99/99/9999");
    
    $("input").blur(function() {
        $("#info").html("Unmasked value: " + $(this).mask());
    }).dblclick(function() {
        $(this).unmask();
    });
});