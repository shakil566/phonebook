@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Update Contact</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($target, [
                            'route' => ['contact.update', $target->id],
                            'method' => 'POST',
                            'class' => 'form-horizontal',
                            'files' => true,
                        ]) !!}
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-12">

                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="name">Name :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>

                                    @if (!empty($phoneArr))
                                        <?php $pI = 0; ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 " for="phone">Phone Number :<span
                                                    class="text-danger"> *</span></label>
                                            @foreach ($phoneArr as $cKey => $cinfo)
                                                <div class="col-md-7">
                                                    {!! Form::text('phone_number[' . $cKey . ']', !empty($cinfo) ? $cinfo : null, [
                                                        'id' => 'phone_' . $cKey,
                                                        'class' => 'form-control',
                                                        'data-key' => $cKey,
                                                        'placeholder' => 'Enter phone number',
                                                    ]) !!}
                                                </div>
                                                <div class="col-md-1">
                                                    @if ($pI == 0)
                                                        <button
                                                            class="btn btn-inline btn-success add-another-phone tooltips btn-sm"
                                                            data-key="{{ $cKey }}" data-placement="right"
                                                            title="Add another phone number" type="button">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    @else
                                                        <button
                                                            class="btn btn-inline btn-danger remove-phone tooltips btn-sm"
                                                            data-key="{{ $cKey }}" data-placement="right"
                                                            title="Remove this field" type="button">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                <?php $pI++; ?>
                                            @endforeach
                                        </div>
                                    @else
                                        <?php
                                        $v4 = 'c' . uniqid();
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="phone">Phone Number :<span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-md-7">
                                                {!! Form::text('phone_number[' . $v4 . ']', null, [
                                                    'id' => 'phone_' . $v4,
                                                    'class' => 'form-control',
                                                    'data-key' => $v4,
                                                    'placeholder' => 'Enter phone number',
                                                ]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-inline btn-success add-another-phone tooltips btn-sm"
                                                    data-key="{{ $v4 }}" data-placement="right"
                                                    title="Add another phone" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    <div id="newPhoneField"></div>


                                    @if (!empty($emailArr))
                                        <?php $cI = 0; ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 " for="email">Email :<span
                                                    class="text-danger"> *</span></label>
                                            @foreach ($emailArr as $cKey => $cinfo)
                                                <div class="col-md-7">
                                                    {!! Form::email('email[' . $cKey . ']', !empty($cinfo) ? $cinfo : null, [
                                                        'id' => 'email_' . $cKey,
                                                        'class' => 'form-control',
                                                        'data-key' => $cKey,
                                                        'placeholder' => 'Enter valid email address',
                                                    ]) !!}
                                                </div>
                                                <div class="col-md-1">
                                                    @if ($cI == 0)
                                                        <button
                                                            class="btn btn-inline btn-success add-another-email tooltips btn-sm"
                                                            data-key="{{ $cKey }}" data-placement="right"
                                                            title="Add another email" type="button">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    @else
                                                        <button
                                                            class="btn btn-inline btn-danger remove-email tooltips btn-sm"
                                                            data-key="{{ $cKey }}" data-placement="right"
                                                            title="Remove this field" type="button">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                <?php $cI++; ?>
                                            @endforeach
                                        </div>
                                    @else
                                        <?php
                                        $v4 = 'c' . uniqid();
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="email">Email :<span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-md-7">
                                                {!! Form::email('email[' . $v4 . ']', null, [
                                                    'id' => 'email_' . $v4,
                                                    'class' => 'form-control',
                                                    'data-key' => $v4,
                                                    'placeholder' => 'Enter valid email address',
                                                ]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-inline btn-success add-another-email tooltips btn-sm"
                                                    data-key="{{ $v4 }}" data-placement="right"
                                                    title="Add another email" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    <div id="newEmailField"></div>

                                    <div class="row margin-bottom-10">
                                        <div class="col-md-8">
                                            <label class="control-label col-md-4" for="image">Image :</label>
                                            {!! Form::file('image', ['id' => 'image']) !!}
                                            @if (!empty($target->image))
                                                <img width="40px" height="40px"
                                                    src="{{ asset('/uploads/contactimage/' . $target->image) }}"
                                                    alt="{{ $target->name }}" class="border-radius-50">
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button class="btn btn-circle green" type="submit">
                                            <i class="fa fa-check"></i>UPDATE
                                        </button>
                                        <a href="{{ URL::to('/contact') }}" class="btn btn-circle btn-outline grey-salsa">
                                            CANCEL</a>
                                    </div>
                                </div>
                            </div>
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
                        rearrangeSL('email');
                    },
                });
            });


            //remove row
            $(document).on('click', '.remove-email', function() {
                $(this).parent().parent().remove();
                rearrangeSL('email');
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
                        rearrangeSL('phone');
                    },
                });
            });


            //remove row
            $(document).on('click', '.remove-phone', function() {
                $(this).parent().parent().remove();
                rearrangeSL('phone');
                return false;
            });


        });
    </script>



@stop
