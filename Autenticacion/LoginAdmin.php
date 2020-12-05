<?php
/**
 * Class login
 * handles the user's login and logout process
 */
class LoginAdmin
{

    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        
        // create/read session, absolutely necessary
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogoutAdmin();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinAdminWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinAdminWithPostData()
    {
        include '../config/db.php';
        include '../config/conexion.php';
        include '../Clases/Log.php';
        include '../Autenticacion/IP.php';
        
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Usuario Vacio";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Clave Vacia";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            $rut_asistente=$_POST['user_name'];
            
            
                $sql = " SELECT * FROM tbl_asistente "
                     . " WHERE rut_asistente = '$rut_asistente'"
                     . " AND estado = 1 ";

                $result_of_login_check = sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));

                // if this user exists
                if (sqlsrv_num_rows($result_of_login_check) == 1) {

                    // get result row (as an object)
                    $result_row = sqlsrv_fetch_array($result_of_login_check);

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                     
                    
                    if (password_verify($_POST['user_password'], $result_row['clave_asistente'])) {
               
                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['rut_asistente']         = $result_row['rut_asistente'] ;
			$_SESSION['nombre_asistente']      = $result_row['nombre_asistente'] ;
			$_SESSION['apellido_asistente']    = $result_row['apellido_asistente'] ;
                        $_SESSION['tipo_asistente']        = $result_row['tipo'] ;
                        
                        $_SESSION['user_login_admin_status']  = 1;
                        
                        
                        $accion = "Inicia session";
                        Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);

                    } else {
                        $this->errors[] = "Usuario y/o contraseña no coinciden.";
                         $accion = "Error de usuario o contraseña ";
                         Log::registrarLog(getRealIP(), php_uname(),$accion,$con);
                    }
                } else {
                    $this->errors[] = "Usuario y/o contraseña no coinciden.";
                    $accion = "Error de usuario o contraseña ";
                    Log::registrarLog(getRealIP(), php_uname(),$accion,$con);
                }
            } else {
                $this->errors[] = "Problema de conexión de base de datos.";
            }
    }
    

    /**
     * perform the logout
     */
    public function doLogoutAdmin()
    {
        include '../config/db.php';
        include '../config/conexion.php';
        include '../Clases/Log.php';
        // delete the session of the user
         $accion = "Cierra session";
        if(isset($_SESSION['rut_asistente'])){ 
         Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
        }
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "Has sido desconectado.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedInAdmin()
    {
        if (isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
    
}
