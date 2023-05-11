$(document).ready(function($)
{

    $("img").each(function() {
       $imageTitle = $(this).attr('alt');
       $(this).attr('title', $imageTitle);
    });

    $(".btn-add-to-cart").on("click", function (e) {
        e.preventDefault();

        var name = $('items').attr('item-name');
        var price = $('items').attr('item-price');
        var id = $('items').attr('item-id');
        var sku = $('items').attr('item-sku');
        var image = $('items').attr('item-image');
        var slug = $('items').attr('item-slug');
        var qty = $('input[name=item_qty_se]').val();
        var color = $('select[name=item_option_se]').val();
        
        $.addToCart(id, name, qty, price, slug, image, color, sku);
    });

    $('.btn-remove-cart').on('click', function(e){
        var rowId = $(this).attr('data-rowid');
        $.removeFromCart(rowId);
    });

    $('.cart_quantity_input').on('change', function(){
        var rowId = $(this).attr('data-rowid');
        var qty = $(this).val();
        $.cartUpdateQuantity(rowId, qty);
    });
    
    $.addToCart = function(id, name, qty, price, url, image, color, sku, note) {
        $('#load-page').show();
        var data = {
            id: id,
            name: name,
            qty: qty,
            price: price,
            url: url,
            image: image,
            color: color,
            note: note,
            sku: sku,
        };
        
        $.post('/cart/add', data, function(data) {
            if (typeof total_cart[id] != 'undefined') {
                total_cart[id]++;
            } else {
                total_cart[id] = 1;
            }
            
            if (data == 'success') {
                $.growl.notice({ message: localStorage.getItem("add-cart-success") });
                $.updateMenu();
                $.updateCart();
                $('.product-container .row-' + id).remove();
                window.location.href = "/gio-hang.html";
            }

            if (data == 'error') {
                $.growl.error({ message: localStorage.getItem("add-cart-error") });
            }
            $('#load-page').hide();

        });
    };

    $.removeFromCart = function(rowId) {
        $.ajax({
            url: '/cart/remove/' + rowId,
            type: 'POST',
            success: function(data) {
                $('.gross-show').html(data.gross);
                $('.total-show').html(data.total);
                $.growl.notice({ message: localStorage.getItem("remove-cart-success") });
                //$.updateMenu();
                //$.updateCart();
                //$.calculateCart();
                $("#cart-item-" + data['rowId']).fadeOut(300, function(){
                    $.when($("#cart-item-" + data['rowId']).remove()).then(function() {
                        if (data['qty'] == 0) {
                            $("#cart-empty-message").show();
                        };
                    });
                });
            }
        });
    };

    $.updateMenu = function() {
        $.get('/cart/update-menu', function(data) {
            $("#header").html(data);
        });
    };

    $.updateCart = function() {
        $.get('/cart/update-cart', function(data) {
            $("#cart-container").html(data);
        });
    };

    $.calculateCart = function() {
        $('#load-page').show();
        var add_expensive_fee_checkbox = 0;
        var add_broken_fee_checkbox = 0;
        var add_broken_fee_percent = 5;
        var check_goods_fee_checkbox = 0;
        var order_attr = $('.order-express-info input[name=order_attr]:checked').val();
        if ($('input.add_expensive_fee_checkbox').is(':checked') == true){
            add_expensive_fee_checkbox = 1;
        } else {
            add_expensive_fee_checkbox = 0;
        }

        if ($('input.add_broken_fee_checkbox').is(':checked') == true){
            add_broken_fee_checkbox = 1;
        } else {
            add_broken_fee_checkbox = 0;
        }
        var add_broken_fee_percent = $('input[name=broken_fee_percent]:checked').val();
        
        if ($('input.check_goods_fee_checkbox').is(':checked') == true){
            check_goods_fee_checkbox = 1;
        } 

        var data = {
            order_attr: order_attr,
            add_expensive_fee_checkbox : add_expensive_fee_checkbox,
            add_broken_fee_checkbox : add_broken_fee_checkbox,
            add_broken_fee_percent : add_broken_fee_percent,
            check_goods_fee_checkbox : check_goods_fee_checkbox,
        };
        $.post('/cart/calculate-cart', data, function(data) {
            $(".order-express-info").find(".total_price_cny").html(data.total_price_cny);
            $(".order-express-info").find(".total_price_vnd").html(data.total_price_vnd);
            $(".order-express-info").find(".service_fee").html(data.service_fee);
            $(".order-express-info").find(".service_fee_percent").html(data.service_fee_percent);
            $(".order-express-info").find(".received_fee").html(data.received_fee);
            $(".order-express-info").find(".add_expensive_fee").html(data.add_expensive_fee);
            $(".order-express-info").find(".add_broken_fee").html(data.add_broken_fee);
            $(".order-express-info").find(".check_goods_fee").html(data.check_goods_fee);
            $(".order-express-info").find(".total_vnd").html(data.total_vnd);
            $('#load-page').hide();
        });
    };

    $.getExpensive = function() {
        var order_attr = $('.order-express-info input[name=order_attr]:checked').val();
        $.post('/cart/update-expensive/' + order_attr, function(data) {
            $(".order-express-info").find(".total_price_cny").html(data.total_price_cny);
            $(".order-express-info").find(".total_price_vnd").html(data.total_price_vnd);
        });
    };

    $.cartQuantityUp = function(rowId) {
        $.post('/cart/qty-up/' + rowId, function(data) {
            $("#cart-item-" + rowId).find(".cart_quantity_input").val(data.qty);
            $("#cart-item-" + rowId).find(".item_total_price").html(data.totalPrice);
            $.updateMenu();
            $.calculateCart();
            $.growl.notice({ message: localStorage.getItem("update-cart-success") });
        });
    };

    $.cartQuantityDown = function(rowId) {
        $.post('/cart/qty-down/' + rowId, function(data) {
            if (data.empty) {
                $("#cart-item-" + rowId).fadeOut(300, function(){
                    $.when($("#cart-item-" + rowId).remove()).then(function() {
                        $.checkEmptyCart();
                    });
                });
                $.growl.notice({ message: localStorage.getItem("remove-cart-success") });
            } else {
                $("#cart-item-" + rowId).find(".cart_quantity_input").val(data.qty);
                $("#cart-item-" + rowId).find(".item_total_price").html(data.totalPrice);
                $.growl.notice({ message: localStorage.getItem("update-cart-success") });
            }
            $.updateMenu();
            $.calculateCart();
        });
    };

    $.cartUpdateQuantity = function(rowId, qty) {
        var data = {
            rowId: rowId,
            qty: qty,
        };
        $.post('/cart/update-qty', data, function(data) {
            if (data.error) {
                $.growl.error({ message: data.error });
            } else {
                $("#cart-item-" + rowId).find(".cart_quantity_input").val(data.qty);
                $("#cart-item-" + rowId).find(".td-total-price").html(data.totalPrice);
                $('.gross-show').html(data.gross);
                $('.total-show').html(data.total);
                //$.updateMenu();
                //$.updateCart();
                //$.calculateCart();
                $.growl.notice({ message: localStorage.getItem("update-cart-success") });
            }
        });
    };

    $.cartUpdatePrice = function(rowId, price) {
        var data = {
            rowId: rowId,
            price: price,
        };
        $.post('/cart/update-price', data, function(data) {
            if (data.error) {
                $.growl.error({ message: data.error });
            } else {
                $("#cart-item-" + rowId).find(".cart_price_input").val(data.price);
                $("#cart-item-" + rowId).find(".td-total-price").html(data.totalPrice);
                $.updateMenu();
                $.updateCart();
                $.calculateCart();
                $.growl.notice({ message: localStorage.getItem("update-cart-success") });
            }
        });
    };

    $.cartUpdateNote = function(rowId, note) {
        var data = {
            rowId: rowId,
            note: note,
        };
        $('#load-page').show();
        $.post('/cart/update-note', data, function(data) {
            if (data.error) {
                $.growl.error({ message: data.error });
            } else {
                $("#cart-item-" + rowId).find(".cart_note_input").val(data.note);
                $.growl.notice({ message: localStorage.getItem("update-cart-success") });
            }
            $('#load-page').hide();
        });
    };

    $.cartUpdateName = function(rowId, name) {
        var data = {
            rowId: rowId,
            name: name,
        };
        $('#load-page').show();
        $.post('/cart/update-name', data, function(data) {
            if (data.error) {
                $.growl.error({ message: data.error });
            } else {
                $("#cart-item-" + rowId).find(".cart_name_input").val(data.name);
                $.growl.notice({ message: localStorage.getItem("update-cart-success") });
            }
            $('#load-page').hide();
        });
    };
    
    $.checkEmptyCart = function() {
        $.get('/cart/totalQty', function(data) {
            if (!(data > 0)) {
                $("#cart-empty-message").show();
            }
        });
    };

});