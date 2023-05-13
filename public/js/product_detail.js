$(document).ready(function () {
    
    //displayImg();
    var ordered_number = $('.ordered_number').first().text();
    var total_comment = 0;
    var total_order = 0;
    var product_id = $('items').attr('item-id');
    getInfo();

    var notify_product_detail =  {
        ordered_number:  parseInt(ordered_number),
        total_comment: total_comment,
        total_order: total_order,
        total_cart: total_cart[product_id],
        $ordered_number: $('.ordered_number'),
        noty_ordered_count: 0,
        noty_real_time_count: Math.floor((Math.random() * 50) + 20),
        noty_order_now_count: 0,
        noty_options: {
            text        : '',
            type        : 'success',
            dismissQueue: true,
            layout      : 'centerRight',
            theme       : 'relax',
            maxVisible: 1,
            killer: false,
            timeout: 3000,
            closeWith: ['click'],
            animation   : {
                open  : 'animated fadeInRight',
                close : 'animated fadeOutRight'
            }
        },
        init: function() {
            this.noty_ordered();
            this.noty_real_time();
        },
        random_number: function(min, max) {
            return Math.random() * (max - min) + min;
        },
        run_noty: function(options){
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                options.layout = 'topRight';
            }
            if ($(window).width() < 800 || $(window).height() < 500 ) {
                options.layout = 'topRight';
            } else {
                options.layout = 'centerRight';
            }
            noty(options);
        },
        noty_ordered: function() {
            var self = this;
            setTimeout(function(){
                self.noty_options.text = 'Đã có ' + self.ordered_number + ' người mua sản phẩm này';
                self.run_noty(self.noty_options);
            }, self.random_number(5000, 10000));

            var noty_time = self.random_number(20000, 120000);
            var run = setInterval(function(){
                getInfo();
                if (ordered_number > self.ordered_number) {
                    self.ordered_number = ordered_number;
                    self.noty_options.text = 'Có người vừa mua sản phẩm này';
                    self.noty_options.timeout = 5000;
                    self.noty_options.type = 'warning';
                    self.run_noty(self.noty_options);
                } else {
                    self.noty_options.type = 'success';
                    self.noty_options.text = 'Đã có ' + self.ordered_number + ' người mua sản phẩm này';
                    self.run_noty(self.noty_options);
                }            
            }, noty_time);
        },
        noty_real_time: function() {
            var self = this;
            var noty_time = self.random_number(10000, 30000);
            var run = setInterval(function(){
                if (total_cart[product_id] > 0) {
                    self.noty_real_time_count += total_cart[product_id];
                    self.noty_options.text = 'Có ' + total_cart[product_id] + ' người đang quan tâm sản phẩm này';
                    self.noty_options.type = 'information';
                    self.run_noty(self.noty_options);
                }
                if (total_order > self.total_order) {
                    self.noty_options.type = 'information';
                    self.noty_options.text = '+' + (total_order - self.total_order) + ' đơn đặt hàng cho sản phẩm này.';
                    self.run_noty(self.noty_options);
                    self.total_order = total_order;
                }
                if (total_comment > self.total_comment) {
                    self.noty_options.type = 'information';
                    self.noty_options.text = '+' + (total_comment - self.total_comment) + ' bình luận mới về sản phẩm này.';
                    self.run_noty(self.noty_options);
                    self.total_comment = total_comment;
                }
                if (total_cart[product_id] > self.total_cart) {
                    self.noty_options.type = 'information';
                    self.noty_options.text = '+' + (total_cart[product_id] - self.total_cart) + ' người đang quan tâm sản phẩm này.';
                    self.run_noty(self.noty_options);
                    self.total_cart = total_cart[product_id];
                }
            }, noty_time);
        }
    };
	if (ordered_number.length > 0) {
        notify_product_detail.init();
    }


    function get_help_block(text) {
        return '<span class="help-block">' + text + '</span>';
    }
    function validate_email(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    /*
    setTimeout(get_comment_list(1, true), 10000);
    */
    function get_comment_list(first) {
        var $comment_list = $('.comment-list'),
            product_id = $('input[name=product_id]').val(),
            $btn_load_previous = $('.view-previous-comment'),
            page = parseInt($btn_load_previous.attr('data-page'));
        if (first) {
            var $item_default = $('.comment-item-default').clone().wrap('<div>');
            $comment_list.find('.comment-parent').remove();
            $comment_list.prepend($item_default.parent().html());
            page = 1;
        }
        $.ajax({
            type: 'GET',
            url: window.location.origin + "/product/getcomment/"+product_id+"/" + page,
            success: function (data) {
                data = jQuery.parseJSON(data);
                $.each(data.comment_list, function(index, item) {
                    append_comment_parent(item.com_name, item.com_rating,item.com_title);
                });

                if (page == data.total.total_page || data.comment_list.length == 0) {
                    $btn_load_previous.remove();
                } else {
                    $btn_load_previous.attr('data-page', (page + 1));
                }

                if (first) {
                    $('.top-detail').find('.filled-stars').css('width', (parseFloat(data.total.product_rating_avg/5) * 100) + '%');
                }
            }
        });
    }
    function append_comment_parent(name, rating, content) {
        var $item_default = $('.comment-item-default').clone().wrap('<div>'),
            $comment_list = $('.comment-list')
            rating = rating/5 * 100;
        $item_default.removeClass('comment-item-default');
        $item_default.find('.avatar').text(name);
        $item_default.find('.filled-stars').css('width', rating + '%');
        $item_default.find('.comment-content').html(content);
        $comment_list.prepend($item_default.parent().html());
    }

    function append_comment_child(parent_id, name, rating, content) {
        var $item_default = $('.comment-item-default').clone().wrap('<div>'),
            $comment_list = $('.comment-list');
        $item_default.removeClass('comment-item-default');
        $item_default.find('.avatar').text('TAN');
        $item_default.find('.comment-rating-display').attr('value', '2');
        $item_default.find('.comment-content').text('test');
        $comment_list.prepend($item_default.parent().html());
    }
    // rating

    $('#rating-display').rating({displayOnly: true, step: 0.5});
    $('.comment-rating-display').rating({displayOnly: true, step: 1});
    $('.submit_comment').click(function() {
        var $name = $('input[name=comment_name]'),
            $email = $('input[name=comment_email]'),
            $content = $('textarea[name=comment_content]'),
            has_error = false;

        $('.form_comment').find('.help-block').remove();
        if ($name.val().length == 0) {
            $name.parent().addClass('has-error');
            $name.after(get_help_block('Vui lòng nhập Họ Tên'));
            has_error = true;
        } else {
            $name.parent().removeClass('has-error');
            $name.parent().find().remove('.help-block');
        }

        if ($email.val().length > 0) {
            if (!validate_email($email.val())) {
                $email.parent().addClass('has-error');
                $email.after(get_help_block('Bạn đã nhập sai định dạng Email'));
                has_error = true;

            } else {
                $email.parent().removeClass('has-error');
                $email.parent().find().remove('.help-block');
            }
        }

        if ($content.val().length == 0) {
            $content.parent().addClass('has-error');
            $content.after(get_help_block('Vui lòng nhập Nội Dung'));
            has_error = true;
        } else {
            $content.parent().removeClass('has-error');
            $content.parent().find().remove('.help-block');
        }

        if (! has_error) {
            var data = $('.form_comment').serialize();

            $.ajax({
                type: 'POST',
                url: window.location.origin + "/comment",
                data: data,
                success: function (data) {
                    notify_product_detail.noty_options.type = 'success';
                    notify_product_detail.noty_options.text = 'Gửi bình luận thành công';
                    notify_product_detail.run_noty(notify_product_detail.noty_options);
                    //$.growl.notice({ message: 'Gửi bình luận thành công.' });
                    $name.val('');
                    $email.val('');
                    $content.val('');
                    data = jQuery.parseJSON(data);
                    append_comment_parent(data.com_name, data.com_rating,data.com_title);
                }
            });
        }
    });
    /*
    $('.view-previous-comment').click(function(){
        get_comment_list(false);
    });
    var fb_tracking_data = $('.fb-tracking-data');
    var content_ids = fb_tracking_data.attr('data-content-ids');
    window._fbq.push(['track', 'ViewContent', {
        content_ids: content_ids,
        content_type: 'product'
    }]);*/

    function getInfo()
    {
        var product_id = $('items').attr('item-id');
        var _token = $('input[name=_token]').val();
        var data = {
            product_id: product_id,
            _token: _token,
        };
        $.post('/order/get-info-notify', data, function(data) {
            ordered_number = data.total_sales;
            total_comment = data.total_comment;
            total_order = data.total_order;
        });
    }

});

function displayImg () {
    $('.thumbs .inner ul li').on('click', function (e) {
        e.preventDefault();
        console.log($(this).length);
        alert(4243);
    })
}
