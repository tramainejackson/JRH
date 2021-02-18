<!-- Modal -->
<div class="modal fade" id="delete_modal" role="dialog" aria-hidden="true" tabindex="1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-dark">
                <div class="" id="">
                    <p class="note note-danger">This will remove all images, videos, documents, showings, requirements, and tenants associates with this property</p>
                </div>

                {!! Form::model($property, ['action' => ['PropertyController@destroy', $property->id], 'method' => 'DELETE']) !!}
                <div class="form-group">
                    <label class="form-control-label">Address</label>
                    <input type="email" class="form-control" value="{{ $property->address }}" disabled />
                </div>

                <div class="form-group">
                    <label class="form-control-label">City</label>
                    <input type="text" class="form-control" value="{{ $property->city }}" disabled />
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                        <label class="form-control-label">State</label>
                        <input type="text" class="form-control" value="{{ $property->state }}" disabled />
                    </div>
                    <div class="form-group col-6">
                        <label class="form-control-label">Zip</label>
                        <input type="text" class="form-control" value="{{ $property->zip }}" disabled />
                    </div>
                </div>

                <div class="form-group align-items-center d-flex justify-content-center">

                    <button class="btn btn-danger" type="submit">Delete</button>

                    <button class="btn btn-warning cancelBtn" type="button">Cancel</button>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>