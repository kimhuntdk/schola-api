<?php
if(isset($_POST['chk'])){
    echo '<h3>Selected Data:</h3>';
    echo '<ul>';
    foreach($_POST['chk'] as $selected){
        // เพิ่มเงื่อนไขเช็คว่ามี attribute data-title และ data-link หรือไม่
        if(isset($_POST['title'][$selected]) && isset($_POST['link'][$selected])){
            $title = $_POST['title'][$selected];
            $link = $_POST['link'][$selected];
            $snippet = $_POST['snippet'][$selected];
            $publication_info = $_POST['publication_info'][$selected];
            echo '<li><a href="' . $link . '" target="_blank">' . $title . '</a></li>';
            echo $snippet;
            echo $publication_info;
            echo $link;
        }
    }
    echo '</ul>';
}
?>
