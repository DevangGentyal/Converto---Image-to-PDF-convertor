<?php
if(isset($_GET['created'])){
    $file = "PDF/converto.pdf";
    header('Content-Type: application/octent-stream');
    header('Content-Disposition: attachment;filename="converto.pdf"');
    header('Content-Length: '.filesize($file));
    readfile($file);
    unlink($file);
}
?>