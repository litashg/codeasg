jQuery(function() {
    tinymce.init({
        selector: '.tinymce-inline',
        inline: true,
        toolbar: 'bold italic superscript',
        menubar: false,
        plugins : "paste",
        forced_root_block: '',
        force_br_newlines: true,
        force_p_newlines: false,
        paste_auto_cleanup_on_paste : true,
        paste_remove_styles: true,
        paste_remove_styles_if_webkit: true,
        paste_strip_class_attributes: true,
        paste_preprocess : function(pl, o) {
            //example: keep bold,italic,underline and paragraphs
            //o.content = strip_tags( o.content,'<b><u><i><p>' );

            // remove all tags => plain text
            o.content = strip_tags( o.content,'' );
        },
    });

    function strip_tags(str, allowed_tags) {

        var key = '', allowed = false;
        var matches = [];
        var allowed_array = [];
        var allowed_tag = '';
        var i = 0;
        var k = '';
        var html = '';
        var replacer = function (search, replace, str) {
            return str.split(search).join(replace);
        };
        // Build allowes tags associative array
        if (allowed_tags) {
            allowed_array = allowed_tags.match(/([a-zA-Z0-9]+)/gi);
        }
        str += '';

        // Match tags
        matches = str.match(/(<\/?[\S][^>]*>)/gi);
        // Go through all HTML tags
        for (key in matches) {
            if (isNaN(key)) {
                // IE7 Hack
                continue;
            }

            // Save HTML tag
            html = matches[key].toString();
            // Is tag not in allowed list? Remove from str!
            allowed = false;

            // Go through all allowed tags
            for (k in allowed_array) {            // Init
                allowed_tag = allowed_array[k];
                i = -1;

                if (i != 0) {
                    i = html.toLowerCase().indexOf('<' + allowed_tag + '>');
                }
                if (i != 0) {
                    i = html.toLowerCase().indexOf('<' + allowed_tag + ' ');
                }
                if (i != 0) {
                    i = html.toLowerCase().indexOf('</' + allowed_tag);
                }

                // Determine
                if (i == 0) {
                    allowed = true;
                    break;
                }
            }
            if (!allowed) {
                str = replacer(html, "", str); // Custom replace. No regexing
            }
        }
        return str;
    }
});