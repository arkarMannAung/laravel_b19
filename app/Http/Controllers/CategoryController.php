<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Categories::orderBy('id','desc')->get();

        return view('backend.category.category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.category.new');
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
        // dd($request);

        // validate
        $request->validate([
            'name' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png'
        ]);

        // upload
        if ($request->file()) {
            // 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // category
            $filePath =  $request->file('photo')->storeAs('img/category',$fileName,'public');
            $path = '/storage/'.$filePath;
        }

        // db insert

        $category = new Categories;
        $category->name = $request->name;
        $category->logo = $path;
        $category->save();


        // header('location ')
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories=Categories::find($id);
        // dd(storage_path().'\app\public');
        return view('backend.category.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categories=Categories::find($id);
        $request->validate([
            'name'=>'required|min:5',
            'photo' => 'sometimes|mimes:jpeg,jpg,png',
        ]);

        // upload new photo
        if ($request->file()) {
            // delete old file
            $str=$categories->logo;
            $pos = strpos($str,'/',1);
            $str = substr($str, $pos);
            $oldFile = storage_path('app\public').$str;

            File::Delete($oldFile);
            // 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // category
            $filePath =  $request->file('photo')->storeAs('img/category',$fileName,'public');
            $path = '/storage/'.$filePath;
            $categories->logo = $path;
        }       
        $categories->name = $request->name;
        $categories->save();
        // header('location ')
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  ->subcategories()
        $categories=Categories::find($id);
        // delete file
        $str=$categories->logo;
        $pos = strpos($str,'/',1);
        $str = substr($str, $pos);
        $oldFile = storage_path('app\public').$str;
        File::Delete($oldFile);
        // delete database
        $categories->delete();
        return redirect()->route('categories.index');
    }
}
