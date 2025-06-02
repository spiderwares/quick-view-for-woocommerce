jQuery(function ($) {
    class QVWC_Admin {
        constructor() {
            this.init();
        }

        init() {
            this.eventHandlers();
            this.initColorPicker();
        }

        eventHandlers() {
            $(document.body).on( 'change', '.qvwc-switch-field input[type="checkbox"], select', this.toggleVisibility.bind(this) );
        }

        initColorPicker() {
            $(".qvwc-colorpicker").wpColorPicker({
                change: function (event, ui) {
                    $(this).siblings(".colorpickpreview").css("background-color", ui.color.toString());
                },
            });
        }

        toggleVisibility(e) {
            var __this = $(e.currentTarget);

            if (__this.is('select')) {
                var target      = __this.find(':selected').data('show'),
                    hideElemnt  = __this.data( 'hide' );
                    $(document.body).find(hideElemnt).hide();
                    $(document.body).find(target).show();
            } else {
                var target = __this.data('show');
                $(document.body).find(target).toggle();
            }
        }
    }

    new QVWC_Admin();
});