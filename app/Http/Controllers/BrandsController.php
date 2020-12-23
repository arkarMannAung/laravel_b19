<?php

namespace App\Http\Controllers;

use App\Brands;
// use App\Controller;
use Illuminate\Http\Request;
use File;
class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brands::orderBy('id','desc')->get();
        return view('backend.brand.brand',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'photo'=>'required|mimes:jpeg,jpg,png'
        ]);
     
        if ($request->file()) {
            $fileName = time().'_'.$request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('img/brands',$fileName,'public');
            $path = '/storage/'.$filePath;
        }
        // db add
        $brands=new Brands;
        $brands->name=$request->name;
        $brands->photo=$path;
        $brands->save();

        // header location
        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function show(Brands $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $brands=Brands::find($id);
        return view('backend.brand.edit',compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $brands=Brands::find($id);
        $request->validate([
            'name' => 'required',
            'photo' => 'sometimes|mimes:jpeg,jpg,png'
        ]);
        if ($request->file()) {
            // delete old file
            $str=$brands->photo;
            $pos = strpos($str,'/',1);
            $str = substr($str, $pos);
            $oldFile = storage_path('app\public').$str;
            File::Delete($oldFile);
            $fileName = time().'_'.$request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('img/brands',$fileName,'public');
            $path = '/storage/'.$filePath;
            $brands->photo=$path;
        }
        // db add
        $brands->name=$request->name;
        $brands->save();

        // header location
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brands=Brands::find($id);
        // delete file
        $str=$brands->photo;
        $pos = strpos($str,'/',1);
        $str = substr($str, $pos);
        $oldFile = storage_path('app\public').$str;
        File::Delete($oldFile);

        $brands->delete();
        return redirect()->route('brands.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        //
        $brand=Brands::find($request->id);
        // dd($brand->name);
        return view('frontend.brand.branddetail',compact('brand'));
    }
}
