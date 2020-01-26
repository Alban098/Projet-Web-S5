<?php
require('fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->Image('assets/img/logo.png',8,2,80);
        $this->Ln(20);
    }
    function Footer() {
        $this->SetY(-15);
        $this->Cell(196,5,'ISIWEB4SHOP',0,0,'C');
    }
}
?>