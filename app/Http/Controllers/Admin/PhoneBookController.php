<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhoneBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PhoneBookController extends Controller
{
    public function index(Request $request) {
        //passing param for custom function
        $qpArr = $request->all();
        $targetArr = PhoneBook::orderBy('id', 'asc');
        $status = ["0" => __('label.SELECT_STATUS_OPT')] + array("1" => "Active", "2" => "Inactive");
        $nameArr = PhoneBook::select('name')->orderBy('id', 'asc')->get();

        //begin filtering
        $searchText = $request->search;
        if (!empty($searchText)) {
            $targetArr->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        if (!empty($request->status)) {
            $targetArr->where('favorite', $request->status);
        }
        //end filtering

        $targetArr = $targetArr->paginate(Session::get('paginatorCount'));

        //change page number after delete if no data has current page
        if ($targetArr->isEmpty() && isset($qpArr['page']) && ($qpArr['page'] > 1)) {
            $page = ($qpArr['page'] - 1);
            return redirect('/admin/seal?page=' . $page);
        }

        return view('admin.contact.index')->with(compact('targetArr', 'qpArr', 'nameArr', 'status'));
    }

    public function create(Request $request) { //passing param for custom function
        $qpArr = $request->all();

        return view('admin.contact.create')->with(compact('qpArr'));
    }

    public function store(Request $request) {
        //begin back same page after update

        $qpArr = $request->all();
        // return $qpArr;
        $pageNumber = !empty($qpArr['page']) ? '?page=' . $qpArr['page'] : '';
        //end back same page after update

        $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:phone_books,name',
                    'phone_number' => 'required|unique:phone_books,phone_number',
                    'email' => 'required|email|unique:phone_books,email',
        ]);

        if ($validator->fails()) {
            return redirect('contact/create' . $pageNumber)
                            ->withInput()
                            ->withErrors($validator);
        }

        $target = new PhoneBook;
        $target->name = $request->name;
        $target->phone_number = $request->phone_number;
        $target->email = $request->email;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $fullName =Auth::user()->id . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $path = "uploads/contactImage/";
            $img->move($path, $fullName);
            $target->image = $fullName;
        }
        // return $target;

        if ($target->save()) {
            Session::flash('success','Created Successfully');
            return redirect('/contact');
        } else {
            Session::flash('error', 'Not Created');
            return redirect('/contact' . $pageNumber);
        }
    }

    public function edit(Request $request, $id) {
        $target = Seal::find($id);
        $orderList = array('0' => __('label.SELECT_ORDER_OPT')) + Helper::getOrderList($this->controller, 2);
        if (empty($target)) {
            Session::flash('error', __('label.INVALID_DATA_ID'));
            return redirect('admin/seal');
        }

        //passing param for custom function
        $qpArr = $request->all();

        return view('seal.edit')->with(compact('target', 'qpArr', 'orderList'));
    }

    public function update(Request $request, $id) {
//     print_r($request->all());exit;
        $target = Seal::find($id);
        // return $request;
        $presentOrder = $target->order;
        // echo '<pre>';print_r($target);exit;
        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter']; //!empty($qpArr['page']) ? '?page='.$qpArr['page'] : '';
        //end back same page after update

        $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:seal,name,' . $id,
                    'order' => 'required|not_in:0',
                    'status' => 'required|not_in:0',
        ]);

        if ($validator->fails()) {
            return redirect('admin/seal/' . $id . '/edit' . $pageNumber)
                            ->withInput()
                            ->withErrors($validator);
        }

        $target->name = $request->name;
        $target->order = $request->order;
        $target->status = $request->status;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $fullName =Auth::user()->id . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $path = "public/uploads/seal/";
            if (!empty($target->logo)) {
                File::delete('public/uploads/seal/' . $target->logo);
            }
            $img->move($path, $fullName);
            $target->logo = $fullName;
        }

        if ($target->save()) {
            if ($request->order != $presentOrder) {
                Helper::updateOrder($this->controller, $request->order, $target->id, $presentOrder);
            }
            Session::flash('success', __('label.SEAL_HAS_BEEN_UPDATED_SUCCESSFULLY'));
            return redirect('admin/seal' . $pageNumber);
        } else {
            Session::flash('error', __('label.SEAL_COULD_NOT_BE_UPDATED'));
            return redirect('admin/seal/' . $id . '/edit' . $pageNumber);
        }
    }

    public function destroy(Request $request, $id) {
        $target = PhoneBook::find($id);

        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = !empty($qpArr['page']) ? '?page=' . $qpArr['page'] : '?page=';
        //end back same page after update

        if (empty($target)) {
            session()->flash('error','Invalid data id');
        }


        if ($target->delete()) {

            Session::flash('error', 'Deleted Successfully');
        } else {
            Session::flash('error','Could not be deleted');
        }
        return redirect('contact' . $pageNumber);
    }

    public function filter(Request $request) {
        $url = 'search=' . urlencode($request->search);
        return Redirect::to('contact?' . $url);
    }

}
