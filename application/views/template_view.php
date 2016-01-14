<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Files</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <script src="/js/jquery-1.6.2.js" type="text/javascript"></script>
    <script src="/js/javascript.js" type="text/javascript"></script>
</head>
<body>
    <div class="wrapper">
        <header>
            <a href="/">
                <img src="/images/files-icon.jpg"/>
                <h1>Files</h1>
            </a>
            <?
                if(isset($_COOKIE['login']))
                {
                    ?>
                        <div class="currentLogin">
                            <span>
                                <?=$_COOKIE['login']?>
                            </span>
                            <a href="/user/logout">Logout</a>
                        </div>
                    <?
                }
            ?>
        </header>
        <div class="main">
            <div class="content">
                <?php include 'application/views/'.$content_view; ?>
            </div>
        </div>
        <footer>
            Yurii levkovich &copy; 2015
        </footer>
    </div>
</body>
</html>