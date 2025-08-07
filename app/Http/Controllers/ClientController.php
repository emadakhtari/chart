<?php
namespace App\Http\Controllers;

use App\Models\ChartCategories;
use App\Models\Clients;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;

class ClientController extends Controller
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
        $clients = Clients::all();
        return view('clients.index')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
            'name'=>'required|max:120',
            'phone' => [
                'required',
                'unique:clients',
                'regex:/09[0-9]{9}|۰۹[۰-۹]{9}/'
            ],
            'email' => 'required|email|unique:clients',
            'password' => 'required|min:6|confirmed',
        ],
            [
                'name.required' => 'فیلد نام و نام خانوادگی اجباری می باشد.',
            ]);


        $hashed = Hash::make($request->password);
        $clients = Clients::create(array_merge($request->only('email', 'name', 'phone',  'status'), ['username' => $request->phone, 'password' => $hashed]));


        return redirect()->route('clients.index')
            ->with('success',
                'کاربر ' . $clients->name . ' با موفقیت ایجاد شد !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Clients::findOrFail($id);

        return view('clients.edit', compact('clients'));
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
        if ($request->password) {
            $this->validate($request, [
                'name'=>'required|max:120',
                'phone' => [
                    'required',
                    'unique:clients',
                    'regex:/09[0-9]{9}|۰۹[۰-۹]{9}/'
                ],
                'email' => 'required|email|unique:clients',
                'password' => 'required|min:6|confirmed',
            ],
                [
                    'name.required' => 'فیلد نام و نام خانوادگی اجباری می باشد.',
                ]);
        } else {
            $this->validate($request, [
                'name'=>'required|max:120',
                'phone' => [
                    'required',
                    'unique:clients',
                    'regex:/09[0-9]{9}|۰۹[۰-۹]{9}/'
                ],
                'email' => 'required|email|unique:clients',
            ],
                [
                    'name.required' => 'فیلد نام و نام خانوادگی اجباری می باشد.',
                ]);
        }
        $clients = Clients::findOrFail($id);
        if ($request->password) {
            $hashed = Hash::make($request->password);
            $request->merge(['username' => $request->phone]);
            $request->merge(['password' => $hashed]);

            $clients->update($request->all());
            $input = array_merge(array_merge($request->only('email', 'name', 'phone','status'), ['username' => $request->phone, 'password' => $hashed]));

        } else {
            $clients->username = $request->input('phone');
            $clients->password = $clients->password ?? $request->password;
            $clients->save();
            $input = array_merge(array_merge($request->only('email', 'name', 'phone', 'status'), ['username' => $request->phone]));
        }


        $clients->fill($input)->save();

        return redirect()->route('clients.index')
            ->with('success',
                'کاربر ' . $clients->name . ' با موفقیت ویرایش شد !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clients = Clients::findOrFail($id);
        $clients->delete();

        return redirect()->route('clients.index')
            ->with('success',
                'کاربر با موفقیت حذف شد !');
    }
}
