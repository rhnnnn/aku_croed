<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\LevelSekolah;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolahs=Sekolah::with('sekolahlevels')->paginate(5);

        $levels=LevelSekolah::all();
        // Call the firstItem() method on the $sekolahs variable
        $firstItem = $sekolahs->firstItem();

        return view('pages.table-sekolah', compact('sekolahs', 'firstItem', 'levels'));
    }

    public function store(Request $request)
    {
        // validate the form data
        $validatedData = $request->validate([
            'nama' => 'required',
            'LEVEL_ID' => 'required',
            'alamat' => 'required',
            'koordinat' => 'required',
            'tel_cust' => 'required',
            'pic_cust' => 'required',
            'am' => 'required',
            'tel_am' => 'required',
            'sto' => 'required',
            'hero' => 'required',
            'tel_hero' => 'required',
        ]);

        //  Create a new data in the db
        Sekolah::create ([
            'NAMA' => $validatedData['nama'],
            'LEVEL_ID' => $validatedData['LEVEL_ID'],
            'ALAMAT' => $validatedData['alamat'],
            'KOORDINAT' => $validatedData['koordinat'],
            'TEL_CUST' => $validatedData['tel_cust'],
            'PIC_CUST' => $validatedData['pic_cust'],
            'AM' => $validatedData['am'],
            'TEL_AM' => $validatedData['tel_am'],
            'STO' => $validatedData['sto'],
            'HERO' => $validatedData['hero'],
            'TEL_HERO' => $validatedData['tel_hero'],
        ]);

        // $enumValues = Sekolah::getEnumValues('LEVEL');

        return redirect('/tabel/sekolah')->with('success', 'sekolah added successfully.');

        // ->with(['enumValues' => $enumValues])
    }

    public function update(Request $request, $id){
        $sekolah=Sekolah::findorFail($id);

        $validatedData=$request->validate([
            'NAMA' => 'required',
            'LEVEL_ID' =>'required',
            'ALAMAT' => 'required',
            'KOORDINAT' => 'required',
            'TEL_CUST' => 'required',
            'PIC_CUST' => 'required',
            'AM' => 'required',
            'TEL_AM' => 'required',
            'STO' => 'required',
            'HERO' => 'required',
            'TEL_HERO' => 'required'
        ]);

        $sekolah->NAMA=$validatedData['NAMA'];
        $sekolah->LEVEL_ID=$validatedData['LEVEL_ID'];
        $sekolah->ALAMAT=$validatedData['ALAMAT'];
        $sekolah->KOORDINAT=$validatedData['KOORDINAT'];
        $sekolah->TEL_CUST=$validatedData['TEL_CUST'];
        $sekolah->PIC_CUST=$validatedData['PIC_CUST'];
        $sekolah->AM=$validatedData['AM'];
        $sekolah->TEL_AM=$validatedData['TEL_AM'];
        $sekolah->STO=$validatedData['STO'];
        $sekolah->HERO=$validatedData['HERO'];
        $sekolah->TEL_HERO=$validatedData['TEL_HERO'];
        $sekolah->save();

        return redirect()->back()->with('success', 'Sekolah updated successfully.');
    }
}