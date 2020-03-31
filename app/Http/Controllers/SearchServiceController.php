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
            //$searchQuery = "Suche nach: " . $request->input('sstring');
            $sstring = $request->input('sstring');
            $result = app('db')->select("SELECT question_short FROM test_faqs WHERE question_short LIKE '%$sstring%'");
            return response()->json($result);
        } else {
            $searchQuery = "Keine gültige Eingabe!";

        }
        
        echo $searchQuery;
        //return $searchQuery;
    }
    
}