<?php

namespace App\Http\Controllers;

use App\Models\ChartCategories;
use Illuminate\Http\Request;
use Auth;
use Session;

class ChartCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'clearance']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chartCategories = ChartCategories::all();
        return view('chartCategories.index', compact('chartCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chartCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required|max:120'
        ]);

        $chartCategories = ChartCategories::create($request->only('title'));

        return redirect()->route('chartCategories.index')
            ->with('success',
                'دستبندی نمودار ' . $chartCategories->title . ' با موفقیت ایجاد شد !');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chartCategories = ChartCategories::findOrFail($id);

        return view('chartCategories.edit', compact('chartCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required|max:120'
        ]);

        $chartCategories = ChartCategories::findOrFail($id);
        $chartCategories->title = $request->input('title');
        $chartCategories->save();

        return redirect()->route('chartCategories.index')
            ->with('success',
                'دستبندی نمودار ' . $chartCategories->title . ' با موفقیت ویرایش شد !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chartCategories = ChartCategories::findOrFail($id);
        $chartCategories->delete();

        return redirect()->route('chartCategories.index')
            ->with('success',
                'دستبندی نمودار با موفقیت حذف شد !');
    }
}
