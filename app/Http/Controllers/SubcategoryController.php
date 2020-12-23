<?php
namespace App\Http\Controllers;

use App\Subcategories;
use App\Categories;
use Illuminate\Http\Request;
// use App\Categories;
class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory = Subcategories::orderBy('id','desc')->get();
        return view('backend.subcategory.subcate',compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorys = Categories::all();
        return view('backend/subcategory/new',compact('categorys'));
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
                // validate
        $request->validate([
            'name' => 'required'
        ]);
        $subcategories= new Subcategories;
        $subcategories->name=$request->name;
        $subcategories->category_id=$request->categoryid;
        $subcategories->save();

        return redirect()->route('subcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategories $subcategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcate = Subcategories::find($id);
        return view('backend.subcategory.edit',compact('subcate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        $request->validate([
            'name' => 'required'
        ]);
        $subcategories=Subcategories::find($id);
        $subcategories->name=$request->name;
        $subcategories->category_id=$request->categoryid;
        $subcategories->save();
        return redirect()->route('subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $subcategories=Subcategories::find($id);
        $subcategories->delete();
        return redirect()->route('subcategories.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        // validate
        // dd($request->id);
        $subcategory=Subcategories::find($request->id);
        return view('frontend.subcategory.subcategory',compact('subcategory'));
    }

}
