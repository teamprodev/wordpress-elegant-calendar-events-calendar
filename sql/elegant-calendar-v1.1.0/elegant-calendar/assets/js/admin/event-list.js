(function($){

    "use strict";

    var ElegantCalendarEventList = {

        init: function()
        {
            this._bind();
        },

        /**
         * Binds events for the ElegantCalendarEventList.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '#elegant-check-all-events', ElegantCalendarEventList._checkAll );
            $( document ).on('click', '.elegant-bulk-action-button', ElegantCalendarEventList._prepareBulk );
            $( document ).on('click', '.elegant-dropdown-anchor', ElegantCalendarEventList._displayActions );
            $( document ).on('click', '.elegant-filter-button', ElegantCalendarEventList._openFilter );
        },

        /**
         * Open Filter
         *
         */
        _openFilter: function( event ) {
            event.preventDefault();
            console.log('open filter');
            $(this).closest('.elegant-box').find('.elegant-filter-fields-wrapper').toggleClass('open');
        },

        /**
         * Display Actions
         *
         */
        _displayActions: function( event ) {
            event.preventDefault();
            $(this).closest('.elegant-dropdown').find('.elegant-dropdown-list').toggleClass('active');

            var this_id = $(this).data("id");
            var lists = document.querySelectorAll('.elegant-dropdown-list');
            lists.forEach(function(list) {
                if (parseInt(list.dataset.id) !== parseInt(this_id)) {
                    list.classList.remove('active');
                }
            });
        },

        /**
         * Check All
         *
         */
        _checkAll: function( ) {
            if($(this).prop('checked')){
                $('.elegant-check-single-campaign').prop('checked', true);
            }else{
                $('.elegant-check-single-campaign').prop('checked', false);

            }
        },

        /**
         * Prepare data before bulk action
         *
         */
        _prepareBulk: function( ) {
            var ids = [];
            $('.elegant-check-single-campaign').each(function( index ) {
                if($(this).prop('checked')){
                    var value = $(this).val();
                    ids.push(value);
                }
            });

            $('#elegant-select-events-ids').val(ids);
        },
    };

    /**
     * Initialize ElegantCalendarEventList
     */
    $(function(){
        ElegantCalendarEventList.init();
    });

})(jQuery);