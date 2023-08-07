jQuery(document).ready(function ($) {

    // Create datatable for table invited user.
    let user_table_data = $('.invited-user-list').DataTable({
        bSort: false,
        select: true,
        search: true,
    });
    user_table_data.select.info(false);

    let data = $('.chung').DataTable({
        bSort: false,
        select: true,
        search: true,
        columnDefs: [

            {
                target: 5,
                visible: false,
            }, {
                target: 6,
                visible: false,
            },
        ],
    });
    data.select.info(false);
    $('#nganh').on('change', function () {
        var value = $(this).val();
        data.columns(5).search(value).draw();
        if ($('.hotstock').hasClass('active_follow')) {
            data.columns(6).search('1').draw();
        }
    });

    $('.hotstock').click(function () {
        var value = $('#nganh').val();
        if ($(this).hasClass('active_follow')) {
            $(this).removeClass('active_follow');
            data.columns(6).search('').draw();
            if (value != '') {
                data.columns(5).search(value).draw();
            }
        } else {
            console.log(data.columns(6).search(1).draw());

            if (value != '') {
                data.columns(5).search(value).draw();
            }
            $(this).addClass('active_follow');
        }
    })

    var data2 = $('.khuyen-nghi').DataTable({
        bSort: false,
        select: true,
        columnDefs: [

            {
                target: 7,
                visible: false,
            }, {
                target: 6,
                visible: false,
            },
        ],
    });

    $('#khuyen-nghi-filter').on('change', function () {
        var value = $(this).val();
        data2.columns(6).search(value).draw();
        if ($('.khuyennghiqt').hasClass('active_follow')) {
            data2.columns(7).search(1).draw();
        }
    });


    $('.khuyennghiqt').click(function () {
        var value1 = $('#khuyen-nghi-filter').val();
        if ($(this).hasClass('active_follow')) {
            $(this).removeClass('active_follow');
            data2.columns(7).search('').draw();
            if (value1 != '') {
                data2.columns(6).search(value1).draw();
            }
        } else {
            data2.columns(7).search(1).draw();

            if (value1 != '') {
                data2.columns(6).search(value1).draw();

            }
            $(this).addClass('active_follow');
        }
    })

    let account = $('.account-follow').DataTable({
        bSort: false,
        select: true,
        search: true,
    });

    $('.add_bookmark').click(function () {
        $.ajax({
            type: "post",
            dataType: "json",
            url: ajaxurl,
            data: {
                action: "add_bookmart",
                dataid: $(this).attr('data-id'),
            },
            context: this,
            beforeSend: function () {

            },
            success: function (response) {

                if (response.success) {
                    console.log(response);
                }
                else {
                    alert('Đã có lỗi xảy ra');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

                console.log('The following error occured: ' + textStatus, errorThrown);
            }
        })
        return false;

    });

    $('#addfollow').click(function () {
        $.ajax({
            type: "post",
            dataType: "json",
            url: ajaxurl,
            data: {
                action: "add_bookmart",
                dataid: $('select.stock').val(),
            },
            context: this,
            beforeSend: function () {

            },
            success: function (response) {

                if (response.success) {
                    swal({
                        title: response.data,
                        type: "success",
                    });
                    location.reload();
                }
                else {
                    swal({
                        title: response.data,
                        type: "warning",
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

                console.log('The following error occured: ' + textStatus, errorThrown);
            }
        })
        return false;

    });

    $(document).on('click', '.open', function () {
        $.ajax({
            type: "post",
            dataType: "json",
            url: ajaxurl,
            data: {
                action: "khuyennghi",
                dataid: $(this).attr('data-id'),
            },
            context: this,
            beforeSend: function () {
                $('#loader').removeClass('hidden');
                $('#khuyennghi').html('Loading.............');
            },
            success: function (response) {
                if (response.success) {
                    $('#khuyennghi').html(response.data);

                    $.loadMagnificPopup().then(function() {
                        $.magnificPopup.open({
                            items: {
                                src: '#khuyennghi',
                                type: 'inline'
                            }
                        })
                    });
                }
                else {
                    alert('Đã có lỗi xảy ra');
                }
            },
            complete: function () {
                $('#loader').addClass('hidden');
            },
            error: function (jqXHR, textStatus, errorThrown) {

                console.log('The following error occured: ' + textStatus, errorThrown);
            }
        })
        return false;

    });

})

