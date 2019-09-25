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
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $setting = DB::table('setting')->get();
        $datkatbar = DB::table('kategori_barang')
        ->orderby('kategori_barang.id','desc')
        ->get();
        return view('katbar/index',['katbar'=>$datkatbar,'title'=>$setting]);
    }
    
    public function create(){
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
    //========================================================
    public function edit($id)
    {
        $jab = Katbarmodel::find($id);
        $setting = DB::table('setting')->get();
        return view('katbar/edit',['katbar'=>$jab,'title'=>$setting]);

    }
    //=======================================================
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

    //===========================================================================
    public function destroy(Request $request)
    {
        $id = $request->aid;
         Katbarmodel::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
}
