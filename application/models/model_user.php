<?php require_once('/application/core/db.php');

class Model_User extends Model
{
    public function get_data()
    {

    }

    /****************************************/
    /**    Registration on the site        **/
    /****************************************/

    public function registration()
    {
        $database = new db();
        $database->db;

        if (isset($_SESSION['login']) || isset($_COOKIE['login']) && isset($_COOKIE['pass'])) {
            echo "U r registrated user - " . $_SESSION['login'] . "!";
        } else {
            if (self::check_data($database))
            {

                $login = trim(strip_tags($_POST['login']));
                $password = md5(trim(strip_tags($_POST['password'])));
                $email = trim(strip_tags($_POST['email']));

                $database->insert('user',"(NULL, '$login', '$password', '$email')");
                mkdir("upload/$login", 0700);

                $_SESSION['login'] = $login;

                setcookie('login', $login, time()+3600, '/');
                setcookie('pass', $password, time()+3600, '/');
                header('Location: /files');

            } else {
//                echo "fill all fields valid";
            }
        }
    }

    /****************************************/
    /**   Authorization on the site        **/
    /****************************************/

    public function login()
    {
        if(isset($_POST['submit']))
        {
            if (isset($_SESSION['login']) || isset($_COOKIE['login']) && isset($_COOKIE['pass'])) {
                echo "U r registrated user - " . $_SESSION['login'] . "!";
            } else {
                $database = new db();
                $database->db;

                $login = trim(strip_tags($_POST['login']));
                $password = md5(trim(strip_tags($_POST['password'])));

                $query = $database->select('*','user',"where login = '$login' and pass = '$password'") or die("error in database");
                if (mysql_num_rows($query) == 1) {
                    $_SESSION['login'] = $login;
                    setcookie('login', $login, time()+3600, '/');
                    setcookie('pass', $password, time()+3600, '/');
                    header('Location:/files');
                } else {
                    echo "Not correct login or password...";
                }
            }
        }

    }

    /****************************************/
    /**         Logout the site            **/
    /****************************************/

    public function logout()
    {
        session_start();
        unset($_SESSION['login']);
        setcookie('login', "", 1, "/");
        setcookie('pass', "", 1, "/");
        header('Location:/files');
    }


    /****************************************/
    /*          back-end validation         */
    /****************************************/

    public function check_data($database)
    {
        if ($_POST['login'] == "") return false;
        if ($_POST['password'] == "") return false;
        if ($_POST['repeat_password'] == "") return false;
        if ($_POST['email'] == "") return false;

        $login = $_POST['login'];
        $query = $database->select('*','user',"where login = '$login'");
        if (@mysql_num_rows($query) != 0) return false;

        if (!preg_match("/((\w*)\d*)*@(\w)*\.{1}(\w){1,4}/", $_POST['email'])) return false;
        return true;
    }


    /****************************************/
    /**   checking to double logininng     **/
    /****************************************/

    public function confirnLogin()//not correct
    {

        $database = new db();
        $database->db;
        $login = $_GET['login'];
        $query = $database->select('login','user',"where login = '$login'");
        $result = mysql_num_rows($query);

        echo $result;
    }
}

?>