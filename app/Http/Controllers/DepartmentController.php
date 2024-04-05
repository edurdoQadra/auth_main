<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $Department= Department::all();
         return response()->json($Department);
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = ['name' =>'required|string|min:1|max:100'];
        $validator = Validator::make($request->input(), $rules);        
         if ($validator->fails()){    
            return response()->json([
                'status'=> false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $Department = new Department($request->input());
        $Department->save();
        return response()->json([
            'status'=> true,
            'message' => 'Departmento creado satisfactoriamente'
        ], 200);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return response()->json(['status'=>true,'data' => $department]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $Department)
    {
        $rules = [
            'name' =>'required|string|min:1|max:100'
        ];
        $validator = Validator::make($request->input(), $rules);        
         if ($validator->fails()){    
            return response()->json([
                'status'=> false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $Department->update($request->input());
        return response()->json([
            'status'=> true,
            'message' => 'Departmento actualizado satisfactoriamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $departmentName = $department->name; // Obtener solo el nombre del departamento
        $department->delete();
    
        return response()->json([
            'status'=> true,
            'message' => 'Departamento eliminado satisfactoriamente',
            'department_name' => $departmentName // Incluir solo el nombre del departamento
        ], 200);
    }
}
