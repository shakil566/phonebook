<?php

namespace App\Http\Controllers;

use App\Models\PhoneBook;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalContact = count(PhoneBook::all());
        $totalFavouriteContact =count( PhoneBook::where('favourite','1')->get());

        return view('admin.dashboard',compact('totalContact','totalFavouriteContact'));
    }
}
