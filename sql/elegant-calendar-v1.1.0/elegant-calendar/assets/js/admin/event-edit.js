(function($){

    "use strict";

    var ElegantCalendarEventEdit = {

        init: function()
        {
            // Document ready.
            $( document ).ready( ElegantCalendarEventEdit._eventDatePicker() );
            $( document ).ready( ElegantCalendarEventEdit._locationSelect() );
            $( document ).ready( ElegantCalendarEventEdit._organizerSelect() );
            $( document ).ready( ElegantCalendarEventEdit._typeSelect() );
            $( document ).ready( ElegantCalendarEventEdit._loadColorPicker() );

            this._bind();
        },

        /**
         * Binds events for the ElegantCalendarEventEdit.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '#elegant-event-publish', ElegantCalendarEventEdit._publishEvent );
            $( document ).on('click', '#elegant-event-draft', ElegantCalendarEventEdit._draftEvent );
            $( document ).on('click', '.elegant-vertical-tab a', ElegantCalendarEventEdit._switchTabs );
            $( document ).on('click', '.elegant-image-uploader-browse', ElegantCalendarEventEdit._openUploader );
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
         * Event Image Uploader
         *
         */
        _openUploader: function( event ) {
            var mediaUploader,
                attachment,
                trigger;

            event.preventDefault();

            // store the element that was clicked for use later
            trigger = $(this);

            if( mediaUploader ){
                mediaUploader.open();
                return;
            }

            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Upload',
                button: {
                    text: 'Upload'
                },
                    multiple: false
            });

            mediaUploader.on('select', function() {

                attachment = mediaUploader.state().get('selection').first().toJSON();

                // assign the value of attachment to an input based on the data-target value
                // of the button that was clicked to launch the media browser
                $('#' + trigger.data('target') ).val(attachment.url);
                $('.elegant-thumbnail-preview').attr('src', attachment.url);

            });

            mediaUploader.open();
        },

        /**
         * Event Type Select
         *
         */
        _typeSelect: function( ) {
            // Event type select2
            $(".elegant-type-multi-select").select2({
                placeholder: "Select your event types here", //placeholder
                allowClear: true
            });
        },

        /**
         * Location Select
         *
         */
        _locationSelect: function( ) {
            // onClick new options list of new select
            var newOptions = $('.location-list-results > li');
            newOptions.on('click', function(){
                $('.location-list-value').html($(this).html());
                $('.location-list-value').val($(this).find('.dd-option-value').val());
                $('.location-list-results > li').removeClass('selected');
                $(this).addClass('selected');
            });

            var aeDropdown = $('.location-select-list-container');
            aeDropdown.on('click', function(){
                aeDropdown.children('.location-list-results').toggleClass('elegant-sidenav-hide-md');
            });

            var elegantDropdown = $('.location-dropdown-handle');
            elegantDropdown.on('click', function(){
                elegantDropdown.children('.location-list-results').toggleClass('elegant-sidenav-hide-md');
            });
        },

        /**
         * Organizer Select
         *
         */
        _organizerSelect: function( ) {
            // onClick new options list of new select
            var newOptions = $('.organizer-list-results > li');
            newOptions.on('click', function(){
                $('.organizer-list-value').html($(this).html());
                $('.organizer-list-value').val($(this).find('.dd-option-value').val());
                $('.organizer-list-results > li').removeClass('selected');
                $(this).addClass('selected');
            });

            var aeDropdown = $('.organizer-select-list-container');
            aeDropdown.on('click', function(){
                aeDropdown.children('.organizer-list-results').toggleClass('elegant-sidenav-hide-md');
            });

            var elegantDropdown = $('.organizer-dropdown-handle');
            elegantDropdown.on('click', function(){
                elegantDropdown.children('.organizer-list-results').toggleClass('elegant-sidenav-hide-md');
            });
        },


        /**
         * Switch Tabs
         *
         */
        _switchTabs: function( event ) {
            event.preventDefault();
            var tab = '#' + $(this).data('nav');
            console.log(tab);

            $('.elegant-vertical-tab').removeClass('current');
            $(this).parent().addClass('current');

            $('.elegant-box-tab').removeClass('active');
            $('.elegant-box-tabs').find(tab).addClass('active');
        },


        /**
         * Publish Event
         *
         */
        _publishEvent: function( ) {

            var formdata = $('.elegant-event-form').serializeArray();
            var fields = {};
            $(formdata ).each(function(index, obj){
                fields[obj.name] = obj.value;
            });
            fields['event_status'] = 'publish';
            fields['elegant_post_status'] = $('#elegant-post-status').val();
            fields['elegant_event_content'] = tinyMCE.get('elegant_event_content').getContent();
            fields['elegant_event_location'] = $('#elegant-event-location').val();
            fields['elegant_event_organizer'] = $('#elegant-event-organizer').val();
            // set selected type data
            var select_type_data = $('.elegant-type-multi-select').select2('data');
            var selected_type = select_type_data.map(function (el) {
                return el.id;
            });
            fields['elegant_event_type'] = selected_type;

            $.ajax({
                    url  : Elegant_Calendar_Data.ajaxurl,
                    type : 'POST',
                    dataType: 'json',
                    data : {
                        action       : 'elegant_calendar_save_event',
                        fields_data  : fields,
                        _ajax_nonce  : Elegant_Calendar_Data._ajax_nonce,
                    },
                    beforeSend: function() {

                        $('.elegant-status-changes').html('<ion-icon name="reload-circle"></ion-icon></ion-icon>Saving');

                    },
                })
                .fail(function( jqXHR ){
                    console.log( jqXHR.status + ' ' + jqXHR.responseText);
                })
                .done(function ( options ) {
                    if( false === options.success ) {
                        console.log(options);
                    } else {
                        $( "input[name='event_id']" ).val(options.data);

                        // update campaign tag status
                        $('.elegant-tag').html('published');
                        $('.elegant-tag').removeClass('elegant-tag-draft');
                        $('.elegant-tag').addClass('elegant-tag-published');

                        // update event save icon status
                        $('.elegant-status-changes').html('<ion-icon class="elegant-icon-saved" name="checkmark-circle"></ion-icon>Saved');

                        // update event button text
                        $('.event-save-text').text('unpublish');
                        $('.event-publish-text').text('update');

                        //update page url with event id
                        var event_url = Elegant_Calendar_Data.wizard_url+ '&id=' + options.data;
                        window.history.replaceState('','',event_url);
                    }
                });

        },

        /**
         * Draft Event
         *
         */
        _draftEvent: function( ) {

            var formdata = $('.elegant-event-form').serializeArray();
            var fields = {};
            $(formdata ).each(function(index, obj){
                fields[obj.name] = obj.value;
            });
            fields['event_status'] = 'publish';
            fields['elegant_post_status'] = $('#elegant-post-status').val();
            fields['elegant_event_content'] = tinyMCE.get('elegant_event_content').getContent();
            fields['elegant_event_location'] = $('#elegant-event-location').val();
            fields['elegant_event_organizer'] = $('#elegant-event-organizer').val();
            // set selected type data
            var select_type_data = $('.elegant-type-multi-select').select2('data');
            var selected_type = select_type_data.map(function (el) {
                return el.id;
            });
            fields['elegant_event_type'] = selected_type;

            $.ajax({
                    url  : Elegant_Calendar_Data.ajaxurl,
                    type : 'POST',
                    dataType: 'json',
                    data : {
                        action       : 'elegant_calendar_save_event',
                        fields_data  : fields,
                        _ajax_nonce  : Elegant_Calendar_Data._ajax_nonce,
                    },
                    beforeSend: function() {

                        $('.elegant-status-changes').html('<ion-icon name="reload-circle"></ion-icon></ion-icon>Saving');

                    },
                })
                .fail(function( jqXHR ){
                    console.log( jqXHR.status + ' ' + jqXHR.responseText);
                })
                .done(function ( options ) {
                    if( false === options.success ) {
                        console.log(options);
                    } else {
                        $( "input[name='event_id']" ).val(options.data);

                        // update campaign status
                        $('.elegant-tag').html('draft');
                        $('.elegant-tag').removeClass('elegant-tag-published');
                        $('.elegant-tag').addClass('elegant-tag-draft');

                        // update event save icon status
                        $('.elegant-status-changes').html('<ion-icon class="elegant-icon-saved" name="checkmark-circle"></ion-icon>Saved');

                        // update event button text
                        $('.event-save-text').text('save draft');
                        $('.event-publish-text').text('publish');

                        //update page url with event id
                        var event_url = Elegant_Calendar_Data.wizard_url+ '&id=' + options.data;
                        window.history.replaceState('','',event_url);
                    }
                });

        },

        /**
         * Event DataPicker
         *
         */
        _eventDatePicker: function( ) {

            $( "#elegant_event_start_date" ).datepicker();
            $( "#elegant_event_end_date" ).datepicker();

        },



    };

    /**
     * Initialize ElegantCalendarEventEdit
     */
    $(function(){
        ElegantCalendarEventEdit.init();
    });

})(jQuery);