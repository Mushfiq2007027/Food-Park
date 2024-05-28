<?php

namespace App\Http\Controllers\Admin;


use App\Models\ProductOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProductOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'max:255'],
                'price' => ['required', 'numeric'],
                'product_id' => ['required', 'integer']
            ],
            [
                'name.required' => 'Product Option=> Name is Required',
                'name.max' => 'Product Option=> Max Length is 255KB',
                'price.required' => 'Product Option=> Price is Required',
                'price.numeric' => 'Product Option=> Price Have To Be A Number',
            ]);


        $option = new ProductOption();

        $option->product_id = $request->product_id;
        $option->name = $request->name;
        $option->price = $request->price;
        $option->save();

        toastr()->success('Created Successfully!');

        return redirect()->back();


    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try {
            $image = ProductOption::findOrFail($id);
            $image->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something Went Wrong!']);
        }
    }
}
