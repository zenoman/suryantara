<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Loginmodel;

class Logincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = DB::table('setting')->get();
        return view('login/index',['title'=>$setting]);
    }
    public function masuk(Request $request){
        $username = $request->username;
        $password =md5($request->password);

        $dataadmin = DB::table('admin')->where([['username',$username],['password',$password]])->get();
        foreach ($dataadmin as $dataadmin) {
            $id = $dataadmin->id;
        }

        $data = DB::table('admin')->where([['username',$username],['password',$password]])->count();
        // dd($password);
        if($data>0){
                Session::put('username',$request->username);
                Session::put('id',$id);
                Session::put('login',TRUE);
                return redirect('dashboard');
        }else{
            return redirect('login');
        }
    }
    public function logout(){
        Session::flush();
        return redirect('login');
    }
    public function validatelogin(){
        Session::flush();
        return redirect('login')->with('status','Maaf, Anda Harus Login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
