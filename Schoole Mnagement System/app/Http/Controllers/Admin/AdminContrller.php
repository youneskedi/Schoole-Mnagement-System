<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminContrller extends Controller
{

    public function index()
    {
        $admins = User::where('role' , 'admin')->get();
//        @dd($admins);
        return view('admin.all_admins' , [
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $files = $request->file('img');
        $files_extension = 'png';

        $file_name = time() . '.' . $files_extension ;
        $path = 'uploads/admins' ;
        $files->move($path , $file_name) ;

        $validated = $request->validate([
            'name' => 'string|required' ,
            'phone_number' => 'required' ,
            'email' => 'email|required' ,
            'password' => 'min:5|required|string' ,
            'img' => 'nullable'
        ]);

        $validated['img'] = $file_name ;
        $validated['role'] = 'admin' ;

        User::create($validated) ;

        return redirect(route('admin.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = User::findOrFail($id) ;
        return view('admin.edit' , [
            'admin' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = User::findOrFail($id) ;
        if($request->hasFile('img')){
            $files = $request->file('img');
            $file_name = time() . '.png' ;
            $path = 'uploads/admins' ;
            $files->move($path , $file_name) ;
        }

        $validated = $request->validate([
            'name' => 'string|required' ,
            'phone_number' => 'required' ,
            'email' => 'email|required' ,
            'password' => 'min:5|required|string' ,
            'img' => 'nullable'
        ]);

        $validated['img'] = $admin->img ;

        $admin->update($validated) ;

        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        $admin->delete() ;
        return redirect(route('admin.index')) ;
    }
}
