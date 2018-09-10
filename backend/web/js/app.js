$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

    $('.nav.nav-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var tabId = $(e.target).attr('href').replace('#', '');

        window.history.replaceState({}, document.title, location.pathname + '?' + insertParam('tab', tabId));

        if($('.i18n-lang-buttons').length) {
            $.each($('.i18n-lang-buttons a'), function(k, el) {
                var url = $(el).attr('href');

                if(url.indexOf('http') === -1) {
                    url = location.origin + url;
                }
                url = new URL(url);
                url.searchParams.set('tab', tabId);
                $(el).attr('href', url.href);
            });
        }
    });

    function insertParam(key, value) {
        key = encodeURI(key);
        value = encodeURI(value);

        var kvp = document.location.search.substr(1).split('&');

        var i = kvp.length;
        var x;
        while (i--) {
            x = kvp[i].split('=');

            if (x[0] == key) {
                x[1] = value;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key, value].join('=');
        }

        return kvp.join('&');
    }
    $(document).on("click", "#contact_phone_add", function() {
        var n = $('.phone_element').last().data('el')+1;
        let label = $('.phone_element').last().find('label').text();
        var box_html = $('<div class="phone_element" data-el="'+n+'">\n'+
            '<div class="col-lg-11">\n'+
            '<div class="form-group field-contact-phone-'+n+' required">\n' +
            '<label class="control-label" for="contact-phone-'+n+'">'+label+'</label>\n' +
            '<input type="text" id="contact-phone-'+n+'" class="form-control" name="Contact[phone]['+n+']">\n' +
            '\n' +
            '<p class="help-block help-block-error"></p>\n' +
            '</div></div>\n' +
            '<div class="col-lg-1 btn btn-danger phone_remove_item">Remove</div>\n' +
            '</div>'
        );
        box_html.hide();
        $('.phone_element:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });

    $(document).on("click", "#contact_email_add", function() {
        var n = $('.email_element').last().data('el')+1;
        let label = $('.email_element').last().find('label').text();
        var box_html = $('<div class="email_element" data-el="'+n+'">\n'+
            '<div class="col-lg-11">\n'+
            '<div class="form-group field-contact-email-'+n+' required">\n' +
            '<label class="control-label" for="contact-email-'+n+'">'+label+'</label>\n' +
            '<input type="email" id="contact-email-'+n+'" class="form-control" name="Contact[email]['+n+']">\n' +
            '\n' +
            '<p class="help-block help-block-error"></p>\n' +
            '</div></div>\n' +
            '<div class="col-lg-1 btn btn-danger remove_item">Remove</div>\n' +
            '</div>'
        );
        box_html.hide();
        $('.email_element:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });

    $(document).on("click", ".remove_item", function() {
        if($('.email_element').length > 1){
            $(this).parent().fadeOut('slow', function() {
                $(this).remove();
            });
        }
        return false;
    });

    $(document).on("click", ".phone_remove_item", function() {
        if($('.phone_element').length > 1){
            $(this).parent().fadeOut('slow', function() {
                $(this).remove();
            });
        }
        return false;
    });

    $(document).on("click", "#seo_page_verification_add", function() {
        let n = $('.verification_elements').last().data('el') +1 ;
        let box_html = $('<div class="verification_elements" data-el="'+n+'">\n' +
            '                <div class="col-lg-5">\n' +
            '                    <div class="form-group field-page-name">\n' +
            '<label class="control-label" for="page-name">Name</label>\n' +
            '<input type="text" id="page-name" class="form-control" name="Seo[verification_tags]['+n+'][name]">\n' +
            '\n' +
            '<p class="help-block help-block-error"></p>\n' +
            '</div>                </div>\n' +
            '                <div class="col-lg-5">\n' +
            '                    <div class="form-group field-page-content">\n' +
            '<label class="control-label" for="page-content">Content</label>\n' +
            '<input type="text" id="page-content" class="form-control" name="Seo[verification_tags]['+n+'][content]">\n' +
            '\n' +
            '<p class="help-block help-block-error"></p>\n' +
            '</div></div><div class="col-lg-1 btn btn-danger remove_item">Remove</div>\n\n' +
            '</div></p>');
        box_html.hide();
        $('.verification_elements:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });

    $(document).on("click", "#seo_verification_add", function() {
        let n = $('.verification_elements').last().data('el') +1 ;
        let box_html = $('<div class="verification_elements" data-el="'+n+'">\n' +
            '                <div class="col-lg-5">\n' +
            '                    <div class="form-group field-page-name">\n' +
            '<label class="control-label" for="page-name">Name</label>\n' +
            '<input type="text" id="page-name" class="form-control" name="Page[verification_tags]['+n+'][name]">\n' +
            '\n' +
            '<p class="help-block help-block-error"></p>\n' +
            '</div>                </div>\n' +
            '                <div class="col-lg-5">\n' +
            '                    <div class="form-group field-page-content">\n' +
            '<label class="control-label" for="page-content">Content</label>\n' +
            '<input type="text" id="page-content" class="form-control" name="Page[verification_tags]['+n+'][content]">\n' +
            '\n' +
            '<p class="help-block help-block-error"></p>\n' +
            '</div></div><div class="col-lg-1 btn btn-danger remove_item">Remove</div>\n\n' +
            '</div></p>');
        box_html.hide();
        $('.verification_elements:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });

    $(document).on("click", ".remove_item", function() {
        if($('.verification_elements').length > 1){
            $(this).parent().fadeOut('slow', function() {
                $(this).remove();
            });
        }
        return false;
    });

    $(document).on("click", ".save", function(){
        $('.verification_elements').each(function () {
            let name = $(this).find("input[id*='-name']");
            let content = $(this).find("input[id*='-content']");
            if(!name.val() || !content.val()){
                $(this).remove();
            }
        });
    });

    $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
        if (! confirm("Are you sure you want to delete this item?")) {
            return false;
        }
        return true;
    });
    $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        $(item).find(".box-title").empty();
    });

    // $("#block-0-text").tagsinput('destroy');

    $('body').on('change', '#content-block-type', function(e) {
        if($(this).val() == 1) {
            $("#block-0-text").tagsinput('destroy');
        }
        if($(this).val() == 2) {
            $("#block-0-text").tagsinput();
        }
        console.log($(this).val());
    });

    jQuery('.multiple-input').on('afterInit', function(){
        console.log('calls on after initialization event');
    }).on('beforeAddRow', function(e) {
        console.log('calls on before add row event');
    }).on('afterAddRow', function(e, row) {
        console.log('calls on after add row event');
    }).on('beforeDeleteRow', function(e, row){
        // row - HTML container of the current row for removal.
        // For TableRenderer it is tr.multiple-input-list__item
        console.log('calls on before remove row event.');
        return confirm('Are you sure you want to delete row?')
    }).on('afterDeleteRow', function(e, row){
        console.log('calls on after remove row event');
        console.log(row);
    });

    $(function() {
        $('.content-item-form').on('change', '#item-type', function(e) {

            if($(this).val() == 1) {
                $('.field-item-description').show();
                $('.field-item-tags').hide();
            }
            if($(this).val() == 2) {
                $('.field-item-description').hide();
                $('.field-item-tags').show();
            }

            // console.log($(this).val());
        });
    });
});