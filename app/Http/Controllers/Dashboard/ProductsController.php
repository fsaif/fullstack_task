<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Item::all();
        return view('dashboard.products.listProducts')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.addProduct')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        Item::validator($request->all());
        $newItem = new Item();
        $newItem->name = $request->input('name');
        $newItem->description = $request->input('description');
        $newItem->price = $request->input('price');
        $newItem->country = $request->input('country');
        $newItem->category_id = $request->input('category');
        $newItem->user_id = $id;

        if($request->hasfile('upload'))
        {
            $file = $request->file('upload');
            $name = $file->getClientOriginalName();
            $filename =time().$name;
            $file->move('storage/items/', $filename);
            $newItem->img = $filename;
        }

        $newItem->save();
        return redirect()->route('products.index')->with('alert_sucesss','Product was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return view('dashboard.products.productProfile')->with('item', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('dashboard.products.editProduct')->with('item', $item)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        Item::validator($request->all());
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->country = $request->input('country');
        $item->category_id = $request->input('category');

        if($request->hasfile('upload'))
        {
            $file = $request->file('upload');
            $name = $file->getClientOriginalName();
            $filename =time().$name;
            $file->move('storage/items/', $filename);
            $item->img = $filename;
        }

        $item->save();

        return redirect()->route('products.index')->with('alert_sucesss','Product was updated successfully');
    }

    /**
     * Show the confirmation resource for delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $item = Item::find($id);
        return view('dashboard.products.deleteProduct')->with('item', $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->route('products.index')->with('alert_danger','Product was deleted successfully');
    }
}
