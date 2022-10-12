@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">

                    <div class="card-header card-header-primary">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title mt-0">Favorite Contact List

                                    <a class="btn btn-default btn-sm create-new" href="{{ URL::to('contact/create') }}"> Add
                                        New
                                        <i class="fa fa-plus create-new"></i>
                                    </a>
                                </h4>
                            </div>
                            <div class="col-md-4">
                                @include('layouts.include.flash')
                            </div>
                        </div>

                    </div>
                    <!-- Begin Filter-->
                    {!! Form::open(['group' => 'form', 'url' => 'contact/filter', 'class' => 'form-horizontal']) !!}
                    <div class="row margin-top-10">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="card-title col-md-4 bold" for="search">Search</label>
                                <div class="col-md-8">
                                    {!! Form::text('search', Request::get('search'), [
                                        'class' => 'form-control tooltips',
                                        'title' => 'Name',
                                        'placeholder' => 'Name',
                                        'list' => 'search',
                                        'autocomplete' => 'off',
                                    ]) !!}
                                    <datalist id="search">
                                        @if (!empty($nameArr))
                                            @foreach ($nameArr as $name)
                                                <option value="{{ $name->name }}"></option>
                                            @endforeach
                                        @endif
                                    </datalist>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form">
                                <button type="submit" class="btn btn-md green btn-outline filter-submit margin-bottom-20">
                                    <i class="fa fa-search"></i> Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <!-- End Filter -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="center">
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Phone Number</th>
                                        <th class="text-center">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($targetArr))
                                        <?php
                                        $sl = 0;
                                        ?>
                                        @foreach ($targetArr as $target)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>{{ $target->name }}</td>
                                                <td class="vcenter text-center" width="40px">
                                                    @if (!empty($target->image))
                                                        <img width="70px" height="70px"
                                                            src="{{ asset('/uploads/contactimage/' . $target->image) }}"
                                                            alt="{{ $target->name }}" class="border-radius-50">
                                                    @else
                                                        <img width="70px" height="70px"
                                                            src="{{ URL::to('/') }}/img/no_image.png"
                                                            alt="{{ $target->name }}" class="border-radius-50">
                                                    @endif
                                                </td>

                                                <?php

                                                $jsonDecodedPhoneNumber = $jsonDecodedEmail = [];
                                                $jsonDecodedPhoneNumber = json_decode($target->phone_number, true);
                                                $jsonDecodedEmail = json_decode($target->email, true);
                                                ?>

                                                <td class="text-center">
                                                    @if (!empty($jsonDecodedPhoneNumber))
                                                        @foreach ($jsonDecodedPhoneNumber as $item)
                                                        {!! ($item.'<br>') ?? '' !!}
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if (!empty($jsonDecodedEmail))
                                                        @foreach ($jsonDecodedEmail as $item)
                                                        {!! ($item.'<br>') ?? '' !!}
                                                        @endforeach
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">No Contact Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@stop
