<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class ReportController extends Controller
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
    public function test()
    { 
      $user = User::create([
            'name' => '1',
            'email' => 'a@gmail.com',
            'password' => Hash::make('1')
        ]);

        return response()->json([
          'user' => $user,
        'status' => 200
        ]); 
    }

    public function store(Request $request)
    {       

        $file = $request->file('select_pict3');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $report = new Report;     
        $report->rnumb = $request->rnumb;
        $report->rdate = $request->rdate;
        $report->rtime = $request->rtime;
        $report->alocn = $request->alocn;

        $report->apict1 = $request->apict1;
        $report->apict1thum = Image::make($request->apict1)->fit(100)->encode ('data-url');

        $report->apict2 = $request->apict2;
        $report->apict2thum = Image::make($request->apict2)->fit(100)->encode ('data-url');

        $report->apict3 = $fileName;
        $report->apict3thum = Image::make($request->apict3)->fit(100)->encode ('data-url');

        $report->afire = $request->afire;
        $report->atrap = $request->atrap;
        $report->ainju = $request->ainju;
        $report->user_id = $request->userid;    
        $report->save();
		return response()->json([
			'status' => 200,
		]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
		$id = $request->id;
		$report = Report::find($id);
		return response()->json([
      'report'=> $report,
			'status' => 200,
		]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

		$report = Report::find($request->edit_id);

		$report_data = [
            'rnumb' => $request->edit_rnumb,
            'rdate' => $request->edit_rdate,
            'rtime' => $request->edit_rtime,
            'alocn' => $request->edit_alocn,
            'apict1' => $request->edit_apict1,
            'apict1thum' =>  Image::make($request->edit_apict1)->fit(100)->encode ('data-url'),
            'apict2' => $request->edit_apict2,
            'apict2thum' =>  Image::make($request->edit_apict2)->fit(100)->encode ('data-url'),
            'apict3' => $request->edit_apict3,
            'apict3thum' =>  Image::make($request->edit_apict3)->fit(100)->encode ('data-url'),
            'afire' => $request->edit_afire,
            'atrap' => $request->edit_atrap,
            'ainju' => $request->edit_ainju,
            'user_id' => $request->edit_userid
        ];
		$report->update($report_data);
		return response()->json([
            'report'=>$report,
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
        Report::find($id)->delete();
		return response()->json([
            'request'=>$request,
			'status' => 200,
		]);     
    }
    public function fetchAll() {           
        $reports = Report::all();
        $output = '';
        if ($reports->count() > 0) {
            $output .= '<table id="table1" class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>id</th>
                <th>rnumb</th>
                <th>rdate</th>
                <th>rtime</th>
                <th>alocn</th>
                <th>apict1</th>
                <th>apict1thum</th>
                <th>apict2</th>
                <th>apict2thum</th>
                <th>apict3</th>
                <th>apict3thum</th>
                <th>afire</th>
                <th>atrap</th>
                <th>ainju</th>                                
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($reports as $report) {
                $link = asset('storage/images/'. $report->apict3);
                $output .= '<tr>
                <td>' . $report->id . '</td>
                <td>' . $report->rnumb . '</td>
                <td>' . $report->rdate . '</td>
                <td>' . $report->rtime . '</td>
                <td>' . $report->alocn . '</td>
                <td><img src="' . $report->apict1 . '" width="100px"/></td>
                <td><img src="' . $report->apict1thum . '" width="100px"/></td>                
                <td><img src="' . $report->apict2 . '" width="100px"/></td>
                <td><img src="' . $report->apict2thum . '" width="100px"/></td>  
                <td><img src="' .$link.'" width="100px"/></td>
                <td><img src="' . $report->apict3thum . '" width="100px"/></td>  
                <td>' . $report->afire . '</td>
                <td>' . $report->atrap . '</td>
                <td>' . $report->ainju . '</td>                                               
              <td>
                  <a href="#" id="' . $report->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#modal_edit_record"><i class="bi-pencil-square h4"></i></a>
                  <a href="#" id="' . $report->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
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