<?php

namespace App\Http\Controllers\katbar;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Katbarmodel;
use Illuminate\Support\Facades\Session;

class katbarcontroller extends Controller
{
    public function index()
    {
        // $katbars = katbarmodel::paginate(20);
        $setting = DB::table('setting')->get();
        $datkatbar = DB::table('kategori_barang')->paginate(20);
        // dd($datkatbar);
        return view('katbar/index',['katbar'=>$datkatbar,'title'=>$setting]);
    }
    
    public function create()
    {
        $setting = DB::table('setting')->get();
        return view('katbar/create',['title'=>$setting]);
    }

    public function store(Request $request)
    {
        Katbarmodel::create([
            'spesial_cargo' => $request->spesial_cargo,
            'charge'  => $request->charge

        ]);
        return redirect('kat_bar')->with('status','Input Data Sukses');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jab = Katbarmodel::find($id);
        $setting = DB::table('setting')->get();
        return view('katbar/edit',['katbar'=>$jab,'title'=>$setting]);

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
        $rules = [
                    'spesial_cargo'  => 'required|min:2',
                    'charge'  => 'required|min:2',
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',

         ];
        $this->validate($request,$rules,$customMessages);
        Katbarmodel::find($id)->update([
            'spesial_cargo'  => $request->spesial_cargo,
            'charge'  => $request->charge
            ]);
        return redirect('/kat_bar')->with('status','Edit Data Sukses');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->aid;
         Katbarmodel::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
}
