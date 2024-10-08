
<script src="{{ asset('/') }}dashboard/assets/js/jquery.form.min.js" ></script>
<script>
    $(document).ready(function() {
        $('.{{ $className }}').attr('enctype', 'multipart/form-data');
        $(document).on('submit', '.{{ $className }}', function(e) {
            e.preventDefault();
            $('.waves-ripple').remove();

            let form = $(this);

            let url = $(this).attr('action');
            var loader = $('.loader');
            $(this).ajaxSubmit({
                type: 'POST',
                url: url,
                beforeSend: function () {
                    let submitForm = form.find(".submit-button");
                    submitForm.attr('disabled', true).addClass('d-none');
                    form.find(".uploadProgress").removeClass('d-none').html("<i class='fas fa-spinner'></i>");
                    loader.show();
                },
                uploadProgress:function (event,position,total,percentComplete) {
                    form.find(".uploadProgress").text(percentComplete+'%');
                },
                success: (response) => {
                    form.find('.invalid-feedback').html('').hide();
                    form.find('input,select,textarea').removeClass('is-invalid');
                    form.find('input,select,textarea').addClass('is-valid');
                    form.find(".submit-button").removeClass('d-none').attr('disabled', false);
                    form.find(".uploadProgress").addClass('d-none').html("<i class='fas fa-spinner'></i>");
                    loader.hide();
                    if (response.status != 'success') {
                        if (response.hasOwnProperty('input')) {
                            form.find('error_' + response.input).html(response.msg);
                            form.find('input[name^=' + response.input + ']' + '.form select[name^=' + response.input + ']' + '.form textarea[name^=' + response.input + ']').addClass('is-invalid')
                        } else {

                            if(response.key != 'unauthorized'){
                                toastr.error(response.msg);
                            }
                        }
                    } else {

                        toastr.success(response.msg);
                    }

                    if (response.hasOwnProperty('url')) {
                        setTimeout(function () {
                            window.location.replace(response.url)
                        }, 3000);
                    }
                },
                error: function (xhr) {

                    form.find('.invalid-feedback').html('').show();
                    form.find('input,select,textarea').addClass('is-valid');
                    form.find('input,select,textarea').removeClass('is-invalid');
                    form.find(".submit-button").removeClass('d-none').attr('disabled', false)
                    form.find(".uploadProgress").addClass('d-none').html("<i class='fas fa-spinner'></i>");
                    loader.hide();
                    if(xhr.responseJSON != undefined){
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('[data-name="' + key + '"]').append(`<div class="text-danger d-block">${value}</div>`);
                            if (key.indexOf(".") >= 0) {
                                var split = key.split('.')
                                key = split[0] + '\\[' + split[1] + '\\]';
                                if(split[0] == 'images'){
                                    key = split[0]
                                }

                                if (split.length > 2){
                                    key = split[0] + '\\[' + split[1] + '\\]' + '\\[' + split[2] + '\\]';
                                }
                            }

                            if (key == 'count_errors'){
                               toastr.error(`${value}`);
                            }

                            form.find('.error_' + key).html(value);
                            form.find('[name^=' + key + ']').removeClass('is-valid');
                            form.find('[name^=' + key + ']').addClass('is-invalid');
                            var firstValidation = Object.keys(xhr.responseJSON.errors)[0];
                            var attr = $('[name="' + firstValidation + '"]');
                            var dataName = $('[data-name="' + firstValidation + '"]')
                            var id;
                            if (attr.length > 0) {
                                id = attr.parents('.tab-pane').attr('id');
                                $('[aria-controls="' + id + '"]').click();
                            }

                            if (dataName.length > 0) {
                                id = dataName.parents('.tab-pane').attr('id');
                                $('[aria-controls="' + id + '"]').click();
                            }

                        });
                    }

                },
            });


        });
    });
</script>