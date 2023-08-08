<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DataTables;
use File;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
       $employee = Employee::get();
       if ($request->ajax()) 
       {
            return DataTables::of($employee)
                
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button class="btn btn-primary edit" data-id="'.$row->id.'">Edit</button> <button class="btn btn-danger delete" data-id="'.$row->id.'">Delete</button>';
                    return $actionBtn;
                })
                ->addColumn('profile_image', function($row){
                    return  '<img src="'.asset('uploads/employees/'.$row->profile_image).'" width="50"/>';
                })
                ->rawColumns(['action','profile_image'])
                ->make(true);
        }

       return view('employee');
    }

   public function store(Request $request){
    $employee = new Employee;

    if($request->hasFile('profile_image')){
        $file = $request->file('profile_image');
        $ext = $file->getClientOriginalName();
        $filename=time().'_'.$ext;
        $file->move('uploads/employees',$filename);

        $employee->profile_image= $filename;
    }
    $employee->fullname = $request->fullname;
    $employee->email = $request->email;
    $employee->phone = $request->phone;
    $employee->gender = $request->gender;
    $arrayToString = implode(',', $request->hobby);
    $employee->hobby = $arrayToString;
    $employee->course = $request->course;

    $employee->save();
    return response()->json(['status'=>1,'data'=>$employee]);

   }
   public function edit(Request $request){
        $employee = Employee::find($request->id);
        
        return $employee;
   }
   public function update(Request $request)
    {
        $employee = Employee::where('id',$request->id)->first();

        $image_path = "uploads/employees/".$employee->profile_image;

        if(File::exists($image_path)) 
        {
            File::delete($image_path);
        }

        if($request->hasfile('profile_image'))
        {
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalName();
            $filename = time().'_'.$extension;
            $file->move('uploads/employees/', $filename);

            $employee->profile_image = $filename;
        }
        
        $employee->fullname = $request->fullname;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->gender = $request->gender;
        $arrayToString = implode(',', $request->hobby);
        $employee->hobby = $arrayToString;
        $employee->course = $request->course;
        $employee->save();

        return response()->json(['status' => 1, 'data' => $employee]);
    }
    public function delete(Request $request)
    {
        $employee = Employee::find($request->id);

        $image_path = "uploads/employees/".$employee->profile_image;

        if(File::exists($image_path)) 
        {
            File::delete($image_path);
        }

        $employee->delete();

    }



 
}
