<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <h1 class="header margin-bottom-10">ALL Contacts <a class="btn btn-primary btn-sm create-new" title="Go to Contact Management" target="_blank" href="{{ URL::to('contact') }}"> Add
        New
        <i class="fa fa-plus create-new"></i>
    </a></h1>
    <div class="row">
        @if (!empty($targetArr))
            <?php
            $sl = 0;
            ?>
            @foreach ($targetArr as $target)
                <?php

                $jsonDecodedPhoneNumber = $jsonDecodedEmail = [];
                $jsonDecodedPhoneNumber = json_decode($target->phone_number, true);
                $jsonDecodedEmail = json_decode($target->email, true);
                ?>
                <div class="col-md-3">
                    <div class="contact-box center-version">
                        <a>
                            @if (!empty($target->image))
                                <img alt="image" class="img-circle"
                                    src="{{ asset('/uploads/contactimage/' . $target->image) }}"
                                    alt="{{ $target->name }}">

                            @else
                                <img alt="image" class="img-circle" src="{{ URL::to('/') }}/img/no_image.png"
                                    alt="Not available">
                            @endif

                            <h3 class="m-b-xs"><strong class="name" >{{ $target->name }}
                                @if ($target->favourite == '1')
                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                        @else
                                @endif
                            </strong></h3>

                            <address class="m-t-md">
                                <strong><i class="fa fa-envelope"></i> Email </strong><br>
                                @if (!empty($jsonDecodedEmail))
                                    @foreach ($jsonDecodedEmail as $item)
                                        {!! $item . '<br>' ?? '' !!}
                                    @endforeach
                                @endif
                                <br>
                                <strong><i class="fa fa-phone"></i> Phone </strong><br>
                                @if (!empty($jsonDecodedPhoneNumber))
                                    @foreach ($jsonDecodedPhoneNumber as $item)
                                        {!! $item . '<br>' ?? '' !!}
                                    @endforeach
                                @endif
                            </address>

                        </a>

                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-3">
                <div class="contact-box center-version">
                    <a>
                        <img alt="image" class="img-circle" src="{{ URL::to('/') }}/img/no_image.png"
                            alt="Not availabe">
                        <h3 class="m-b-xs"><strong class="name">N/A</strong></h3>

                        <address class="m-t-md">
                            <strong><i class="fa fa-envelope"></i>Email </strong>
                            N/A
                            <br>
                            <strong><i class="fa fa-envelope"></i>Phone </strong>
                            N/A
                        </address>

                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
