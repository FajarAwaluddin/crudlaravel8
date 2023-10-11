<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use PDF;

class EmployeeController extends Controller
{   //fungsi index untuk menampilkan data pegawai atau halaman utama
    public function index (Request $request) {
       
       if($request->has('search')){
            $data = Employee::where('nama','LIKE','%'.$request->search.'%')->paginate(5);

       }else{
            $data = Employee::paginate(5);

       }

        //membatasi paginator untuk menampilkan data hanya 5 buah
        
        
        return view('datapegawai',compact('data'));
}
    //fungsi tambah pegawai untuk mengalihka dari halaman utama ke halaman form tambah pegawai
    public function tambahpegawai (){

        return view('tambahdata');
    }
    //fungsi insert data untuk mengirim informasi data baru dari tambah data ke data base
    public function insertdata(Request $request) {
        //dd($request->all());
        //menambahkan simpan foto lalu file foto tersebut disimpan pada program dan bukan database, foto tersebu tersimpan pada fotopegawai yang berada pada file public
        $data = Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data Berhail Ditambahkan');
    }

    //fungsi tampilkan data menampilkan data terbaru yang ada pada database ke halaman web
    public function tampilkandata($id) {
        $data = Employee::find($id);

        return view('tampildata',compact('data'));
    }
    //fungsi update data untuk merubah atau mengedit data yang sudah ada menjadi data yang berbeda sesuai dengan data yang di ubah
    public function updatedata (Request $request,$id){
        //data yang di ubah akan di update pada database yang sudah ada dan akan di update pla pada tampilan web
        $data = Employee::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success','Data Berhail Diupdate');

    }
    //fungsi delete untuk menghapu data yang sudah ada dan terhapus pada tampilan web
    public function delete($id){
        //mengupdate data yang terhapus ke database dan menghapus data tersebut di database dan juga di tampilan web
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success','Data Berhail Dihapus'); 
    }
    // fungsi export pdf untuk mengunduf data menjadi file pdf yang disimpan pada penyimpanan hardware
    public function exportpdf(){
        //untuk mengambil semua data di employee
        $data = Employee::all();
        //untuk menampilkan data yang sudah diambil lalu ditampilkan kembali ke file datapegawai pdf dan bia di export
        view()->share('data', $data);
        $pdf = PDF::Loadview('datapegawai-pdf');
        return $pdf -> download('data.pdf');

    }

}
