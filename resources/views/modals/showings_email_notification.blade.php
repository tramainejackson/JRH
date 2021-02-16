<!-- Modal -->
<div class="modal fade" id="notiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
    <div class="modal-dialog modal-lg" role="document">

        <form class="send_calendar_notification_form" action="{{ action('PropertyController@calendar_notification') }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('POST') }}

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Send Email Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <h2 class="text-center">Here is a list of the properties you have as being shown on this date <span class="text-center propShowingDate"></span></h2>
                    </div>

                    <div class="formatShowings p-4"></div>

                    <div class="md-form hidden">
                        <select class="mdb-select colorful-select dropdown-primary" name="send_to[]" searchable="Search here.." multiple>
                            <option value="" disabled selected>Choose recipients</option>
                            @foreach($allContacts as $eachContact)
                                <option value="{{ $eachContact->id }}" data-icon="{{ $eachContact->image ? str_ireplace('public', 'storage', $eachContact->image->path) : asset('/images/empty_face.jpg') }}" class="rounded-circle" {{ $eachContact->email == null ? 'disabled' : '' }}>{{ $eachContact->full_name() }}{{ $eachContact->email == null ? ' - no email listed' : '' }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn-save btn btn-primary btn-sm">Save</button>
                    </div>

                    <div class="row selectRecipients">
                        <div class="col-12 d-flex align-items-center justify-content-around">

                            <button type="button" class="btn btn-mdb-color selectIndContact">Selection Inidividual Contacts</button>
                            <button type="button" class="btn btn-mdb-color selectAllContact">Select All Contacts</button>

                        </div>
                    </div>
                </div>

                <div class="container-fluid" style="border-top: 1px solid #e9ecef;">

                    <div class="row">
                        <div class="col-12 py-4 d-flex align-items-center justify-content-between">

                            <button type="submit" class="btn btn-mdb-color disabled sendNotifiBtn">Send Notification</button>
                            <button type="button" class="btn btn-deep-orange" data-dismiss="modal">Close</button>

                            <input type="text" name="all_contacts" class="" hidden />
                            <input type="date" name="showing_date" class="propShowingDateInput" hidden />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>