<?php $v4 = 'nc' . uniqid(); ?>

<div class="form-group">
    <div class="col-md-6">
        {!! Form::text('phone_number[' . $v4 . ']', null, [
            'id' => 'phone_' . $v4,
            'class' => 'form-control',
            'data-key' => $v4,
            'placeholder' => 'Enter phone number', 'required'
        ]) !!}
    </div>
    <div class="col-md-2">
        <button class="btn btn-inline btn-danger remove-phone tooltips btn-sm" data-key="{{ $v4 }}"
            data-placement="right" title="Remove this field" type="button">
            <i class="fa fa-times"></i>
        </button>
    </div>
</div>
