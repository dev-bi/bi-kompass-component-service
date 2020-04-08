<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class SearchServiceController extends Controller
{

    private $viewPath = 'components/bi-search/views';
      
    private function configViewPath () {
        config([
            'view.paths' => [realpath(base_path($this->viewPath))]
        ]);
    }

    /**
     * Zeigt die Komponente an.
     * 
     * In Wordpress wird diese Methode aufgerufen, um die Komponente einzubinden
     *  
     * @return View Gibt View der Komponente als HTML zurück.
     */
    public function show()
    {
        $this->configViewPath();

        return view('bi-search');
    }

    /**
     * Wird verwendet, um die css Datei der Komponente in Wordpress einzubinden.
     * 
     * @return Response gibt die für diesen View verwendete css datei zurück.
     */
    public function serveStylesheet()
    {
        $this->configViewPath();
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