<script>
    $(document).on('click' , '.delete-row', function (e) {
        e.preventDefault()
        Swal.fire({
            title: "{{__('admin.do_you_want_to_continue')}}",
            text: "{{__('admin.you_will_not_be_able_to_revert_this_action')}}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{__('admin.confirm')}}',
            cancelButtonText: '{{__('admin.cancel')}}',
            customClass: {
                confirmButton: 'btn btn-danger me-3',
                cancelButton: 'btn btn-label-primary'
            },
            buttonsStyling: false
            }).then( (result) => {
            if (result.value) {
                $.ajax({
                    type: "delete",
                    url: $(this).data('url'),
                    data: {},
                    dataType: "json",
                    success:  (response) => {
                        toastr.success('{{__('admin.deleted_successfully')}}');

                        getData(searchArray() )
                        // toastr.error()
                        // $('.data-list-view').DataTable().row($(this).closest('td').parent('tr')).remove().draw();
                    }
                });
            }
        })
    });
</script>