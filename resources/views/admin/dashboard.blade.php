@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Hello {{ Auth::user()->name }}</h1>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <a href="contact/">
                            <div class="card-icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </a>
                        <p class="card-category">Total Contact</p>
                        <h3 class="card-title">{{ $totalContact ?? '' }}
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger"></i>
                            <a href="javascript:;"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <a href="contact/favourite">
                            <div class="card-icon">
                                <i class="fa fa-bookmark"></i>
                            </div>
                        </a>
                        <p class="card-category">Favorite Contact</p>
                        <h3 class="card-title">{{ $totalFavouriteContact ?? '' }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
