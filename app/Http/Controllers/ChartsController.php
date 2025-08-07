<?php

namespace App\Http\Controllers;

use App\Imports\ChartItemsImport;
use App\Models\ChartCategories;
use App\Models\ChartItems;
use App\Models\Charts;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;
use Auth;
use Session;

class ChartsController extends Controller
{
    protected $ChartCategories;
    protected $ChartItems;
    protected $Charts;
    protected $User;

    public function __construct(Charts $Charts, ChartItems $ChartItems, User $User)
    {
        $this->middleware(['auth', 'clearance']);
        $this->ChartItems = $ChartItems;
        $this->Charts = $Charts;
        $this->User = $User;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $User = $this->User->where('id', Auth::user()->id)->first();
        if (isset($User->chartCategories)) {
            $chartCategories = explode(',', $User->chartCategories);
            $charts = $this->Charts->whereIn('category_id', $chartCategories)->get();
        } else {
            $charts = Charts::all();
        }

        return view('charts.index', compact('charts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $User = $this->User->where('id', Auth::user()->id)->first();
        if (isset($User->chartCategories)) {
            $chartCategories = explode(',', $User->chartCategories);
            $categories = ChartCategories::whereIn('id', $chartCategories)->get()->pluck('title', 'id');
        } else {
            $categories = ChartCategories::all()->pluck('title', 'id');
        }
        return view('charts.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            '_value' => 'required|max:120',
            '_type' => 'required',
            'category_id' => 'required'
        ]);
        $y_value = $request->y_value;
        $x_value = $request->x_value;
        $results = array_filter(array_combine($y_value, $x_value));

        $charts = Charts::create($request->only('title', '_value', '_type', 'category_id'));

        $row = 0;
        foreach ($results as $y => $x) {
            $itemEx = explode('/', $y);
            $date[$row] = (new Jalalian($itemEx[0], $itemEx[1], $itemEx[2]))->getTimestamp();
            $this->ChartItems = new ChartItems();
            $this->ChartItems->chart_id = $charts->id;
            $this->ChartItems->x_value = $x;
            $this->ChartItems->y_value = $date[$row];
            $this->ChartItems->save();
            $row++;
        }

        return redirect()->route('charts.index')
            ->with('success',
                'نمودار ' . $charts->title . ' با موفقیت ایجاد شد !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $charts = Charts::findOrFail($id);


        $User = $this->User->where('id', Auth::user()->id)->first();
        if (isset($User->chartCategories)) {
            $chartCategories = explode(',', $User->chartCategories);
            $categories = ChartCategories::whereIn('id', $chartCategories)->get()->pluck('title', 'id');
        } else {
            $categories = ChartCategories::all()->pluck('title', 'id');
        }

        $ChartItems = $this->ChartItems->where('chart_id', $id)
            ->get();

        return view('charts.edit', compact('charts', 'categories', 'ChartItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            '_value' => 'required|max:120',
            '_type' => 'required',
            'category_id' => 'required'
        ]);

        $y_value = $request->y_value;
        $x_value = $request->x_value;
        $results = array_filter(array_combine($y_value, $x_value));

        $y_value_update = $request->y_value_update;
        $x_value_update = $request->x_value_update;

        $results_update = array_filter(array_combine($y_value_update, $x_value_update));


        $charts = Charts::findOrFail($id);
        $charts->title = $request->input('title');
        $charts->_value = $request->input('_value');
        $charts->_type = $request->input('_type');
        $charts->category_id = $request->input('category_id');
        $charts->save();

        if ($results) {
            $row = 0;
            foreach ($results as $y => $x) {
                $itemEx = explode('/', $y);
                $date[$row] = (new Jalalian($itemEx[0], $itemEx[1], $itemEx[2]))->getTimestamp();
                $this->ChartItems = new ChartItems();
                $this->ChartItems->chart_id = $charts->id;
                $this->ChartItems->x_value = $x;
                $this->ChartItems->y_value = $date[$row];
                $this->ChartItems->save();
                $row++;
            }
        }

        if ($y_value_update) {
            foreach ($y_value_update as $key => $value) {
                $itemEx = explode('/', $value);
                $date = (new Jalalian($itemEx[0], $itemEx[1], $itemEx[2]))->getTimestamp();
                $ChartItem_select = $this->ChartItems->where('id', $key)->first();
                $ChartItem_select->y_value = $date;
            }
            foreach ($x_value_update as $key => $value) {
                $ChartItem_select = $this->ChartItems->where('id', $key)->first();
                $ChartItem_select->x_value = $value;
            }
        }

        return redirect()->route('charts.index')
            ->with('success',
                'نمودار ' . $charts->title . ' با موفقیت ویرایش شد !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $charts = Charts::findOrFail($id);
        $charts->delete();

        return redirect()->route('charts.index')
            ->with('success',
                'نمودار با موفقیت حذف شد !');
    }

    public function deleteChartItem(Request $request)
    {
        $dataId = $request->dataId;
        $dataSelect = $this->ChartItems->where('id', $dataId)->first();
        if ($dataSelect) {
            $dataSelect->delete();
        } else
            return false;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_import()
    {

        $User = $this->User->where('id', Auth::user()->id)->first();
        if (isset($User->chartCategories)) {
            $chartCategories = explode(',', $User->chartCategories);
            $categories = ChartCategories::whereIn('id', $chartCategories)->get()->pluck('title', 'id');
        } else {
            $categories = ChartCategories::all()->pluck('title', 'id');
        }
        return view('charts.create_import', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store_import(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            '_value' => 'required|max:120',
            '_type' => 'required',
            'category_id' => 'required',
            'fileExcel' => 'required'
        ],
            [
                'fileExcel.required' => 'آپلود فایل exel اجباری می باشد.',
            ]);

        $charts = Charts::create($request->only('title', '_value', '_type', 'category_id'));
        $report_id = $charts->id;
        $path = $request->file('fileExcel');
        Excel::import(new ChartItemsImport($report_id),$path);

        return redirect()->route('charts.edit',$charts->id)
            ->with('success',
                'نمودار ' . $charts->title . ' با موفقیت ایجاد شد !');
    }
}
