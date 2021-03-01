<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Variety;
use App\Models\Selection;
use App\Models\Characteristic;
use App\Imports\DetailselectionImport;
use Illuminate\Support\Facades\DB;



class Selections extends Controller
{
    

    public function index()
    {
        //
        $selections = Selection::with(["varieties"])->orderBy('created_at','desc')->get();
        
        
        return view('selections.index', compact('selections'));
    }

    public function create() 
    {
        $chars =  Characteristic::orderBy('created_at','desc')->get();
        //dd($chars);
        $varieties = Variety::all();
        return view('selections.create',compact('varieties','chars'));
    }

    public function store(Request $request) 
    {
        
        $this->validate($request,[
            'variety_id' => 'required|exists:varieties,id',
            'description' =>'required',
            'file_upload' =>'required|mimes:csv,xlx,xls,xlsx',
            'chars' => 'required|array|min:5'
        ]);
            $DetailSelections = array();
            $dtchars =  Characteristic::orderBy('created_at','desc')->get();
            
            
            
            $details = (new DetailselectionImport)->toArray($request->file_upload);
             /** rearrange array to be come as structur database **/
            $i = 0;
            foreach($details as $idx => $detail) {
                
                foreach($detail as $key => $val ) {
                    
                    foreach ($val as $ckey => $cval ) {
                        
                        if(in_array(Str::upper($ckey),$request->chars)) {
                            $DetailSelections[$i]['tree_name']=$val['tree_name'];
                            $DetailSelections[$i]['score'] = is_null($val[$ckey])?0:$val[$ckey];
                            $DetailSelections[$i]['characteristic_id'] = $this->getCharId(Str::upper($ckey));
                            //$DetailSelections[$i]['characteristic_code'] = Str::upper($ckey);

                        } 
                        $i++;
                    }
                    
                }
            }
            /** begin transaction to save data */
        
            DB::beginTransaction();
            try
            {
                $selection = Selection::create([
                    'variety_id'=> $request->variety_id,
                    'description' => $request->description,
                ]);
                //dump($selection->id);
                foreach ($DetailSelections as $detailSelection ) 
                {
                    $selection->selectionDetail()->create([
                        
                        'selection_id'=> $selection->id,
                        'tree_name' => $detailSelection['tree_name'],
                        'score' => $detailSelection['score'],
                        'characteristic_id' => $detailSelection['characteristic_id']
                    ]);

                }
                DB::commit();
                //dd($selection);
                return redirect('selections')->with(['succes'=> 'Data Seleksi Index Berhasil di tambahkan']);
            } 
            catch (\Exception $e)
            {
                DB::rollBack();
                //dd($e->getMessage());
                return back()->with(['error' => $e->getMessage()]);
            } 
            
            //dd($dtchars);
    }

    private function getCharId($code='') {
        if(!empty($code)) {
            $dtchars =  Characteristic::orderBy('created_at','desc')->get();
            foreach($dtchars as $dtchar) {
                if ($dtchar->code == $code) {
                    return $dtchar->id;
                }
            }
            
        } else {
            return null;
        } 
    }

    public function example()
    {
        $filename = 'exampleCSIT.xlsx';
        $path = public_path('storage/files/'.$filename);
       
        $header = [
            'Content-Type' => 'application/vmd.ms-excel',
            'Content-Disposisition' => 'inline; filename="'.$filename.'"'
        ];

        return response()->download($path, $filename, $header);
    }

}
