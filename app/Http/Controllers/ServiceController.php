<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Photo;
use Image;
use Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users      = User::all();
        $services   = Service::all();
        return view('backend.pages.Service.create', [
            'users'     =>  $users,
            'services'  =>  $services,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            '*'=>'required',
        ]);

        // Photo::upload($request->thumbnail ,'uploads/service','TEAM');
        $team_image = $request->thumbnail;
        $extension = $team_image->getClientOriginalExtension();
        $file_name = Str::random(5). rand(1000,999999).'.'.$extension;
        Image::make($team_image)->save(public_path('uploads/service/'.$file_name));

        Service::insert([
            'user_id'        =>  1, //User ID Will be added
            'thumbnail'      =>  $file_name,
            // 'thumbnail'          =>  Photo::$name,
            'title'          =>  $request->title,
            'description'    =>  $request->description,
            'created_at'     =>  Carbon::now(),
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $users = User::all();
        return view('backend.pages.Service.edit', [
            'service'   =>  $service,
            'users'     =>  $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->thumbnail == ''){
            Service::find($id)->update([
                'user_id'           =>  1, //User ID Will be added
                'title'             =>  $request->title,
                'description'       =>  $request->description,
                'status'            =>  $request->status,
            ]);
        }
        else{
            $image = Service::where('id',$id)->first()->thumbnail;
            $image_delete = public_path('uploads/service/'.$image);
            unlink($image_delete);


            $thumbnail = $request->thumbnail;
            $extension = $thumbnail->getClientOriginalExtension();
            $file_name = Str::random(5). rand(1000,999999).'.'.$extension;
            Image::make($thumbnail)->save(public_path('uploads/service/'.$file_name));

            Service::find($id)->update([
                'user_id'           =>  1, //User ID Will be added
                'thumbnail'         =>  $file_name,
                'title'             =>  $request->title,
                'description'       =>  $request->description,
                'status'            =>  $request->status,
            ]);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Service::where('id',$id)->first()->thumbnail;
        $image_delete = public_path('uploads/service/'.$image);
        unlink($image_delete);

        Service::find($id)->delete();
        return back();
    }
}
