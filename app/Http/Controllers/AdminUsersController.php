<?php

namespace App\Http\Controllers;
use App\User;
use App\Photo;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
            

    public function index(Request $request)
    {
        $users = User::all();
        $authUser = Auth::user()->name;
        session(['authUser'=>$authUser]);

        return view('admin.users.index', compact('users'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();

        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);
        User::create($input);

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        // $photo = Photo::findOrFail($user->photo_id);
        $input = $request->all();

        $file = $request->file('photo_id');
        if(!empty($file)) {
            unset($user->photo_id);
            // unlink("/images/" . $photo);
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo1 = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo1->id;
        }

        $input['password'] = bcrypt($request->password);
        $user->update($input);

        return redirect("/admin/users");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        unlink(public_path() . $user->photo->file);//brisanje slike iz direktorijuma
        $user->delete();
        //$photo = Photo::findOrFail($user->photo_id)->delete(); -> brisanje slike iz baze, koristi se kada se zna da se nece ponavljati slike
        Session::flash('deleted_user', 'User has been deleted');

        return redirect('/admin/users');
    }
}
