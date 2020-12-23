<?php
namespace App\Http\Controllers;

use App\Items;
use App\Brands;
use App\Subcategories;
use Illuminate\Http\Request;
use File;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items=Items::orderBy('id','desc')->get();
        return view('backend.item.items',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.item.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png',
            'price' => 'required',
        ]);

        if ($request->file()) {
            $fileName = time().'_'.$request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('img/items',$fileName,'public');
            $path = '/storage/'.$filePath;
        }

        $items=new Items;
        $items->codeno=$request->code;
        $items->name=$request->name;
        $items->photo=$path;
        $items->price=$request->price;
        $items->discount=$request->discount;
        $items->description=$request->description;
        $items->brand_id=$request->brandid;
        $items->subcategory_id=$request->subcategoryid;
        $items->save();

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items=Items::find($id);
        return view('backend.item.edit',compact('items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $items=Items::find($id);
        $request->validate([
               'code' => 'required',
               'name' => 'required',
               'photo' => 'sometimes|mimes:jpeg,jpg,png',
               'price' => 'required',
        ]);

        if ($request->file()) {
            // delete old file
            $str=$items->photo;
            $pos = strpos($str,'/',1);
            $str = substr($str, $pos);
            $oldFile = storage_path('app\public').$str;
            File::Delete($oldFile);

            $fileName = time().'_'.$request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('img/items',$fileName,'public');
            $path = '/storage/'.$filePath;
            $items->photo=$path;
        }

        $items->codeno=$request->code;
        $items->name=$request->name;
        $items->price=$request->price;
        $items->discount=$request->discount;
        $items->description=$request->description;
        $items->brand_id=$request->brandid;
        $items->subcategory_id=$request->subcategoryid;
        $items->save();

        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items=Items::find($id);
        // delete old file
        if ($items->photo) {
            $str=$items->photo;
            $pos = strpos($str,'/',1);
            $str = substr($str, $pos);
            $oldFile = storage_path('app\public').$str;
            File::Delete($oldFile);      
        }
        $items->delete();
        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function detail(Request  $request)
    {
        $items=Items::find($request->id);
        return view('frontend.itemdetail.itemdetail',compact('items'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function cart(Request  $request)
    {
        return view('frontend.cart.cartdetail');
    }
}
