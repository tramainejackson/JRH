<!-- Modal -->
<div class="modal fade" id="property_media" role="dialog" aria-hidden="true" tabindex="1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Delete Property Media</h3>
                <button type="button" class="close dismissProperyMedia" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <div class="">
                    <h5 class="text-muted text-center">Are You Sure You Want To Remove These Items</h5>
                </div>
                {!! Form::open(['action' => 'PropertyImagesController@remove_images', 'method' => 'DELETE', 'class' => 'container-fluid']) !!}
                <div class="row"></div>

                <button class="btn-block btn btn-danger mt-4" type="submit">Remove Items</button>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>