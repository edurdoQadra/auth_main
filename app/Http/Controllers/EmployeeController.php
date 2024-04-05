<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::select('employees.*', 'departments.name as department')
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->paginate(10);
        
        return response()->json($employee);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' =>'required|string|min:1|max:100',
            'email' => 'required| email|max:80', 
            'phone' => 'required|max:15',
            'department_id' => 'required|numeric'
        ];
        $validator = Validator::make($request->input(), $rules);        
         if ($validator->fails()){    
            return response()->json([
                'status'=> false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $employee = new Employee($request->input());
        $employee->save();
        return response()->json([
            'status'=> true,
            'message' => 'Departamento creado satisfactoriamente'
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        return response()->json(['status'=>true,'data' => $employee]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $rules = [
            'name' =>'required|string|min:1|max:100',
            'email' => 'required|email|max:80',
            'phone' => 'required|max:15',
            'department_id' => 'required|numeric' // Corregido el nombre del campo a 'department_id'
        ];
    
        $validator = Validator::make($request->all(), $rules); // Corregido $request->input() a $request->all()
    
        if ($validator->fails()) {    
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
    
        $employee->update($request->all()); // Usar $request->all() en lugar de $request->input()
        
        return response()->json([
            'status' => true,
            'message' => 'Employee updated successfully' // Corregido 'Employee update successfully' a 'Employee updated successfully'
        ], 200); // Corregido el código de respuesta de 400 a 200
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employees)
    {
        $employees->delete();
        return response()->json([
            'status'=> true,
            'message' => 'Departamento actualizado satisfactoriamente'
        ], 200);
    }

    public function EmployeesByDepartament(){
        $employees = Employee::select(DB::raw('count(employees.id) as count,
        departments.name'))
        ->rightJoin('departments','departments.id','=','employees.department_id')
        ->groupBy('departments.name')->get();
        return response()->json($employees);
    }

    public function all(){

        $employees = Employee::select('employees.*','departments.name as department')
        ->join('departments','departments.id','=','employees.department_id')
        ->get();
        return response()->json($employees);

    }
}
