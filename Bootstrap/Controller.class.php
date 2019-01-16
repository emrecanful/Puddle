<?php
namespace Bootstrap;

use Bootstrap\Model;
use Jenssegers\Blade\Blade;

class Controller extends Model {

    public static function view($viewPath, $data=[])
    {
        /**
         * --------------------------------------------------------
         * Loading up Laravel's Standalone version of Blade Engine.
         * --------------------------------------------------------
         */
        require_once("../Packages/Blade/autoload.php");
        /**
         * Making an instance of Laravel's Blade Engine system.
         */
        $blade = new Blade("../Views", "../Cache/ViewCache");

        /**
         * --------------------------------------------------------
         * Defining custom directives for Blade Template.
         * --------------------------------------------------------
         */
        $blade->compiler()->directive("form_csrf", function() {
            $csrf = self::formCSRF();
            return "<?php echo '$csrf'; ?>";
        });


        /* -------------------------------------------------------*/
        /**
         * Creating the layout.
         */
        echo $blade->make($viewPath, $data);
    }


    public static function formCSRF()
    {
        return '<input type="hidden" name="CSRF" value="'.$_SESSION['CSRF'].'">';
    }

}