(function($){

    "use strict";

    var ElegantCalendarDashboard = {

        init: function()
        {
            this._bind();
        },

        /**
         * Binds events for the ElegantCalendarDashboard.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '.nav-tab', ElegantCalendarDashboard._switchWelcomeTabs );

        },

        /**
         * Switch Welcome Tabs
         *
         */
        _switchWelcomeTabs: function( event ) {

            event.preventDefault();
            var tab = '#' + $(this).data('nav');

            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');

            $('.nav-container').removeClass('active');
            $('.elegant-welcome-tabs').find(tab).addClass('active');

        },

    };

    /**
     * Initialize ElegantCalendarDashboard
     */
    $(function(){
        ElegantCalendarDashboard.init();
    });

})(jQuery);