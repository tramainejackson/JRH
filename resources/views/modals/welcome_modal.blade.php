<div class="modal fade" id="welcome_modal">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            @if($settings->welcome_media == null)

                <div class="modal-header flex-column">
                    <h2 class="d-block" style=""><u>Add To Our Contacts</u></h2>
                    <h4 class="d-block" style="">If you would like to be contacted when we have new rentals that fits you, please fill out the following information and we will reach out to you</h4>
                </div>

                <div class="modal-body text-dark">

                    {!! Form::open([ 'action' => 'ContactController@store', 'class' => '', 'id' => 'contact_add',]) !!}

                    <div class="form-row">
                        <div class="md-form col-6">
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="Enter First Name" />
                            <label for="first_name">First Name</label>

                            @if ($errors->has('first_name'))
                                <span class="text-danger">First Name cannot be empty</span>
                            @endif
                        </div>

                        <div class="md-form col-6">
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Enter Last Name" />
                            <label for="last_name">Last Name</label>

                            @if ($errors->has('last_name'))
                                <span class="text-danger">Last Name cannot be empty</span>
                            @endif
                        </div>
                    </div>

                    <div class="md-form">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder='Enter Email Address' />
                        <label for="email">Email Address</label>

                        @if ($errors->has('email'))
                            <span class="text-danger">Email Address Cannot Be Empty</span>
                        @endif
                    </div>

                    <div class="md-form">
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" max="10" placeholder='Enter Phone Number' />
                        <label for="phone">Phone Number</label>

                        @if ($errors->has('phone'))
                            <span class="text-danger">Phone Number Cannot Be Empty. Please add without spaces</span>
                        @endif
                    </div>

                    <div class="md-form">
                        <input type="number" name="family_size" class="form-control" value="{{ old('family_size') }}" min='1' placeholder='Enter Family Size' />
                        <label for="family_size">Family Size</label>
                    </div>

                    <div class="md-form">

                        <button type="submit" class="form-control btn btn-primary btn-block">Add Me</button>

                    </div>

                    {!! Form::close() !!}
                </div>

            @else

                <div class="modal-header flex-column">
                    @if(substr_count($settings->welcome_media, 'image') > 0)
                        <div class="text-center">
                            <img class="img-fluid" src="{{ asset(str_ireplace('public', 'storage', $settings->welcome_media)) }}" />
                        </div>
                    @else
                        <div class="text-center">
                            <video loop controls poster="" preload="auto" muted>
                                <source src="{{ asset(str_ireplace('public', 'storage', $settings->welcome_media)) }}" />
                            </video>
                        </div>
                    @endif
                </div>

                @if($settings->welcome_content != null)
                    <div class="modal-body text-dark">
                        <h3 class="text-center">{{ $settings->welcome_content }}</h3>
                    </div>
                @endif

            @endif

            <div class="modal-footer">
                <button type="button" class="cancelBtn btn btn-warning text-center d-block d-sm-inline" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>