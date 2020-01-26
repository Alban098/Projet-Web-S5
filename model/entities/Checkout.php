<?php

namespace entities;

use DateTime;
use PDF;

class Checkout
{
    private $order;

    /**
     * Checkout constructor.
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function generate() {
        $order = $this->order;
        $pdf = null;
        if ($order != null) {
            $pdf = new PDF('P', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetFont('Helvetica', '', 11);
            $pdf->SetTextColor(0);

            $datetime = new DateTime($order->getDate());

            //Info
            $pdf->Text(8, 38, utf8_decode('N° de Commande : ' . $order->getId()));
            $pdf->Text(8, 43, utf8_decode('Date : ' . $datetime->format("d-m-Y")));
            if ($order->getStatus() == REGISTERED)
                $pdf->Text(8, 48, utf8_decode('Mode de règlement : Non Payée'));
            else
                $pdf->Text(8, 48, utf8_decode('Mode de règlement : ' . $order->getPayment()));

            //Delivery
            $deliveryInfo = $order->getAddress();
            $pdf->Text(120, 38, utf8_decode($deliveryInfo->getForename()) . ' ' . utf8_decode($deliveryInfo->getSurname()));
            $pdf->Text(120, 43, sprintf("%010d", $deliveryInfo->getPhone()));
            $pdf->Text(120, 48, utf8_decode($deliveryInfo->getEmail()));
            $pdf->Text(120, 53, utf8_decode($deliveryInfo->getAddress()));
            $pdf->Text(120, 58, sprintf("%05d", $deliveryInfo->getPostCode()).' '.$deliveryInfo->getCity());

            //Table
            $position_detail = 66;
            $pdf->SetDrawColor(183); // Couleur du fond
            $pdf->SetFillColor(221); // Couleur des filets
            $pdf->SetTextColor(0); // Couleur du texte
            $pdf->SetY($position_detail);
            $pdf->SetX(8);
            $pdf->Cell(102, 8, utf8_decode('Désignation'), 1, 0, 'L', 1);
            $pdf->SetX(110);
            $pdf->Cell(10, 8, utf8_decode('Qté'), 1, 0, 'C', 1);
            $pdf->SetX(120);
            $pdf->Cell(20, 8, utf8_decode('Prix HT'), 1, 0, 'C', 1);
            $pdf->SetX(140);
            $pdf->Cell(20, 8, utf8_decode('TVA'), 1, 0, 'C', 1);
            $pdf->SetX(160);
            $pdf->Cell(20, 8, utf8_decode('Remise'), 1, 0, 'C', 1);
            $pdf->SetX(180); // 104 + 10
            $pdf->Cell(20, 8, utf8_decode('Prix Net'), 1, 0, 'C', 1);

            $pdf->Ln();
            $position_detail = 74;
            $totHt = 0;
            foreach ($order->getItems() as $item) {
                $ht = $item->getProduct()->getPrice() * $item->getQuantity() / 1.055;
                $totHt += $ht;
                $pdf->SetY($position_detail);
                $pdf->SetX(8);
                $pdf->MultiCell(102, 8, utf8_decode($item->getProduct()->getName()), 1, 'L');
                $pdf->SetY($position_detail);
                $pdf->SetX(110);
                $pdf->MultiCell(10, 8, $item->getQuantity(), 1, 'C');
                $pdf->SetY($position_detail);
                $pdf->SetX(120);
                $pdf->MultiCell(20, 8, number_format($ht, 2, ',', ' ') . " " . chr(128), 1, 'R');
                $pdf->SetY($position_detail);
                $pdf->SetX(140);
                $pdf->MultiCell(20, 8, "5.5%", 1, 'R');
                $pdf->SetY($position_detail);
                $pdf->SetX(160);
                $pdf->MultiCell(20, 8, "0", 1, 'R');
                $pdf->SetY($position_detail);
                $pdf->SetX(180);
                $pdf->MultiCell(20, 8, number_format($item->getProduct()->getPrice() * $item->getQuantity(), 2, ',', ' ') . " " . chr(128), 1, 'R');
                $pdf->SetY($position_detail);
                $position_detail += 8;
            }

            $position_detail += 8;
            $pdf->SetDrawColor(183); // Couleur du fond
            $pdf->SetFillColor(221); // Couleur des filets
            $pdf->SetTextColor(0); // Couleur du texte
            $pdf->SetY($position_detail);
            $pdf->SetX(130);
            $pdf->Cell(40, 8, utf8_decode('Total HT'), 1, 0, 'L', 1);
            $pdf->SetX(170);
            $pdf->Cell(30, 8, number_format($totHt, 2, ",", " ") . " " . chr(128), 1, 0, 'R', 1);
            $position_detail += 8;
            $pdf->SetY($position_detail);
            $pdf->SetX(130);
            $pdf->Cell(40, 8, utf8_decode('Total TVA'), 1, 0, 'L', 1);
            $pdf->SetX(170);
            $pdf->Cell(30, 8, number_format($order->getTotal() - $totHt, 2, ",", " ") . " " . chr(128), 1, 0, 'R', 1);
            $position_detail += 8;
            $pdf->SetY($position_detail);
            $pdf->SetX(130);
            $pdf->Cell(40, 8, utf8_decode('Total TTC'), 1, 0, 'L', 1);
            $pdf->SetX(170);
            $pdf->Cell(30, 8, number_format($order->getTotal(), 2, ",", " ") . " " . chr(128), 1, 0, 'R', 1);
        }
        return $pdf;
    }
}