<div class="modal fade" id="new_service_modal" tabindex="-1" role="dialog" aria-labelledby="new_service_modal_label" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <div class="modal-title">

                    <h2 class="">Add New Service</h2>

                </div>
            </div>

            <div class="modal-body">

                <form class="" action="{{ action('ServiceController@store') }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="md-form">

                        <input class="form-control" type="text" name="type" value="{{ old('type') }}" />

                        <label for="type">Service Type</label>

                        @if ($errors->has('type'))
                            <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
                    </div>

                    <div class="md-form">

                        <textarea class="md-textarea form-control" name="description" id="description">{{ old('description') }}</textarea>

                        <label for="description">Service Description</label>

                        @if ($errors->has('description'))
                            <span class="text-danger">Description cannot be empty</span>
                        @endif
                    </div>

                    <div class="md-form d-flex justify-content-between">
                        <button class='btn btn-primary' type='submit'>Add New Service</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>