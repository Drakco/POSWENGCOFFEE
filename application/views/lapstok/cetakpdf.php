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
    
    <h4 style="font-size:16px;">Laporan Stok</h4>

    <table border="0" cellpadding="2">
        <tbody>
            <tr>
                <td style="width: 100%; font-size: 14px;">' . strtoupper($namakategori) . '</td>
            </tr>
            <tr>
                <td style="width:100%"></td>
            </tr>
        </tbody>
    </table>


    <table border="1" cellpadding="5">
        <thead>
            <tr style="background-color:#ccc;">
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 13%; text-align: center;">ID. Produk</th>
                <th style="width: 16%; text-align: center;">Nama Produk</th>
                <th style="width: 14%; text-align: center;">Kategori</th>
                <th style="width: 10%; text-align: center;">Stok</th>
                <th style="width: 10%; text-align: center;">Satuan</th>
                <th style="width: 16%; text-align: center;">Harga Beli</th>
                <th style="width: 16%; text-align: center;">Harga Jual</th>
            </tr>
        </thead>
        <tbody>';

$no = 1;
if ($data->num_rows() > 0) {
    foreach ($data->result() as $row) {
        
        $table .='
            <tr>
                <td style="width: 5%; text-align: center;">'.$no++.'</td>
                <td style="width: 13%; text-align: center;">'.$row->idproduk.'</td>
                <td style="width: 16%; text-align:left;">'.$row->namaproduk.'</td>
                <td style="width: 14%; text-align:left;">'.$row->namakategori.'</td>
                <td style="width: 10%; text-align: center;">'.$row->stok.'</td>
                <td style="width: 10%; text-align: center;">'.$row->satuan.'</td>
                <td style="width: 16%; text-align: right;">Rp.'.number_format($row->hargabeli).'</td>
                <td style="width: 16%; text-align: right;">Rp.'.number_format($row->hargajual).'</td>
            </tr>
        ';

    }
}

$table .= '

        </tbody>
    </table>
';

$pdf->SetTopMargin(35);
$pdf->SetFont('times', '', 9);
$pdf->writeHTML($table, true, false, false, false, '');

$tglcetak = date('d-m-Y');

$pdf->Output();
