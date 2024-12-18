<?php

class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {

        $this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $this->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set margins
        //$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->SetMargins(PDF_MARGIN_LEFT, 3, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default header data

        // $cop = '
        //     <div></div>
        //         <table border="0">
        //             <tr>

        //                 <td width="100%">
        //                     <div style="text-align:center; font-size:24px; font-weight:bold; padding-top:10px;">PT. Swara Rodja Pontianak</div>
        //                 </td>

        //             </tr>
        //         </table>

        //         ';

        //     $this->writeHTML($cop, true, false, false, false, '');
        //     // set margins
        //     //$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //     $this->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
        //     $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        // set default header data

    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 5, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->AddPage();

$pdf->SetTopMargin(0);
$title = '
    <table style="" border="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="width:100%; text-align:center;">
                    <span style="font-weight: bold; font-size:18px; color:##CFCFCF; ">
                        '.strtoupper($dataPerusahaan).' <br>
                        Sistem Informasi Pemesanan & Penjualan <br>
                        <i style="font-size:11px; color: ##CFCFCF;">'.$dataPerusahaanDetil.'</i>
                    </span>                    
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
';
$pdf->SetFont('times', '', 15);
$pdf->writeHTML($title, true, false, false, false, '');
$pdf->SetTopMargin(0);

$table = '
    
    <h4 style="font-size:16px;">Laporan Pendapatan Kotor</h4>

    <table border="0" cellpadding="2">
        <tbody>
            <tr>
                <td style="width: 100%;">' . implode(", ", $dataFilter) . '</td>
            </tr>

            <tr>
                <td style="width: 100%;"></td>
            </tr>
        </tbody>
    </table>


    <table border="1" cellpadding="5">
        <thead>
            <tr style="background-color:#ccc;">
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 15%; text-align: center;">ID. /<br>ID. Produk</th>
                <th style="width: 15%; text-align: center;">Tanggal /<br>Kategori</th>
                <th style="width: 17%; text-align: center;">Status /<br>Qty</th>
                <th style="width: 16%; text-align: center;">Total Harga Jual (Rp.) /<br>Total Harga (Rp.)</th>
                <th style="width: 16%; text-align: center;">Total Diskon (Rp.) /<br>Diskon (Rp.)</th>
                <th style="width: 16%; text-align: center;">Total Harga (Rp.)</th>
            </tr>
        </thead>
        <tbody>';

$no = 1;
$grand_total_hargajual  = 0;
$grand_total_diskon     = 0;
$grand_total_harga      = 0;

foreach ($data->result() as $row) {
    $totalharga = 0;
    $totalharga = $row->totalharga_jual - $row->totalharga_diskon;
    $table .= '
        <tr style="background-color:#eee;">
            <td style="width: 5%; text-align: center;">'.$no++.'</td>
            <td style="width: 15%; text-align: left;">'.$row->id.'</td>
            <td style="width: 15%; text-align: left;">'.formatHariTanggal(date('Y-m-d', strtotime($row->tanggal))).'<br>Jam '.date('H:i', strtotime($row->tanggal)).'</td>
            <td style="width: 17%; text-align: left;">'.$row->status.'</td>
            <td style="width: 16%; text-align: right;">Rp. '.number_format($row->totalharga_jual).'</td>
            <td style="width: 16%; text-align: right;">Rp. '.number_format($row->totalharga_diskon).'</td>
            <td style="width: 16%; text-align: right;">Rp. '.number_format($totalharga).'</td>
        </tr>
    ';

    $grand_total_hargajual  += $row->totalharga_jual;
    $grand_total_diskon     += $row->totalharga_diskon;
    $grand_total_harga      += $totalharga;

    $dataDetil = $this->LapPendapatanKotor_model->getLaporanDetil($row->id);
    if ($dataDetil->num_rows() > 0) {
        foreach ($dataDetil->result() as $rowDetil) {
            $totalharga_jual_detil = 0;
            $totalharga_jual_detil = $rowDetil->qty * $rowDetil->hargajual;
            $table .= '
                <tr>
                    <td style="width: 5%; text-align: center;"></td>
                    <td style="width: 15%; text-align: right;">'.$rowDetil->idproduk.'</td>
                    <td style="width: 15%; text-align: right;">'.$rowDetil->namakategori.'</td>
                    <td style="width: 17%; text-align: right;">'.$rowDetil->qty.' x Rp. '.number_format($rowDetil->hargajual).'</td>
                    <td style="width: 16%; text-align: left;">Rp. '.number_format($totalharga_jual_detil).'</td>
                    <td style="width: 16%; text-align: left;">Rp. '.number_format($rowDetil->diskon).'</td>
                    <td style="width: 16%; text-align: right;"></td>
                </tr>
            ';
        }
    }


}


$table .= '
            <tr style="font-weight: bold; background-color: #ddd;">
                <th style="width: 52%; text-align: right;">Grand Total : </th>
                <th style="width: 16%; text-align: right;">Rp. '.number_format($grand_total_hargajual).'</th>
                <th style="width: 16%; text-align: right;">Rp. '.number_format($grand_total_diskon).'</th>
                <th style="width: 16%; text-align: right;">Rp. '.number_format($grand_total_harga).'</th>
            </tr>
        </tbody>
    </table>
';

$pdf->SetTopMargin(35);
$pdf->SetFont('times', '', 9);
$pdf->writeHTML($table, true, false, false, false, '');

$tglcetak = date('d-m-Y');

$pdf->Output();
