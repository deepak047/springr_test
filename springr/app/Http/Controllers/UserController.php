<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        
          // handle file Upload

        if($request->hasFile('avatar'))
        {
          $fileNameWithExt=$request->file('avatar')->getClientOriginalName();
          $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);

          $extension=$request->file('avatar')->getClientOriginalExtension();

          $fileNameToStore=$fileName.'_'.time().'.'.$extension;
          //Upload Image
          $path =$request->file('avatar')->storeAs('public/user_images',$fileNameToStore);
        }
        else
        {
            $fileNameToStore='noimage.jpg';
        }
        $user =new User;
        $user->name =$request->input('name');
        $user->email =$request->input('email');
        $user->password =Hash::make($request->input('password'));
        $user->date_of_joining =$request->input('date_joining');
        $user->date_of_leaving =$request->input('date_leaving');
        $user->user_type ='user';
        $user->avatar =$fileNameToStore;
        $user->still_working =(($request->input('still_working')) == '1' ? '1' : '0');
        $user->save();

        return redirect()->back()->with('message','User Added');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        Storage::delete('/public/user_images/'. $user->avatar);
        $user->delete();
        return redirect(route('home'))->with('message','User Deleted');
    }
}
