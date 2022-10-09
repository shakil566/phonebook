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
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="phone_number">Phone Number :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            {!! Form::text('phone_number', null, ['id' => 'phoneNumber', 'class' => 'form-control']) !!}
                                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="email">Email :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control']) !!}
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
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
@stop
