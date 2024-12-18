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
                        ' . strtoupper($dataPerusahaan) . ' <br>
                        <i style="font-size:11px; color: ##CFCFCF;">' . $dataPerusahaanDetil . '</i>
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
    <h3>Laporan Perencanaan Bisnis</h3>

    <table border="0" cellpadding="2">
        <tbody>
            <tr>
                <td style="width: 100%;">' . implode(" ", $dataFilter) . '</td>
            </tr>
            <tr>
                <td style="width: 100%;">STATUS PERENCANAAN : ' . strtoupper($namastatusperencanaan) . '</td>
            </tr>
            <tr>
                <td style="width: 100%;"></td>
            </tr>
        </tbody>
    </table>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th style="width: 5%; text-align:center;">No</th>
                <th style="width: 10%; text-align: center;">ID. Perencanaan</th>
                <th style="width: 11%; text-align: center;">Tanggal</th>
                <th style="width: 15%; text-align: center;">Jenis</th>
                <th style="width: 25%; text-align: center;">Nama</th>
                <th style="width: 22%; text-align: center;">Tujuan</th>
                <th style="width: 12%; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>';

$totalSedangDiproses = 0;
$totalSudahDiproses = 0;

$no = 1;
if ($data->num_rows() > 0) {
    foreach ($data->result() as $row) {

        $table .= '
            <tr>
                <td style="width: 5%; text-align:center;">' . $no++ . '</td>
                <td style="width: 10%; text-align: center;">' . $row->idperencanaan . '</td>
                <td style="width: 11%; text-align: left;">' . formatHariTanggal(date('Y-m-d', strtotime($row->tglperencanaan))) . '</td>
                <td style="width: 15%; text-align: left;">' . $row->jenis . '</td>
                <td style="width: 25%; text-align: left;">' . $row->nama . '</td>
                <td style="width: 22%; text-align: left;">' . $row->tujuan . '</td>
                <td style="width: 12%; text-align: center;">' . $row->statusperencanaan . '</td>
            </tr>
        ';

        if ($row->statusperencanaan == 'Sudah Diproses') {
            $totalSudahDiproses++;
        } else {
            $totalSedangDiproses++;
        }
    }
}


$table .= '
                    <tr>
                        <td style="width: 88%; text-align:right; font-weight: bold;" colspan="5">Total Sedang Diproses :</td>
                        <td style="width: 12%; text-align:right;">' . number_format($totalSedangDiproses) . '</td>
                    </tr>
                    <tr>
                        <td style="width: 88%; text-align:right; font-weight: bold;" colspan="5">Total Sudah Diproses :</td>
                        <td style="width: 12%; text-align:right;">' . number_format($totalSudahDiproses) . '</td>
                    </tr>

                ';

$table .= '

        </tbody>
    </table>
';

$pdf->SetTopMargin(35);
$pdf->SetFont('times', '', 8);
$pdf->writeHTML($table, true, false, false, false, '');

$tglcetak = date('d-m-Y');

$pdf->Output();
