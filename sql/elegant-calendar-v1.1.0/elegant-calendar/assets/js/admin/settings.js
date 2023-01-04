(function($){

    "use strict";

    var ElegantCalendarSettings = {

        shortcode : '',

        init: function()
        {
            // Document ready.
            $( document ).ready( ElegantCalendarSettings._loadPopup() );
            $( document ).ready( ElegantCalendarSettings._codeGenerator() );
            $( document ).ready( ElegantCalendarSettings._loadColorPicker() );



            this._bind();
        },

        /**
         * Binds events for the ElegantCalendarSettings.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '.elegant-vertical-tab a', ElegantCalendarSettings._switchTabs );
            $( document ).on('click', '.elegant-global-settings-button', ElegantCalendarSettings._saveSettings );
            $( document ).on('click', '.elegant-button-copy-icon', ElegantCalendarSettings._copyShortcode );

        },

        /**
         * Event Color Picker
         *
         */
        _loadColorPicker: function( ) {
            /* Call the Color Picker */
            $( ".color-picker" ).wpColorPicker();
        },

        /**
         * Copy Shortcode
         *
         */
        _copyShortcode: function( ) {

            /* Get the shortcode text field */
            var shortcode = document.getElementById("elegant-form-shortcode");

            /* Select the text field */
            shortcode.select();
            shortcode.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            ElegantCalendarSettings._displayNoticeMessage('Shortcode has been copied successfully!');

        },

        /**
         * Shortcode Generator
         *
         */
        _codeGenerator: function( ) {

            $('.dropdown-el').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                /* shortcode type expanded */
                $(this).toggleClass('expanded');

                /* set shortcode value */
                var shortcode_type = $('#'+$(e.target).attr('for'));
                shortcode_type.prop('checked',true);
                ElegantCalendarSettings.shortcode = $('input[name="shortcode_type"]:checked').val();
                $('#elegant-form-shortcode').val(ElegantCalendarSettings.shortcode);

                $('.shortcode-select').hide();
                $('.'+$(e.target).attr('for')).show();
                $('.'+$(e.target).attr('for')).addClass('current');
            });

            $('.elegant-layout-selector').change(function(){
                var current_shortcode = $('#elegant-form-shortcode').val();
                var output = '';
                if (current_shortcode.includes('view')) {
                    var start_position = current_shortcode.indexOf('view');
                    var end_position = current_shortcode.indexOf("'", start_position + 6);
                    var view_part = current_shortcode.substring(start_position, end_position + 1);
                    output = current_shortcode.replace(view_part, "view='" + $(this).val() + "'");
                } else {
                    var position = current_shortcode.lastIndexOf(']');
                    var output = [current_shortcode.slice(0, position), "view='" + $(this).val() + "'", current_shortcode.slice(position)].join(' ');
                }
                ElegantCalendarSettings.shortcode = output;
                $('#elegant-form-shortcode').val(ElegantCalendarSettings.shortcode);
            });

            $('.elegant-design-selector').change(function(){
                var current_shortcode = $('#elegant-form-shortcode').val();
                var output = '';
                if (current_shortcode.includes('design')) {
                    var start_position = current_shortcode.indexOf('design');
                    var end_position = current_shortcode.indexOf("'", start_position + 8);
                    var design_part = current_shortcode.substring(start_position, end_position + 1);
                    output = current_shortcode.replace(design_part, "design='" + $(this).val() + "'");
                } else {
                    var position = current_shortcode.lastIndexOf(']');
                    var output = [current_shortcode.slice(0, position), "design='" + $(this).val() + "'", current_shortcode.slice(position)].join(' ');
                }
                ElegantCalendarSettings.shortcode = output;
                $('#elegant-form-shortcode').val(ElegantCalendarSettings.shortcode);
            });

            $('#main_calendar_filter').click(function(e) {
                if ($(this).val() === 'yes') {
                    $(this).val('no');
                } else {
                    $(this).val('yes');
                }
                var current_shortcode = $('#elegant-form-shortcode').val();
                var output = '';
                if (current_shortcode.includes('filter')) {
                    var start_position = current_shortcode.indexOf('filter');
                    var end_position = current_shortcode.indexOf("'", start_position + 8);
                    var filter_part = current_shortcode.substring(start_position, end_position + 1);
                    output = current_shortcode.replace(filter_part, "filter='" + $(this).val() + "'");
                } else {
                    var position = current_shortcode.lastIndexOf(']');
                    var output = [current_shortcode.slice(0, position), "filter='" + $(this).val() + "'", current_shortcode.slice(position)].join(' ');
                }
                ElegantCalendarSettings.shortcode = output;
                $('#elegant-form-shortcode').val(ElegantCalendarSettings.shortcode);
            });

        },


        /**
         * Load Popup
         *
         */
        _loadPopup: function( ) {

            $('.open-shortcode-genenator').magnificPopup({
                type:'inline',
                midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
                // Delay in milliseconds before popup is removed
                removalDelay: 300,

                // Class that is added to popup wrapper and background
                // make it unique to apply your CSS animations just to this exact popup
                callbacks: {
                    beforeOpen: function() {
                        this.st.mainClass = this.st.el.attr('data-effect');
                    }
                },
            });

        },

        /**
         * Switch Tabs
         *
         */
        _switchTabs: function( event ) {

            event.preventDefault();

            var tab = '#' + $(this).data('nav');

            $('.elegant-vertical-tab').removeClass('current');
            $(this).parent().addClass('current');

            $('.elegant-box-tab').removeClass('active');
            $('.elegant-box-tabs').find(tab).addClass('active');

        },

        /**
         * Save Settings
         *
         */
        _saveSettings: function( event ) {

            event.preventDefault();

            $(this).html('<div class="text-center"><div class="loader1"><span></span><span></span><span></span><span></span><span></span></div></div>');

            // set post form data
            var formdata = $('.elegant-settings-form').serializeArray();
            var fields = {};
            $(formdata ).each(function(index, obj){
                fields[obj.name] = obj.value;
            });

            console.log(fields);

            $.ajax({
                    url  : Elegant_Calendar_Data.ajaxurl,
                    type : 'POST',
                    dataType: 'json',
                    data : {
                        action       : 'elegant_save_glabal_settings',
                        fields_data  : fields,
                        _ajax_nonce  : Elegant_Calendar_Data._ajax_nonce,
                    },
                    beforeSend: function() {
                    },
                })
                .fail(function( jqXHR ){
                    console.log( jqXHR.status + ' ' + jqXHR.responseText);
                })
                .done(function ( options ) {
                    if( false === options.success ) {
                        console.log(options);
                    } else {
                        console.log(options);
                        $('.elegant-global-settings-button').html('<span class="elegant-loading-text">Save Settings</span>');
                        ElegantCalendarSettings._displayNoticeMessage('Settings has been saved successfully!');
                    }
                });

        },

        /**
         * Display Notice Message
         *
         */
        _displayNoticeMessage: function(message) {

            var html = '<div class="message-box elegant-message-box success">' + message + '</div>';
            $(html).appendTo(".elegant-content-wrap").slideDown('slow').animate({opacity: 1.0}, 4500).slideUp('slow');

        },

    };

    /**
     * Initialize ElegantCalendarSettings
     */
    $(function(){
        ElegantCalendarSettings.init();
    });

})(jQuery);