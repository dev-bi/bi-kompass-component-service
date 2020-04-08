<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;

/**
 * addEditUIServiceController 
 * 
 * stellt eine Eingabemaske und die entsprechenden Operationen bereit,
 * um Daten in die BI-Kompass Datenbank zu schreiben und zu bearbeiten
 */

class AddEditUIServiceController extends Controller{

    private $viewPath = 'components/add-edit-ui/views';
      
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
    public function show() {
        /* Dieser Aufruf ist vorerst notwendig, um die View-Dateien richtig zu lokalisieren */
        /* ToDo: als Middleware realisieren */
        $this->configViewPath();

        $someData = [
            "test" => "Testdaten",
            "muh" => "andere Daten",
        ];
        return view('add-edit-ui-index-html', ['someData' => $someData]);
    }


    /**
     * Wird verwendet, um die css Datei der Komponente in Wordpress einzubinden.
     * 
     * @return Response gibt die für diesen View verwendete css datei zurück.
     */
    public function serveStylesheet() {
        /* dieser Aufruf ist vorerst notwendig, um die View-Dateien richtig zu lokalisieren */
        /* ToDo: als Middleware realisieren */
        $this->configViewPath();

        $css_content = View::make('add-edit-ui-view');

        return (new Response($css_content, '200'))
                  ->header('Content-Type', 'text/css');

    }
    


}