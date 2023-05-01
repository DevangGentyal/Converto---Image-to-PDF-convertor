<?php
if (isset($_POST['download'])) {
    $fileLen = count($_FILES['file']['name']);
    if ($fileLen > 10) {
        printf("<script>alert('Only 10 images are allowed!');</script>");
        exit();

    } else {
        require('FPDF.php');
        $pdf = new FPDF();
        $i = 0;
        while ($i < $fileLen) {
            $imgname = $_FILES['file']['name'][$i];
            $tmpimg = $_FILES['file']['tmp_name'][$i];
            $dimension = getimagesize($tmpimg);
            $width = $dimension[0];
            $height = $dimension[1];
            $path = "images/";
            move_uploaded_file($tmpimg, $path . $imgname);
            $imgpath = $path . $imgname;
            
                $pdf->AddPage();
                // Calculating fields for adding an Image in center of the Pdf perfectly
                $centerX = $pdf->GetPageWidth() / 2;
                $centerY = $pdf->GetPageHeight() / 2;
                if ($width >= $height) {
                $pdfWidth = $pdf->GetPageWidth() * 0.8; // use 80% of the page width
                $pdfHeight = $height / $width * $pdfWidth;
                }
                else{
                    $pdfHeight = $pdf->GetPageHeight() * 0.8; // use 80% of the page height
                    $pdfWidth = $width / $height * $pdfHeight;
                }
                $imageX = $centerX - $pdfWidth / 2;
                $imageY = $centerY - $pdfHeight / 2;

                $pdf->Image($imgpath,$imageX, $imageY, $pdfWidth, $pdfHeight);
            unlink($imgpath);
            $i++;
        }
        $pdfpath = "PDF/converto.pdf";
        $pdf->Output('f', $pdfpath);
        header('Location:download.php?created=1');
    }
    exit;
}

?>