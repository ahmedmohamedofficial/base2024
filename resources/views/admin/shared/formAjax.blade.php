
<script src="{{ asset('/') }}dashboard/assets/js/jquery.form.min.js" ></script>
<script>
    $(document).ready(function() {
        $(document).on('submit', '.formAjax', function(e) {
            e.preventDefault();
            $('.waves-ripple').remove();

            var form = $(this);

            var old_content =  $(this).find(".submit-button").html();

            var url = $(this).attr('action')
            $(this).ajaxSubmit({
                type: 'POST',
                url: url,
                beforeSend: function () {
                    old_content = form.find(".submit-button").html();
                    var submitForm = form.find("#submit-button");
                    submitForm.attr('disabled', true)
                    

                },
                uploadProgress:function (event,position,total,percentComplete) {
                    
                    form.find(".submit-button").attr('disabled', true);
                    form.find(".submit-button").text(percentComplete+'%');
                },
                success: (response) => {
                    
                    form.find(".error").html('')
                    form.find('input').removeClass('is-invalid');
                    form.find('select').removeClass('is-invalid');
                    form.find('textarea').removeClass('is-invalid');
                    form.find('input').addClass('is-valid');
                    form.find('select').addClass('is-valid');
                    form.find('textarea').addClass('is-valid');
                    form.find(".submit-button").html(old_content).attr('disabled', false)
                    if (response.status != 'success') {
                        if (response.hasOwnProperty('input')) {
                            form.find('error_' + response.input).append(`<div class="mt-5 text-danger">${response.msg}</div>`);
                            $('.form input[name^=' + response.input + ']' + '.form select[name^=' + response.input + ']' + '.form textarea[name^=' + response.input + ']').addClass('is-invalid')
                        } else {

                            if(response.key != 'unauthorized'){
                                Swal.fire({
                                    position: 'top-start',
                                    icon: 'error',
                                    title: response.msg,
                                    showConfirmButton: false,
                                    timer: 1500,
                                    confirmButtonClass: 'btn btn-primary',
                                    buttonsStyling: false,
                                })
                            }
                        }
                    } else {
                        Swal.fire({
                            position: 'top-start',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        })

                    }

                    if (response.hasOwnProperty('url')) {
                        setTimeout(function () {
                            window.location.replace(response.url)
                        }, 3000);
                    }
                },
                error: function (xhr) {

                    form.find('.text-danger').remove();
                    form.find(".error_show").html('');
                    form.find('input').removeClass('is-invalid');
                    form.find('select').removeClass('is-invalid');
                    form.find('textarea').removeClass('is-invalid');

                    form.find('input').addClass('is-valid');
                    form.find('select').addClass('is-valid');
                    form.find('textarea').addClass('is-valid');
                    form.find(".submit-button").html(old_content).attr('disabled', false)

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
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'error',
                                    title: `${value}`,
                                    showConfirmButton: false,
                                    timer: 3000,
                                    confirmButtonClass: 'btn btn-primary',
                                    buttonsStyling: false,
                                })
                            }

                            form.find('.error_' + key).append(`<div class="text-danger d-block">${value}</div>`);
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


