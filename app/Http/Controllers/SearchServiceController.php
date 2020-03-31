<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchServiceController extends Controller
{

    public function __construct()
    {
        
    }

    public function index()
    {
        echo "Wollen Sie etwas suchen?";
    }

    public function find(Request $request) 
    {
        if ($request->has('sstring') && $request->input('sstring') !== "") {
            $searchQuery = "Suche nach: " . $request->input('sstring');
        } else {
            $searchQuery = "Das war keine gültige Eingabe, du Spacko!";

        }
        
        echo $searchQuery;
        //return $searchQuery;
    }
    
}