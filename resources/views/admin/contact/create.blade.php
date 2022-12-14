@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Add New Contact</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                            'group' => 'form',
                            'url' => '/contact',
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="row margin-left-40">
                                <div class="col-md-offset-1 col-md-12">

                                    <div class="row  margin-bottom-10">
                                        <label class="control-label col-md-2" for="name">Name :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-4">
                                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <?php
                                        $v4 = 'c' . uniqid();
                                        ?>
                                        <div class="row  margin-bottom-10">
                                            <label class="control-label col-md-2" for="phone">Phone Number :<span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-md-4">
                                                {!! Form::text('phone_number[' . $v4 . ']', null, [
                                                    'id' => 'phone_' . $v4,
                                                    'class' => 'form-control',
                                                    'data-key' => $v4,
                                                    'placeholder' => 'Enter phone number', 'required',
                                                ]) !!}
                                                <span class="text-danger">{{ $errors->first('phone_number[' . $v4 . ']') }}</span>
                                            </div>
                                            <div class="col-md-2">
                                                <button
                                                    class="btn btn-inline btn-success add-another-phone tooltips btn-sm"
                                                    data-key="{{ $v4 }}" data-placement="right"
                                                    title="Add another phone" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                    <div id="newPhoneField"></div>

                                    <?php
                                        $v4 = 'c' . uniqid();
                                        ?>
                                        <div class="row margin-bottom-10">
                                            <label class="control-label col-md-2" for="email">Email :<span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-md-4">
                                                {!! Form::email('email[' . $v4 . ']', null, [
                                                    'id' => 'email_' . $v4,
                                                    'class' => 'form-control',
                                                    'data-key' => $v4,
                                                    'placeholder' => 'Enter valid email address', 'required'
                                                ]) !!}
                                            </div>
                                            <div class="col-md-2">
                                                <button
                                                    class="btn btn-inline btn-success add-another-email tooltips btn-sm"
                                                    data-key="{{ $v4 }}" data-placement="right"
                                                    title="Add another email" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                    <div id="newEmailField"></div>

                                    <div class="row margin-bottom-10">
                                        <label class="control-label col-md-2" for="image">Image :<span
                                            class="text-danger"> *</span></label>
                                        <div class="col-md-6">
                                            {!! Form::file('image', ['id' => 'image']) !!}
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-actions"> --}}
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button class="btn btn-circle green" type="submit">
                                            <i class="fa fa-check"></i>SUBMIT
                                        </button>
                                        <a href="{{ URL::to('/contact') }}" class="btn btn-circle btn-outline grey-salsa">
                                            CANCEL</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            //add new contact row
            var options = {
                tapToDismiss: true,
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null,
            };

            $(".add-another-email").on("click", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to('contact/addMultipleEmail') }}",
                    type: "POST",
                    dataType: 'json', // what to expect back from the PHP script, if anything
                    data: {},

                    success: function(res) {
                        $("#newEmailField").append(res.html);

                        $(".tooltips").tooltip();

                    },
                });
            });


            //remove row
            $(document).on('click', '.remove-email', function() {
                $(this).parent().parent().remove();

                return false;
            });



            $(".add-another-phone").on("click", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to('contact/addMultiplePhone') }}",
                    type: "POST",
                    dataType: 'json', // what to expect back from the PHP script, if anything
                    data: {},

                    success: function(res) {
                        $("#newPhoneField").append(res.html);

                        $(".tooltips").tooltip();

                    },
                });
            });


            //remove row
            $(document).on('click', '.remove-phone', function() {
                $(this).parent().parent().remove();

                return false;
            });


        });

    </script>
@stop
