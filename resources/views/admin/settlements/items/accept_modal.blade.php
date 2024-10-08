<div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Settlement_request')}}</h5>
                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <form class="formAjax" enctype="multipart/form-data" action="{{route('admin.settlements.changeStatus')}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="hidden" name="id" class="settlement_id" value="">
                    <input type="hidden" id="status" name="status" value="accepted">
                    <div class="form-group text-center imageBlock">
                        <label for="recipient-name" class="col-form-label">{{__('admin.receipt_photo')}}</label>
                        <div class="col-12">
                            <x-admin.inputs.image  name="image"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label for="message-text" class="col-form-label">{{__('admin.settlement_amount')}}</label>
                        <div class="form-control" id="amount"></div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn rounded-pill btn-success submit-button">{{__('admin.confirm')}}</button>
                    <div class="btn rounded-pill btn-success d-none uploadProgress"><i class="fas fa-spinner"></i></div>
                    <a type="button" class="btn rounded-pill btn-secondary m-2" data-bs-dismiss="modal">{{__('admin.close')}}</a>
                </div>
            </form>
        </div>
    </div>
</div>