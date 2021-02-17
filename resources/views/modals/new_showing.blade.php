<!-- Modal -->
<div class="modal fade" id="new_showing_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
    <div class="modal-dialog modal-lg" role="document">

        <form class="" action="{{ action('CalendarController@store') }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('POST') }}

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Showing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-row" id="">
                        <!-- Material input -->
                        <div class="md-form col-6 input-with-post-icon datepicker">
                            <input type="text" class='form-control' name="new_datetimepicker" id='new_datetimepicker' />
                            <label for="new_datetimepicker">Show Date</label>

                            <i class="fas fa-calendar input-prefix" tabindex=0></i>
                        </div>

                        <!-- Material input -->
                        <div class="md-form col-6 input-with-post-icon timepicker" twelvehour="true">
                            <input type="text" class="form-control" name="new_timepicker" id="new_timepicker" />
                            <label for="new_timepicker">Show Time</label>

                            <i class="far fa-clock input-prefix"></i>
                        </div>
                    </div>

                    <!-- Material input -->
                    <div class="md-form">
                        <textarea type="text" class="form-control md-textarea" name="new_show_instructions" id="new_show_instructions" placeholder="Enter Showing Instructions"></textarea>
                        <label for="new_show_instructions">Show Instructions</label>
                    </div>

                    <div class="md-form hidden">
                        <select class="mdb-select colorful-select dropdown-primary" name="new_property_showing" id="new_property_showing" searchable="Search here.." required>
                            <option value="blank" disabled selected>Select a Property</option>

                            @foreach($allProperties as $eachProperty)
                                <option value="{{ $eachProperty->id }}" class="rounded-circle" {{ $eachProperty->active != 'Y' ? 'disabled' : '' }}>{{ $eachProperty->address }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="btn-save btn btn-primary btn-sm">Save</button>
                    </div>
                </div>

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12 py-4 d-flex align-items-center justify-content-between">

                            <button type="submit" class="btn btn-mdb-color saveNewShowing disabled">Save Showing</button>
                            <button type="button" class="btn btn-deep-orange" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>