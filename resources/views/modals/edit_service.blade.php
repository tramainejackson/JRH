<div class="modal fade" id="edit_service_modal" tabindex="-1" role="dialog" aria-labelledby="edit_service_modal_label"
     aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <div class="modal-title">

                    <h2 class="">Edit Service</h2>

                </div>
            </div>

            <div class="modal-body">

                <form class="" action="{{ action('ServiceController@update', 0) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="md-form">

                        <input class="form-control" type="text" name="type" value="" />

                        <label for="type">Service Type</label>

                        @if ($errors->has('type'))
                            <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
                    </div>

                    <div class="md-form">

                        <textarea class="md-textarea form-control" name="description" id="description"></textarea>

                        <label for="description">Service Description</label>

                        @if ($errors->has('description'))
                            <span class="text-danger">Description cannot be empty</span>
                        @endif
                    </div>

                    <div class="md-form d-flex justify-content-between">
                        <button type='submit' class='btn btn-primary'>Save Service</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>