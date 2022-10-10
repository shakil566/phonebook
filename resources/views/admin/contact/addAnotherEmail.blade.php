<?php $v4 = 'nc' . uniqid(); ?>

<div class="form-group">
    <div class="col-md-6">
        {!! Form::text('email[' . $v4 . ']', null, [
            'id' => 'email_' . $v4,
            'class' => 'form-control',
            'data-key' => $v4,
            'placeholder' => 'Enter valid email address',
        ]) !!}
    </div>
    <div class="col-md-2">
        <button class="btn btn-inline btn-danger remove-email tooltips btn-xs" data-key="{{ $v4 }}"
            data-placement="right" title="Remove this field" type="button">
            <i class="fa fa-times"></i>
        </button>
    </div>
</div>
