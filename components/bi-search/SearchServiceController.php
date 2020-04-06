<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class SearchServiceController extends Controller
{

    public function __construct()
    {
        
    }

    public function index()
    {
        return view('bi-search');
    }

    public function show()
    {
        return view('bi-search');
    }

    public function serve_css()
    {
        $css_content = View::make('style');

        return (new Response($css_content, '200'))
                  ->header('Content-Type', 'text/css');
    }

    public function find(Request $request) 
    {
        if ($request->has('sstring') && $request->input('sstring') !== "") {
            //$searchQuery = "Suche nach: " . $request->input('sstring');
            $sstring = $request->input('sstring');
            $result = app('db')->select("SELECT * FROM test_faqs WHERE question_short LIKE '%$sstring%'");
            return response()->json($result);
        } else {
            $searchQuery = "Keine gültige Eingabe!";
        }
        
        echo $searchQuery;
        //return $searchQuery;
    }
    
}