
<!-- Modal -->
<div  class="modal fade store" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
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
            <div class="modal-body text-center">
                {{__('admin.you_are_about_to_decline_the_settlement_request')}}
            </div>
            <form class="formAjax needs-validation" enctype="multipart/form-data" action="{{route('admin.settlements.changeStatus')}}" method="POST" novalidate>
                @csrf
                @method('PATCH')
                <div class="modal-footer justify-content-center">
                    <input type="hidden" name="id" class="settlement_id" value="">
                    <input type="hidden" id="status" name="status" value="rejected">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <div class="controls">
                                <x-admin.inputs.textarea name="rejected_reason"  label="{{__('admin.rejected_reason')}}"  required placeholder="{{__('admin.rejected_reason')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn rounded-pill btn-success submit-button">{{__('admin.confirm')}}</button>
                    <div class="btn rounded-pill btn-success d-none uploadProgress"><i class="fas fa-spinner"></i></div>
                    <a type="button" class="btn rounded-pill btn-secondary m-2" data-bs-dismiss="modal">{{__('admin.close')}}</a>

                </div>
            </form>
        </div>
    </div>
</div>