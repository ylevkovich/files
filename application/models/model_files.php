<?php require_once('/application/core/db.php');

class Model_Files extends Model
{

    private $COUNT_OF_SYMBOLS_FOR_LEFT_DELETE = 7;

    /****************************************/
    /**       Check autorization           **/
    /****************************************/

    public function get_data()
    {
        if (isset($_SESSION['login']) || isset($_COOKIE['login']) && isset($_COOKIE['pass']))
        {
            return true;
        }
        else {
            header('Location:/user/login');
            echo 'login please!';
        }
    }

    /****************************************/
    /**    Show files and operations       **/
    /****************************************/

    public function functional_panel()
    {
        $login = $_COOKIE['login'];
        return $this->get_files($login);
    }

    /****************************************/
    /** Return files putted to the server  **/
    /****************************************/

    private function get_files($login){
        $database = new db();
        $database->db;

        $query = $database->select('id','user',"WHERE login='$login'");
        $user = mysql_fetch_assoc($query);
        $user_id = $user['id'];

        $query = $database->select('*','files',"WHERE id_user='$user_id'");
        $all_files = array();
        while ($record = mysql_fetch_assoc($query)) {
            $all_files[] = $record;
        }

        return $all_files;
    }

    /****************************************/
    /**    Uploading file to server        **/
    /****************************************/

    public function upload()
    {
        $database = new db();
        $database->db;

        $login = $_COOKIE['login'];

        $uploadfile = 'upload/'.$login . "/" . self::translitIt(basename($_FILES['userfile']['name']));
        if(!file_exists($uploadfile))
        {
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

                $query = $database->select('id','user',"WHERE login='$login'");
                $record = mysql_fetch_assoc($query);
                $user_id = $record['id'];

                $hashForShare = self::RandomString();
                $database->insert('files',"(NULL, $user_id, '$uploadfile', '$hashForShare')");

                header("Location: /files");
            } else {
                echo "Download error!\n";
            }
        }
        else{
            header("Location: /files");
        }
    }

    /****************************************/
    /**    Generating random number        **/
    /****************************************/

    private function RandomString()
    {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }

    /****************************************/
    /**          Renaming file             **/
    /****************************************/

    private function translitIt($str)
    {
        $tr = array(
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
            "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
            "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
            "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
            "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
            "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
            "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
            "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
            "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
            "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
            "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", " " => "_"
        );
        return strtr($str,$tr);
    }

    /****************************************/
    /**          Delete file               **/
    /****************************************/

    public function delFile()
    {
        $database = new db();
        $database->db;

        $file_id = $_GET['file_id'];
        $query = $database->select('path','files',"WHERE id=$file_id");
        $record = mysql_fetch_assoc($query);
        $tmp = $record[path];

        $pathToFile = $tmp;

        if(unlink("$pathToFile"))
        {
            $database->delete('files',"WHERE id=$file_id");
        }
        header("Location:/files");
    }

    /****************************************/
    /**          Sharing file              **/
    /****************************************/

    public function share()
    {
        $MAIN_PATH = 'http://files/files/index/';

        $id_file = $_GET['file_id'];
        $database = new db();
        $database->db;
        $query = $database->select('*','files',"WHERE id='$id_file'");
        $record = mysql_fetch_assoc($query);

        return $MAIN_PATH.'?hash='.$record['share_link'];
    }

    /****************************************/
    /**          Download file             **/
    /****************************************/

    public function downloadFile($path = '')
    {
        if (isset($_GET['file_path']) or $path!='')
        {
            if($path != '')
            {
                $filePath = $path;
            }else
            {
                $filePath = $_GET['file_path'];
            }
            $login = $_COOKIE['login'];
            header('Content-Type: text/html; charset=utf-8');
            $filename=substr($filePath,$this->COUNT_OF_SYMBOLS_FOR_LEFT_DELETE + strlen($login) + 1);
            header("Content-Disposition: attachment; filename=".$filename);
            ob_end_clean();
            ob_start();
            echo $content;
            ob_end_flush();
            exit();
        } else {
            echo "Файл не найден.";
            exit();
        }
    }

    /****************************************/
    /**         Download file with hash    **/
    /****************************************/

    public function takeFile($fileHash)
    {
        $database = new db();
        $database->db;
        $query = $database->select('*','files',"WHERE share_link='$fileHash'");
        $record = mysql_fetch_assoc($query);

        self::downloadFile($record['path']);
    }
}

?>