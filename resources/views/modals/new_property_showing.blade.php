<!-- Modal -->
<div class="modal fade" id="showing_modal" role="dialog" aria-hidden="true" tabindex="1">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Add A Showing</h3>
                <button type="button" class="close dismissProperyMedia" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-dark">

                <div class="">
                    <h3 class="text-muted text-center">Showing Information</h3>
                </div>

                <form class="" action="{{ action('CalendarController@store') }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-row">
                        <div class="md-form col-6 input-with-post-icon datepicker">
                            <input type="text" class='form-control' name="new_datetimepicker" id='new_datetimepicker' required />
                            <label for="new_datetimepicker">Show Date</label>

                            <i class="fas fa-calendar input-prefix" tabindex=0></i>
                        </div>

                        <div class="md-form col-6 input-with-post-icon timepicker" twelvehour="true">
                            <input type="text" class="form-control" name="new_timepicker" id="new_timepicker" />
                            <label for="new_timepicker">Show Time</label>

                            <i class="far fa-clock input-prefix"></i>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col md-form">
                            <textarea type="text" id="new_show_instructions" name="new_show_instructions" class="form-control md-textarea" placeholder="" required>{{ old('showing_instructions') }}</textarea>
                            <label for="new_show_instructions" class="">Showing Instructions</label>
                        </div>

                        <input type="number" class="hide" name="new_property_showing" value="{{ $property->id }}" hidden required>
                    </div>

                    <button class="btn-block btn btn-primary mt-4" type="submit">Create Showing</button>

                </form>
            </div>
        </div>
    </div>
</div>