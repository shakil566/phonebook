<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhoneBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class PhoneBookController extends Controller
{
    public function index(Request $request)
    {

        $qpArr = $request->all();
        $targetArr = PhoneBook::orderBy('id', 'asc');
        $nameArr = PhoneBook::select('name')->orderBy('id', 'asc')->get();

        //begin filtering
        $searchText = $request->search;
        if (!empty($searchText)) {
            $targetArr->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $targetArr = $targetArr->paginate();

        return view('admin.contact.index')->with(compact('targetArr', 'qpArr', 'nameArr'));
    }

    public function create(Request $request)
    {
        $qpArr = $request->all();

        return view('admin.contact.create')->with(compact('qpArr'));
    }

    public function store(Request $request)
    {
        $qpArr = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:phone_books,name',
            'phone_number' => 'required',
            'email' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('contact/create')
                ->withInput()
                ->withErrors($validator);
        }

        $phoneArr = $request->phone_number;
        $emailArr = $request->email;

        $target = new PhoneBook;
        $target->name = $request->name;
        $target->phone_number = !empty($phoneArr) ? json_encode($phoneArr) : '';
        $target->email = !empty($emailArr) ? json_encode($emailArr) : '';

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $fullName = Auth::user()->id . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $path = "uploads/contactImage/";
            $img->move($path, $fullName);
            $target->image = $fullName;
        }
        // return $target;

        if ($target->save()) {
            Session::flash('success', 'Created Successfully');
            return redirect('/contact');
        } else {
            Session::flash('error', 'Could Not be Created');
            return redirect('/contact');
        }
    }

    public function edit(Request $request, $id)
    {
        $target = PhoneBook::find($id);
        $emailArr = !empty($target->email) ? json_decode($target->email, true) : [];
        $phoneArr = !empty($target->phone_number) ? json_decode($target->phone_number, true) : [];
        // return $emailArr;
        if (empty($target)) {
            Session::flash('error', 'Invalid dat Id');
            return redirect('contact');
        }


        $qpArr = $request->all();

        return view('admin.contact.edit')->with(compact('target', 'qpArr','emailArr','phoneArr'));
    }

    public function update(Request $request, $id)
    {
        $target = PhoneBook::find($id);

        // echo '<pre>';print_r($target);exit;

        $qpArr = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:phone_books,name,' . $id,
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('contact/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        }

        $target->name = $request->name;
        $target->phone_number = $request->phone_number;
        $target->email = $request->email;

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $fullName = Auth::user()->id . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            // return $fullName;
            $path = "uploads/contactImage/";
            if (!empty($target->image)) {
                File::delete('uploads/contactImage/' . $target->image);
            }
            $img->move($path, $fullName);
            $target->image = $fullName;
        }

        if ($target->save()) {

            Session::flash('success', 'Updated Successfully');
            return redirect('contact');
        } else {
            Session::flash('error', 'Could not be Updated');
            return redirect('contact' . $id . '/edit');
        }
    }

    public function destroy(Request $request, $id)
    {
        $target = PhoneBook::find($id);

        $qpArr = $request->all();


        if (empty($target)) {
            session()->flash('error', 'Invalid data id');
        }


        if ($target->delete()) {

            Session::flash('error', 'Deleted Successfully');
        } else {
            Session::flash('error', 'Could not be deleted');
        }
        return redirect('contact');
    }

    public function filter(Request $request)
    {
        $url = 'search=' . urlencode($request->search);
        return Redirect::to('contact?' . $url);
    }


    public function addToFavourite(Request $request, $id)
    {
        $getFavouriteId = PhoneBook::select('favourite')->where('id', $id)->first();
        if($getFavouriteId->favourite == '1'){
            $favouriteId = '0';
        }else{
            $favouriteId = '1';
        }
        PhoneBook::where('id',$id)->update(['favourite'=>$favouriteId]);
        if($getFavouriteId->favourite == '0'){
            Session::flash('success', 'Add to Favourite Successfully');
            return redirect('/contact');
        }else{
            Session::flash('error', 'Remove to Favourite');
            return redirect('/contact');
        }

    }

    public function favouriteContact(Request $request)
    {

        $qpArr = $request->all();
        $targetArr = PhoneBook::where('favourite','1')->orderBy('id', 'asc');
        $nameArr = PhoneBook::where('favourite','1')->select('name')->orderBy('id', 'asc')->get();

        //begin filtering
        $searchText = $request->search;
        if (!empty($searchText)) {
            $targetArr->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $targetArr = $targetArr->paginate();

        return view('admin.contact.favouriteContact')->with(compact('targetArr', 'qpArr', 'nameArr'));
    }
    public function addMultipleEmail(Request $request) {

                $html = view('admin.contact.addAnotherEmail')->render();
                return response()->json(['html' => $html]);
            }
    public function addMultiplePhone(Request $request) {

                $html = view('admin.contact.addAnotherPhone')->render();
                return response()->json(['html' => $html]);
            }

}
