(function (window, undefined) {
    'use strict';

    $('#form-laporan').on('submit', function (event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: $('input[name=_method]').val() == undefined ? 'POST' : 'POST',
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(document).find('.text_error').text('');
                $('#btn-save').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.error) {
                    $.each(response.error, function (key, val) {
                        if (key.indexOf(".") != -1) {
                            var arr = key.split(".");
                            name = $("[name='" + arr[0] + "[]']:eq(" + arr[
                                1] + ")");
                        } else {
                            var name = $('[name=' + key + ']');
                        }
                        name.parent().append(
                            '<small class="text-danger text_error">' + val[
                            0] + '</small>');
                        $('html, body').animate({
                            scrollTop: name.offset().top - 200
                        }, 'slow');
                        return false;
                    });
                } else if (response.success) {
                    console.log(response.success);
                    form.unbind().submit();
                }
                $('#btn-save').removeAttr('disabled', 'disabled');
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                Swal.fire({
                    title: 'Error!',
                    text: thrownError,
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
                $('#btn-save').removeAttr('disabled', 'disabled');
            }
        });
    });

})(window);
