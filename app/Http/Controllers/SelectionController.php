<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variety;
use App\Models\Selection;
use App\Models\DetailSelection;

class SelectionController extends Controller
{
    //
    public function index()
    {
        //
        $selections = Selection::all();

        return view('selections.index', compact('selections'));
    }

    public function create() 
    {
        $varieties = Variety::all();
        return view('selections.create',);
    }

}
