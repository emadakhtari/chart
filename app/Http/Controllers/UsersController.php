<?php

namespace App\Http\Controllers;

use App\Models\ChartCategories;
use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $users;


    public function __construct(User $users)
    {
        $this->middleware(['auth', 'isAdmin']);
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all users and pass it to the view
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $ChartCategories = ChartCategories::get();
        return view('users.create', ['roles' => $roles, 'ChartCategories' => $ChartCategories]);
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
            'name' => 'required|max:120',
            'phone' => [
                'required',
                'unique:users',
                'regex:/09[0-9]{9}|۰۹[۰-۹]{9}/'
            ],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required|exists:roles,id',
        ],
            [
                'name.required' => 'فیلد نام و نام خانوادگی اجباری می باشد.',
                'permissions.required' => 'لطفا مجوز کاربر را انتخاب نمایید',
            ]);


        $chartCategories = $request['chartCategories'];

        if (isset($chartCategories)) {
            $setCategory = '';
            foreach ($chartCategories as $categories) {
                $setCategory .= $categories . ',';
            }
        }

        $setCategory = rtrim($setCategory, ',');

        $hashed = Hash::make($request->password);

        $user = User::create(array_merge($request->only('email', 'name', 'phone', 'type', 'avatar', 'status'), ['username' => $request->phone, 'password' => $hashed, 'chartCategories' => $setCategory]));

        $roles = $request['roles'];
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }
        return redirect()->route('users.index')
            ->with('success',
                'کاربر ' . $user->name . ' با موفقیت ایجاد شد !');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        $ChartCategories = ChartCategories::get();

        $ChartCategoriesSelect = $user->chartCategories;
        $ChartCategoriesSelect = explode(',', $ChartCategoriesSelect);

        return view('users.edit', compact('user', 'roles', 'ChartCategories', 'ChartCategoriesSelect'));
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
        $user = User::findOrFail($id);


        if ($request->password) {
            $this->validate($request, [
                'name' => 'required|max:120',
                'phone' => [
                    'required',
                    'unique:users,phone,' . $id,
                    'regex:/09[0-9]{9}|۰۹[۰-۹]{9}/'
                ],
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required|min:6|confirmed',
                'roles' => 'required|exists:roles,id',
            ],
                [
                    'name.required' => 'فیلد نام و نام خانوادگی اجباری می باشد.',
                    'permissions.required' => 'لطفا مجوز کاربر را انتخاب نمایید',
                ]);
        } else {
            $this->validate($request, [
                'name' => 'required|max:120',
                'phone' => [
                    'required',
                    'unique:users,phone,' . $id,
                    'regex:/09[0-9]{9}|۰۹[۰-۹]{9}/'
                ],
                'email' => 'required|email|unique:users,email,' . $id,
                'roles' => 'required|exists:roles,id',
            ],
                [
                    'name.required' => 'فیلد نام و نام خانوادگی اجباری می باشد.',
                    'permissions.required' => 'لطفا مجوز کاربر را انتخاب نمایید',
                ]);
        }

        $chartCategories = $request['chartCategories'];

        if (isset($chartCategories)) {
            $setCategory = '';
            foreach ($chartCategories as $categories) {
                $setCategory .= $categories . ',';
            }
        }

        $setCategory = rtrim($setCategory, ',');

        if ($request->password) {
            $hashed = Hash::make($request->password);
            $request->merge(['username' => $request->phone]);
            $request->merge(['password' => $hashed]);
            $request->merge(['chartCategories' => $setCategory]);

            $user->update($request->all());

            $input = array_merge(array_merge($request->only('email', 'name', 'phone', 'type', 'avatar', 'status'), ['username' => $request->phone, 'password' => $hashed, 'chartCategories' => $setCategory]));
        } else {
            $user->username = $request->input('phone');
            $user->chartCategories = $setCategory;
            $user->password = $user->password ?? $request->password;
            $user->save();
            $input = array_merge(array_merge($request->only('email', 'name', 'phone', 'type', 'avatar', 'status'), ['username' => $request->phone, 'chartCategories' => $setCategory]));
        }


        $roles = $request['roles'];
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }

        return redirect()->route('users.index')
            ->with('success',
                'کاربر ' . $user->name . ' با موفقیت ویرایش شد !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($id == 1) {
            return redirect()->route('users.index')
                ->with('error',
                    'حذف کاربر مدیر کل سامانه امکان پذیر نمی باشد !');
        } else {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success',
                    'کاربر با موفقیت حذف شد !');
        }

    }

    public function uploadCrop(Request $request)
    {

        $data = $request->image;
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $imageName = time() . '.png';
        file_put_contents(public_path('data/users/' . $imageName), $data);

        $output['img'] = '<img src="' . asset('data/users/' . $imageName) . '" class="img-thumbnail" />';
        $output['imageName'] = $imageName;
        return $output;
    }
}
