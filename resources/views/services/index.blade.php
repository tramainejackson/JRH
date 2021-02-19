@extends('layouts.app')

@section('content')
    <div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center servicesJumbotron">
        <div class="container-fluid py-5">
            <h2 class="py-5 text-white text-center display-4">Jackson Rental Homes Services.</h2>
        </div>
    </div>

    <div class="container-fluid">

        @if($services->isNotEmpty())

            <div class="row">

                <div class="col-12 text-center mx-auto">

                    <div class="container-fluid">
                        <button type="button" class="btn btn-success d-block d-sm-inline" data-toggle="modal" data-target="#new_service_modal">Add New Service</button>
                        <p class="my-3"><i>Total Services:</i>&nbsp;<span class="text-muted">{{ $services->count() }}</span></p>
                    </div>

                    <div class="container-fluid">

                        <form id="search-form" method="POST" action="{{ action('ContactController@search') }}">

                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            <div class="form-row" id="">
                                <div class="md-form input-group col-12 col-md-6 mx-auto mb-5">
                                    <input type="text" name="search" class="form-control valueSearch" value="{{ request()->query('search') ? request()->query('search') : '' }}" placeholder="Services Search" disabled />

                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-success searchBtn" type="button" onclick="event.preventDefault(); document.getElementById('search-form').submit();" disabled="disabled">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="col-12 mx-auto">

                    <div class="container-fluid">

                        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 my-4">

                            @foreach($services as $service)

                                <div class="col py-2 propertyList">

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

                                            <a href="#" data-value="{{ $service->id }}" class="btn btn-outline-white btn-rounded editServiceBtn" data-toggle="modal" data-target="#edit_service_modal">Edit<i class="fas fa-edit ml-2"></i></a>
                                            <a href="#" data-value="{{ $service->id }}" class="btn btn-outline-red btn-rounded deleteServiceBtn" data-toggle="modal" data-target="#modalConfirmDelete">Delete<i class="fas fa-trash-alt ml-2"></i></a>

                                        </div>
                                        <!-- Content -->
                                    </div>
                                </div>

                            @endforeach

                        </div>
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

        @include('modals.new_service')
        @include('modals.edit_service')
        @include('modals.delete_service')

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
            var port = window.location.port != null ? ':' + window.location.port : '';
            var protocol = window.location.protocol;
            var host = window.location.hostname;
            var service = $(this).attr('data-value');
            var action = protocol + '//' + host + port + '/services/' + service;

            $('#edit_service_modal').find('input[name="type"] textarea').val('');

            $('#edit_service_modal').find('input[name="type"]')
                .val($(this).parent().find('.serviceType').text().trim())
                .next()
                .addClass('active');
            $('#edit_service_modal').find('textarea')
                .val($(this).parent().find('.serviceDesc').text().trim())
                .next()
                .addClass('active');

            $('#edit_service_modal').find('form').attr('action', action);
        });

        $('body').on('click', '.deleteServiceBtn', function() {
            var port = window.location.port != null ? ':' + window.location.port : '';
            var protocol = window.location.protocol;
            var host = window.location.hostname;
            var service = $(this).attr('data-value');
            var action = protocol + '//' + host + port + '/services/' + service;

            $('#modalConfirmDelete').find('form').attr('action', action);
        });
    </script>

@endsection