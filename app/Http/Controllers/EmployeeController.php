<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view("admin.contact");
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
        $this->validate($request, [
            "name" => "required",
            "email"=> "required",
            "password"=> "required",
            "company" => "required",
            // "file" => "required|mimes:png,jpg,jpeg,pdf"   
        ]);


$imagename = microtime()."ACI,". $request->file->getClientOriginalExtension();
$request->file->move(public_path("images"), $imagename);



        $data = new Employee();
        $data->name = $request->name;
        $data->company = $request->company;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->image = $imagename;
        $data->save();
       return redirect()->back()->with("success","Form Submitted Succesfully");
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $empdata = Employee::all();
        return view("admin.table")->with(["data" => $empdata]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $empdata = Employee::find($id);

        return view("admin\update")->with(["data"=> $empdata]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Employee::find($id);
        $data->name = $request->name;
        $data->company = $request->company;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->route('main.table')->with("success","Updated Succesfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $empdata = Employee::find($id);
        $empdata->delete();
        return redirect()->back()->with("success","User Deleted  Successfuly");
    }
}
