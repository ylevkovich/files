<form enctype="multipart/form-data" action="files/upload" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
<!--    --><?// $form['userfile'] = array('#type'=> 'file','#value'=>'+')?>
    <input name="userfile" type="file" value="+"/>
    <input type="submit" value="Загрузить"/>
</form>

<div class="fileList">
    <table>
        <?php
        $COUNT_OF_SYMBOLS_FOR_LEFT_DELETE = 7;
        $login = $_COOKIE['login'];
        foreach($data as $key => $value)
        {
            $path = $value['path'];
            $filename = substr($path, $COUNT_OF_SYMBOLS_FOR_LEFT_DELETE + strlen($login) + 1);
            ?>
            <tr>
            <td>
            <span>
                <?= $filename ?><?= ' (' . filesize("upload/$login/$filename") . ' bytes)' ?>
            </span>
            </td>
            <td>
                <a href="files/downloadFile/?file_path=<?= $path ?>">
                    <img src="../images/download.jpg"/>
                </a>
            </td>
            <td>
                <a href="files/delFile/?file_id=<?= $value['id'] ?>">
                    <img src="../images/del.png"/>
                </a>
            </td>
            <td>
                <a href="files/share/?file_id=<?= $value['id'] ?>">
                    <img src="../images/share.png"/>
                </a>
            </td>
            </tr><?
        }
        ?>
    </table>
</div>
