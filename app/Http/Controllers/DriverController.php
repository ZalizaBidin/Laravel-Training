<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;



class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $driver = new Driver;
    
        $driver->name = $request->name;
        $driver->icno = $request->icno;
        $driver->licenseno = $request->licenseno;
        $driver->licensepict = $request->licensepict;
        $driver->user_id = $request->user_id;

        $driver->save();

        return response()->json([
            'driver' => $driver,
            'status' => 200,
        ]); 

    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
		$driver = Driver::find($id);
		return response()->json([
            'driver'=> $driver,
			'status' => 200,
		]); 


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $driver = Driver::find($request->edit_id);

        $driver_data = [
            'name' => $request->edit_name, 
            'icno' => $request->edit_icno,
            'licenseno' => $request->edit_licenseno,
            'licensepict' => $request->edit_licensepict,   
            'user_id' => $request->edit_user_id   

        ];

		$driver->update($driver_data);

		return response()->json([
            'driver'=>$driver,
			'status' => 200,
		]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
         $id = $request->id;
        //delete target record
        Driver::find($id)->delete();
		return response()->json([
            'request'=>$request,
			'status' => 200,
		]);   

    }

   
        public function fetchAll() {
        $drivers =Driver::all();
        $output = '';
        if ($drivers->count() > 0) {
                $output .= '<table id="table_driver" class="table table-striped table-sm text-center align-middle">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>icno</th>
                    <th>licenseno</th>
                    <th>licensepict</th>
                    <th>userid</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';
            foreach ($drivers as $driver) {
                $output .= '<tr>
                    <td>' . $driver->id . '</td>
                    <td>' . $driver->name . '</td>
                    <td>' . $driver->icno . '</td>
                    <td>' . $driver->licenseno . '</td>
                    <td><img src="' . $driver->licensepict . '" width="100px"/></td>
                    <td>' . $driver->user_id . '</td>
                    <td>
                      <a href="#" id="' . $driver->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#modal_edit_record"><i class="bi-pencil-square h4"></i></a>
                      <a href="#" id="' . $driver->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                    </td>
                </tr>';
            }
            $output .= '</tbody></table>';
                echo $output;
        } else {
                echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }    
    }    

 
}