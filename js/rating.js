/*
 *   (c) Semen Alekseev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

class RatingTools {
    addbox(f) {
        $('.js_titleRemove').remove();
        // viiBox.start();
        $.post('/index.php?go=rating', {for_user_id: f}, function (data) {
            // viiBox.win('rate', d);
            Box.Show('rate', 400, lang_rate, data, lang_box_cancel);
        });
    }
    save(u) {
        var trate = parseInt($('#profile_rate_num').text()) + parseInt($('#rate_num').val());
        var add = $('#rate_num').val();
        if (parseInt($('#balance').val()) < parseInt($('#rate_num').val())) {
            setErrorInputMsg('rate_num');
            return false;
        }
        if (add !== 0) {
            butloading('saverate', 94, 'disabled', '');
            $.post('/index.php?go=rating&act=add', {for_user_id: u, num: add}, function (d) {
                $('#profile_rate_num').text(trate);
                if (trate > 1000) {
                    $('.profile_rate_100_left, .profile_rate_500_left').addClass('profile_rate_1000_left');
                    $('.profile_rate_100_right, .profile_rate_500_right').addClass('profile_rate_1000_right');
                    $('.profile_rate_100_head, .profile_rate_500_head').addClass('profile_rate_1000_head');
                } else if (trate > 500) {
                    $('.profile_rate_100_left').addClass('profile_rate_500_left');
                    $('.profile_rate_100_right').addClass('profile_rate_500_right');
                    $('.profile_rate_100_head').addClass('profile_rate_500_head');
                }
                Box.Close('rate');
            });
        } else
            setErrorInputMsg('rate_num');
    }
    update() {
        var add = $('#rate_num').val();
        var new_rate = $('#balance').val() - add;
        var pr = parseInt(add);
        if (!isNaN(pr)) $('#rate_num').val(parseInt(add));
        else $('#rate_num').val('');
        if (add && new_rate >= 0) {
            $('#num').text(new_rate);
            $('#rt').show();
        } else if (new_rate <= 0 || $('#balance').val() <= 0) {
            $('#num').text('недостаточно');
            $('#rt').hide();
        } else {
            $('#rt').show();
            $('#num').text($('#balance').val());
        }
    }
    view() {
        $.post('/index.php?go=rating&act=view', function (d) {
            Box.Show('view_rating', 400, lang_view_rating, d, lang_box_cancel);
        });
    }
    page() {
        if ($('#load_rate_prev_ubut').text() == 'Показать предыдущие повышения') {
            textLoad('load_rate_prev_ubut');
            $.post('/index.php?go=rating&act=view', {page_cnt: page_cnt_rate}, function (d) {
                page_cnt_rate++;
                $('#rating_users').append(d);
                $('#load_rate_prev_ubut').text('Показать предыдущие повышения');
                if (!d) $('#rate_prev_ubut').remove();
            });
        }
    }
}
const Rating = new RatingTools();