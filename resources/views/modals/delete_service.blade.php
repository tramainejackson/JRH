<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirm_delete_modal_label"
     aria-hidden="true">

    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">

        <!--Content-->
        <div class="modal-content text-center">

            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Are you sure you want to delete this service?</p>
            </div>

            <!--Body-->
            <div class="modal-body">

                <i class="fas fa-times fa-4x animated rotateIn"></i>

            </div>

            <form class="" action="{{ action('ServiceController@destroy', 0) }}" method="POST">

                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <!--Footer-->
                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-outline-danger">Yes</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
        <!--/.Content-->
    </div>
</div>