<?php $v4 = 'nc' . uniqid(); ?>

<div class="row margin-bottom-10">
    <label class="control-label col-md-2" for="email"></label>
    <div class="col-md-4">
        {!! Form::email('email[' . $v4 . ']', null, [
            'id' => 'email_' . $v4,
            'class' => 'form-control',
            'data-key' => $v4,
            'placeholder' => 'Enter valid email address', 'required'
        ]) !!}
    </div>
    <div class="col-md-2">
        <button class="btn btn-inline btn-danger remove-email tooltips btn-sm" data-key="{{ $v4 }}"
            data-placement="right" title="Remove this field" type="button">
            <i class="fa fa-times"></i>
        </button>
    </div>
</div>
