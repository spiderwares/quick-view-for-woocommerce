jQuery(function ($) {

    class QVWCQuickView {

        constructor() {
            this.eventHandlers();
        }

        eventHandlers() {
            $(document.body).on('click', '.qvwc-quick-view', this.openQuickView.bind(this));
            $(document.body).on('click', '.qvwc-quick-view-close', this.closeQuickView.bind(this));
            $(document.body).on('click', '.qvwc_add_to_cart, .qvwc-variable-add-to-cart-button', this.addToCartHandler.bind(this));
            $(document.body).on('change', '.qvwc_variations_form select', this.setVariationId.bind(this));
            $(document.body).on('click', '.variable-items-wrapper li.variable-item', this.swatchSelectHandler.bind(this));
        }

        openQuickView(e) {
            e.preventDefault();

            let __this      = $(e.currentTarget),
                productId   = __this.data('product_id');

            if (!productId) {
                console.log('Product ID is missing.');
                return;
            }

            $.ajax({
                type: 'POST',
                url: qvwc_vars.ajax_url, // Ensure `qvwc_vars` is localized in PHP
                data: {
                    action: 'qvwc_load_quick_view',
                    product_id: productId,
                    qvwc_nonce: qvwc_vars.qvwc_nonce, 
                },
                beforeSend: () => {
                    __this.addClass('qvwc-loading');
                },
                success: (response) => {
                    if (response.success) {
                        $('.qvwc-model .qvwc-model-content').html(response.data.html);
                        $('.qvwc-model').fadeIn().addClass( 'open' );
                        let slides = $('.qvwc-slider .qvwc-slide');
                        if (slides.length > 1) {
                            $('.qvwc-slider').slick();
                        }
                    } else {
                        console.log('Quick View error:', response.data.message);
                    }
                },
                error: () => {
                    console.log('Error loading Quick View.');
                },
                complete: () => {
                    __this.removeClass('qvwc-loading');
                }
            });
        }

        closeQuickView(e){
            $('.qvwc-model').fadeOut().removeClass( 'open' );
        }

        addToCartHandler(e) {
            e.preventDefault();

            var __this       = $(e.currentTarget),
                productId    = __this.data('id') || __this.data('product_id'),
                type         = __this.data('type'),
                row          = __this.closest('tr'),
                variation_id = row.find('input.variation_id').val() || 0;

            if (!productId) return;

            const form = row.closest('.qvwc_variations_form');
            let data = {
                'product_id': productId,
                'add-to-cart': productId,
                'quantity': 1,
            };

            if (type === 'variable') {
                // Check if variation is selected
                if (!variation_id || variation_id == 0) {
                    $('#qvwc-messages').html('<span style="color:red;">Please select a variation before adding to cart.</span>');
                    return;
                }
                
                $('#qvwc-messages').html('');

                var variation = {}; // Initialize the variation object
                form.find('.variable-item.selected').each(function () {
                    var attribute = $(this).data('attribute_name');
                    var value = $(this).data('value');

                    if (!value) {
                        allAttributesSelected = false;
                    }
                    data[attribute] = value;
                });
                
                data.variation_id   = variation_id;
            }

            console.log(data);

            // Perform AJAX request to add to cart
            $.ajax({
                type: "POST",
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace("%%endpoint%%", "add_to_cart"),
                data: data,
                beforeSend: () => {
                    __this.addClass("loading");
                },
                success: (response) => {
                    // Check if the response contains fragments and update cart
                    if (response && response.fragments) {
                        $.each(response.fragments, function (key, value) {
                            $(key).replaceWith(value);
                        });
                        $(document.body).trigger('wc_fragment_refresh');
                    }

                    // Close Quick View if enabled in settings
                    if (qvwc_vars.quick_view_setting.close_popup_after_add_to_cart === "yes") {
                        this.closeQuickView();
                    }

                    // Redirect to checkout if enabled in settings
                    if (qvwc_vars.quick_view_setting.redirect_to_checkout_after_add_to_cart === "yes") {
                        window.location.href = qvwc_vars.checkout_url;
                    }
                },
                error: (xhr, status, error) => {
                    console.log("Error adding to cart:", error);
                },
                complete: () => {
                    __this.removeClass("loading").addClass("added");
                }
            });
        }



        setVariationId(e) {
            let form = $(e.currentTarget).closest('.qvwc_variations_form'),
                data = form.data('product_variations') || [],
                selected = {};

            form.find('select').each(function () {
                let val = $(this).val();
                if (val) selected[$(this).attr('name')] = val;
            });

            const match = data.find(v => Object.entries(v.attributes).every(([k, v]) => selected[k] === v || v === ''));
            form.find('input.variation_id').val(match ? match.variation_id : 0);
            form.find('.qvwc-price').html(match ? match.price_html : '');
        }

        swatchSelectHandler(e) {
            e.preventDefault();

            const item = $(e.currentTarget),
                attributeName = item.data('attribute_name'),
                value = item.data('value'),
                form = item.closest('.qvwc_variations_form'),
                data = form.data('product_variations') || [],
                selected = {};

                item.closest('ul.variable-items-wrapper').find('li.variable-item').removeClass('selected');
                item.addClass('selected');


            selected[attributeName] = value;
           
            // Match variation based on selected attributes
            const match = data.find(variation => {
                return Object.entries(variation.attributes).every(([key, val]) => {
                    return selected[key] === val || val === '';
                });
            });
            // Update variation ID
            form.find('input.variation_id').val(match ? match.variation_id : 0);

        }


    }

    new QVWCQuickView();

});