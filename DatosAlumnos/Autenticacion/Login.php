<?php
/**
 * Class login
 * handles the user's login and logout process
 */
class Login
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
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        include './config/db.php';
        include './config/conexion.php';
        include 'FormatoRut.php';
        
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Usuario Vacio";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Clave Vacia";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            $rut_estudiante=$_POST['user_name'];
            
/*
                $sql = "SELECT * FROM tbl_estudiante, tbl_genero,tbl_carrera "
                     . "WHERE tbl_estudiante.genero_estudiante = tbl_genero.id_genero "
                     . "AND tbl_estudiante.carrera_estudiante = tbl_carrera.id_carrera "
                     . "AND tbl_estudiante.rut_estudiante = '$rut_estudiante'";
 */
            
                $sql = " SELECT * FROM tbl_estudiante "
                     . " WHERE tbl_estudiante.rut_estudiante = '$rut_estudiante'";

                $result_of_login_check = sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));

                // if this user exists
                if (sqlsrv_num_rows($result_of_login_check) == 1) {

                    // get result row (as an object)
                    $result_row = sqlsrv_fetch_array($result_of_login_check);

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                     
                    
                    if (password_verify($_POST['user_password'], $result_row['clave_estudiante'])) {
               
                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['rut_estudiante']         = $result_row['rut_estudiante'] ;
			$_SESSION['nombre_estudiante']      = $result_row['nombre_estudiante'] ;
			$_SESSION['apellido_estudiante']    = $result_row['apellido_estudiante'] ;
                        
                      
                        
                        $_SESSION['user_login_status']  = 1;

                    } else {
                        $this->errors[] = "Usuario y/o contraseña no coinciden.";
                    }
                } else {
                    $this->errors[] = "Usuario y/o contraseña no coinciden.";
                }
            } else {
                $this->errors[] = "Problema de conexión de base de datos.";
            }
    }
    

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "Has sido desconectado.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
    
}
