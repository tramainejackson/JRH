<!-- Modal -->
<div class="modal fade" id="remove_tenant_modal" role="dialog" aria-hidden="true" tabindex="1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Remove Tenant</h3>
                <button type="button" class="close dismissProperyMedia" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <div class="mb-3">
                    <h5 class="red-text text-center">This contact will no longer be listed as the tenant for this property if you continue</h5>
                </div>
                <div class="card testimonial-card">
                    <div class="card-up blue-gradient"></div>
                    <div class="avatar mx-auto white">
                        <img src="{{ asset($tenant->image ? str_ireplace('public', 'storage', $tenant->image->path) : 'images/empty_face.jpg') }}" class="rounded-circle" />
                    </div>
                    <div class="card-body testimonial-body">
                        <!-- Name -->
                        <div class="card-title">
                            <h2>{{ $tenant->full_name() }}</h2>
                        </div>
                        <hr/>
                        {!! $tenant->email != null ? '<p class="">E: ' . $tenant->email .'</p>' : '' !!}
                        {!! $tenant->phone != null ? '<p class="">P: ' . $tenant->phone .'</p>' : '' !!}
                    </div>
                </div>
                {!! Form::model($property, ['action' => ['PropertyController@remove_tenant',  $property->id], 'method' => 'POST']) !!}
                <div class="form-group">

                    <button class="btn btn-danger btn-block mt-4" type="button">Remove Tenant</button>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>