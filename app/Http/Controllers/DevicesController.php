<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;

class DevicesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = Post::orderBy('title', 'desc')->get();
        //return Post::where('title', 'Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = Post::orderBy('title', 'desc')->take(1)->get();
        $devices = Device::orderBy('created_at', 'desc')->paginate(10);
        return view('devices.index')->with('devices', $devices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
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
            'imei' => 'required',
            'alias' => 'required',
            'phone' =>'required'
        ]);

        $device = new Device;
        $device->imei = $request->input('imei');
        $device->alias = $request->input('alias');
        $device->phone = $request->input('phone');
        $device->description = $request->input('description');
        $device->user_id = auth()->user()->id;
        $device->save();

        return redirect('/devices')->with('success', 'Device created');

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
        $device = Device::find($id);
        return view('devices.show')->with('device',$device);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = Device::find($id);
        // Check for correct user
        if(auth()->user()->id !== $device->user_id){
            return redirect('/devices')->with('error', 'Unauthorized page');
        }
        return view('devices.edit')->with('device', $device);
        
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
            'imei' => 'required',
            'alias' => 'required',
            'phone' =>'required'
        ]);
        
        $device = Device::find($id);
        $device->imei = $request->input('imei');
        $device->alias = $request->input('alias');
        $device->phone = $request->input('phone');  
        $device->description = $request->input('description');   

        $device->save();

        return redirect('/devices')->with('success', 'Device updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id);
        // Check for correct user
        if(auth()->user()->id !== $device->user_id){
            return redirect('/devices')->with('error', 'Unauthorized page');
        }

        $device->delete();
        return redirect('/devices')->with('success', 'Device removed');
    }

}
