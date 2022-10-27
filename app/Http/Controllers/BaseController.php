<?php

namespace App\Http\Controllers;
use App\Models\BaseCourse;
use App\Models\IntermediateCourse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basecourse = BaseCourse::all;
        return view('home', compact('basecourse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timezone = 'Africa/Lagos';
        date_default_timezone_set($timezone);
        //$base = new BaseCourse;
        $email = request('email');
        $teaching = request('teaching');
        $response = request('response');
        
        if ($response != 'remote' and $response != 'onsite') {
            return back()->with('rmsg', 'Wrong Mode Selected'); //email not found
        }
        if ($teaching == 'NAS') { 
            $exam = '(Spreadsheet, Online Essentials, Computer Essentials and Word Processing)';
            if ($users = DB::table('basemodule')->where('email', $email)->count()> 0){

                if ($users = DB::table('basemodule')->where('email', $email)->get()){
                    foreach ($users as $user) {
                        $base_id = $user->id; 
                    } 
                    $stmt = DB::table('basesubmit')->where('base_id', $base_id);
                    if ($stmt->exists()) {
                        $course = BaseCourse::findOrFail($base_id);
                        $stmt = $stmt->get();
                        foreach ($stmt as $mode) {
                            $mode = $mode->response;
                        }
                        if ($mode == 'remote') {
                            $link = 'https://drive.google.com/file/d/17aTj2ffSx4WXGqAjudxfKNTwd3qsIefj/view?usp=sharing_eil_m&ts=634019ec';
                            return view('validcrn',compact('course'),['existmsg'=>$mode, 'link'=>$link, 'exam'=>$exam]);

                        }
                        elseif ($mode=='onsite'){
                            $mode = 'onsite (in the school)';
                            $link = 'https://drive.google.com/file/d/17aTj2ffSx4WXGqAjudxfKNTwd3qsIefj/view?usp=sharing_eil_m&ts=634019ec';
                            return view('validcrn',compact('course'),['existmsg'=>$mode, 'link'=>$link, 'exam'=>$exam]);

                        }
                    }
                    else{
                        $b_response = DB::table('basesubmit')->insert(['base_id'=>$base_id, 'response'=>$response, 'created_at'=>Carbon::now()]);
                        $stmt = $stmt->get();
                        foreach ($stmt as $mode) {
                            $mode = $mode->response;
                        }
                        $course = BaseCourse::findOrFail($base_id);
                        if ($mode == 'remote') {
                            $link = 'https://drive.google.com/file/d/17aTj2ffSx4WXGqAjudxfKNTwd3qsIefj/view?usp=sharing_eil_m&ts=634019ec';
                            return view('validcrn',compact('course'),['msg'=>$mode, 'link'=>$link, 'exam'=>$exam]);

                        }
                        elseif ($mode=='onsite'){
                            $mode = 'onsite (in the school)';
                            $link = 'https://drive.google.com/file/d/17aTj2ffSx4WXGqAjudxfKNTwd3qsIefj/view?usp=sharing_eil_m&ts=634019ec';
                            return view('validcrn',compact('course'),['msg'=>$mode, 'link'=>$link, 'exam'=>$exam]);

                        }
                    }
                }
            }
            else{
                return back()->with('msg',$email); //email not found
            }
        }
        if ($teaching == 'AS') { 
            $exam = '(Online Collaboration, ICT in Education, Cyber Security and Presentation)';
            if ($users = DB::table('intermediatemodule')->where('email', $email)->count() > 0 ){
                if ($users = DB::table('intermediatemodule')->where('email', $email)->get()){
                    foreach ($users as $user) {
                        $int_id = $user->id; 
                    } 
                    $stmt = DB::table('intermediatesubmit')->where('int_id', $int_id);
                    if ($stmt->exists()) {
                        $course = IntermediateCourse::findOrFail($int_id);
                        $stmt = $stmt->get();
                        foreach ($stmt as $mode) {
                            $mode = $mode->response;
                        }
                        if ($mode == 'remote') {
                            $link = 'https://drive.google.com/file/d/1RxX6VMDZMsdaXcD0sPdBwKqgRELOspYG/view?usp=sharing_eil_m&ts=63401a62';
                            return view('validcrn',compact('course'),['existmsg'=>$mode, 'link'=>$link, 'exam'=>$exam]);

                        }
                        elseif ($mode=='onsite'){
                            $mode = 'onsite (in the school)';
                            $link = 'https://drive.google.com/file/d/17aTj2ffSx4WXGqAjudxfKNTwd3qsIefj/view?usp=sharing_eil_m&ts=634019ec';
                            return view('validcrn',compact('course'),['existmsg'=>$mode, 'link'=>$link, 'exam'=>$exam]);

                        }
                    }
                    else{
                        $b_response = DB::table('intermediatesubmit')->insert(['int_id'=>$int_id, 'response'=>$response, 'created_at'=>Carbon::now()]);
                        $stmt = $stmt->get();
                        foreach ($stmt as $mode) {
                            $mode = $mode->response;
                        }
                        $course = IntermediateCourse::findOrFail($int_id);
                        if ($mode == 'remote') {
                            $link = 'https://drive.google.com/file/d/1RxX6VMDZMsdaXcD0sPdBwKqgRELOspYG/view?usp=sharing_eil_m&ts=63401a62';
                            return view('validcrn',compact('course'),['msg'=>$mode, 'link'=>$link, 'exam'=>$exam]);

                        }
                        elseif ($mode=='onsite'){
                            $mode = 'onsite (in the school)';
                            $link = 'https://drive.google.com/file/d/17aTj2ffSx4WXGqAjudxfKNTwd3qsIefj/view?usp=sharing_eil_m&ts=634019ec';
                            return view('validcrn',compact('course'),['msg'=>$mode, 'link'=>$link, 'exam'=>$exam]);

                        }
                    }
                }
            }
            else{
                return back()->with('msg',$email); //email not found
            }
        }
        
        else{
            return back()->with('teachingmsg',''); //category not selected

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
    public function destroy($id)
    {
        //
    }
}
