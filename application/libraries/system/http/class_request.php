<?PHP
class class_request{

    public static function is_ajax(){

        if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
            return true;
        }

        return false;

    }

}