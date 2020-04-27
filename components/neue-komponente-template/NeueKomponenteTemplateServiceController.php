<?php
/**
 * Diese Klasse und ihre Methoden umbenennen und erweitern, auch den Pfad zu den Views nicht vergessen.
 *
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;

/**
 * NeueKomponenteTemplateServiceController
 *
 * Beschreibe hier, was die Komponente tut.
 * @author Max Musterautor <autor@mustermax.com>
 *
 * ACHTUNG:
 * Der Controller muss in der datei components/includes.php bekanntgemacht werden
 */

class NeueKomponenteTemplateServiceController extends Controller {

    static private $viewPath = 'components/neue-komponente-template/views';

    public function __construct() {
        config([
            'view.paths' => [realpath(base_path(self::$viewPath))]
        ]);
    }

    /**
     * Zeigt die Komponente an.
     *
     * In Wordpress wird diese Methode aufgerufen um die Komponente einzubinden
     *
     * @return View Gibt View der Komponente als HTML zurück.
     */
    public function show() {
        $someData = [
            "test" => "Testdaten",
            "muh" => "andere Daten",
        ];
        return view('neue-komponente-template-html', ['someData' => $someData]);
    }
    /**
     * Wird verwendet, um die css Datei der Komponente in Wordpress einzubinden.
     *
     * @return Response gibt die für diesen View verwendete css datei zurück.
     */
    public function serveStylesheet() {
        $css_content = View::make('neue-komponente-template-view');

        return (new Response($css_content, '200'))
                  ->header('Content-Type', 'text/css');

    }
}