<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSelection;
use App\Models\Selection;

use App\Models\Characteristic;

class DetailSelectionController extends Controller
{
    //
    public function show($selection_id)
    {
        $selection = Selection::with('varieties')->where('id', $selection_id)->first();
        $chars  = Characteristic::orderBy('created_at')->get();
        $chars = $chars->toArray();
        $details = DetailSelection::with('chars')->where('selection_id', $selection_id)->get();
        $details = $details->toArray();
        $data = array();
        $headers = array();
        $calc = array();
        $sum = array();
        $selectionIndexs = array();
        $i = 0; $j = 0;
        foreach($details as $dtkey => $detail) 
        { 
            foreach($detail as $detkey => $detval) {
                
                foreach($chars as $key => $val) {
                    if($val['id'] == $detail['characteristic_id']) {
                        $data[$detail['tree_name']]['tree_name'] = $detail['tree_name'];
                        $data[$detail['tree_name']][$val['code']] = $detail['score'];
                          
                        $i++;
                        //$data[$detail['tree_name']]['chars'][$val['code']] = $detail['chars'];
                        //$data['sum'][$val['code']] += $detail['score'];
                        if(!in_array($val['code'],$headers)) {
                            $headers[] = $val['code'];
                        }
                        
                        
                    }
                    
                }
            }
            
            foreach($chars as $key => $val) {
                if($val['id'] == $detail['characteristic_id']) {
                    if(!isset($sum["sum"][$val['code']])) {
                        $sum["sum"][$val['code']] = 0; //Declare it
                        $calc['characteristic'][$val['code']]= array();
                    }
                    $sum["sum"][$val['code']] += $detail['score'];
                    $calc['characteristic'][$val['code']][] = $detail['score'];
                    //dump($val['code'].":".$sum[$val['code']]);
                }
            }  
                
            
        }
        $totRow = count($data);
        foreach ($sum as $sey =>$sal) {
            foreach($sal as $ey => $al) {
                foreach($chars as $key => $val) {
                    if($val['code'] == $ey) {
                        if(!isset($sum["avg"][$val['code']])) {
                            $sum["avg"][$val['code']] = 0;
                            $sum['weight'][$val['code']] = 0;

                            
                        }
                        $sum["avg"][$val['code']] = round($sum[$sey][$val['code']]/$totRow,5,PHP_ROUND_HALF_UP);
                        $sum['weight'][$val['code']]=$val['weight'];
                        $sum['stdv'][$val['code']] = round($this->StDv($calc['characteristic'][$val['code']]),5);
                    }
                }

            }
             
            
        }

        foreach($data as $dy => $dl) {
            foreach($dl as $lkey => $lval) {
                $selectionIndexs[$dy]['tree_name'] = $dl['tree_name'];
                foreach($chars as $key => $val) {
                    if ($lkey==$val["code"]) {
                        $selectionIndexs[$dy][$val['code']] = round($dl[$val['code']]-$sum['avg'][$lkey]/$sum['stdv'][$lkey],4);
                    }
                    
                }
                
                
            }
            foreach($sum['weight'] as $wkey => $wval) 
            {
                if(!isset($selectionIndexs[$dy]["selection_index"])) 
                {
                    $selectionIndexs[$dy]["selection_index"] = 0;
                }
                $selectionIndexs[$dy]["selection_index"] +=  ($wval*$selectionIndexs[$dy][$wkey]);
            }

        }
        //dump($selectionIndex);
        //dump($sum['weight']);
        //dump($data[81]);
        //dd($details);
        return view('detail_selections.show',compact('selection','data','headers','sum', 'selectionIndexs'));
    }

    private function StDv($arr) 
    { 
        $num_of_elements = count($arr); 
          
        $variance = 0.0; 
          
                // calculating mean using array_sum() method 
        $average = array_sum($arr)/$num_of_elements; 
          
        foreach($arr as $i) 
        { 
            // sum of squares of differences between  
                        // all numbers and means. 
            $variance += pow(($i - $average), 2); 
        } 
          
        return (float)sqrt($variance/$num_of_elements); 
    } 

}
