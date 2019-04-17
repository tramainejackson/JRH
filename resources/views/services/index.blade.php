@extends('layouts.app')

@section('content')
    <div id="content_container" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center contactsJumbotron">
        <div class="container-fluid py-5">
            <h2 class="py-5 text-white display-4">Growth and development of our communities are the core of our pursuit.</h2>
        </div>
    </div>

    <div class="container-fluid">

        @if(session('status'))
            <h2 class="flashMessage">{{ session('status') }}</h2>
        @endif

            @if($services->isNotEmpty())

                <div class="row">

                    <div class="col-4 text-center mb-4 mx-auto">

                        <div class="container-fluid">

                            <button type="button" class="btn btn-success d-block d-sm-inline" data-toggle="modal" data-target="#new_service_modal">Add New Service</button>

                            <p class="my-3"><i>Total Services:</i>&nbsp;<span class="text-muted">{{ $services->count() }}</span></p>
                        </div>

                        <div class="container-fluid">

                            {!! Form::open(['action' => 'ContactController@search', 'method' => 'POST', 'id' => 'search-form']) !!}

                                <div class="md-form input-group">
                                    <input type="text" name="search" class="form-control valueSearch" value="{{ request()->query('search') ? request()->query('search') : '' }}" placeholder="Services Search" />

                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-success searchBtn" type="button" onclick="event.preventDefault(); document.getElementById('search-form').submit();">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="col-8" id="">

                        <div class="row" id="">

                            @foreach($services as $service)

                                <div class="card blue-gradient py-2 m-2 col" id="">

                                    <!-- Content -->
                                    <div class="card-body text-white text-center">

                                        <h2 class="mb-4 font-weight-bold text-underline serviceType">{{ $service->type }}</h2>

                                        @if($service->description != null)
                                            <p class="mb-4 serviceDesc">
                                                <strong>{{ $service->description }}.</strong>
                                            </p>
                                        @else
                                            <p class="mb-4 serviceDesc">
                                                <strong>No Additional Information Added.</strong>
                                            </p>
                                        @endif

                                        <a href="#" data-value="{{ $service->id }}" class="btn btn-outline-white btn-rounded editServiceBtn">Edit<i class="fas fa-edit ml-2"></i></a>

                                    </div>
                                    <!-- Content -->

                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            @else

                <div class="row" id="">

                    <div class="col">

                        <h2 class="text-center">You haven't added any services yet</h2>
                        <h4 class="text-center">Click <a href="#" class="" data-toggle="modal" data-target="#new_service_modal">here</a> to create your first service.</h4>
                    </div>
                </div>

            @endif

        <div class="modal fade" id="new_service_modal" tabindex="-1" role="dialog" aria-labelledby="new_service_modal_label"
             aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <div class="modal-title">

                            <h2 class="">Add New Service</h2>

                        </div>
                    </div>

                    <div class="modal-body">

                        {!! Form::open(['action' => ['ServiceController@store'], 'method' => 'POST' ]) !!}

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

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

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

                        {!! Form::open(['action' => ['ServiceController@edit', 2], 'method' => 'PATCH' ]) !!}

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
                                <button class='btn btn-primary' type='submit'>Save Service</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    
@endsection

@section('addt_script')

    @if ($errors->has('type') || $errors->has('description'))

        <script type="text/javascript">
            $('#new_service_modal').modal('show');
        </script>

    @endif

    <script type="text/javascript">
        $('body').on('click', '.editServiceBtn', function() {
            var dot = $('#edit_service_modal').find('form').attr('action').indexOf('services');

            $('#edit_service_modal').find('input[name="type"] textarea').val('');

            $('#edit_service_modal').find('input[name="type"]')
                .val($(this).parent().find('.serviceType').text().trim())
                .next()
                .addClass('active');
            $('#edit_service_modal').find('textarea')
                .val($(this).parent().find('.serviceDesc').text().trim())
                .next()
                .addClass('active');

            // console.log($('#edit_service_modal').find('form').attr('action').slice(Number(dot)));
            $('#edit_service_modal').find('form').attr('action').slice(Number(dot));
            $('#edit_service_modal').modal('show');
        });
    </script>

@endsection