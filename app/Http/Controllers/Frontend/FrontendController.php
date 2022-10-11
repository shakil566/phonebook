<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PhoneBook;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $targetArr = PhoneBook::orderBy('id', 'asc')->get();
        return view('frontend.index')->with(compact('targetArr'));
    }
}
