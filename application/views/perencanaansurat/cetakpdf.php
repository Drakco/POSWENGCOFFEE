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
        //                     <div style="text-align:center; font-size:24px; font-weight:bold; padding-top:11px;">PT. Swara Rodja Pontianak</div>
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
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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

    <table border="0" cellpadding="1">
        <tbody>
            <tr>
                <td style="width: 65%; font-size: 11px;"></td>
                <td style="width: 35%; font-size: 11px; text-align: right;">' . $dataProfil->namaperusahaan . '</td>
            </tr>
            <tr>
                <td style="width: 65%; font-size: 11px;"></td>
                <td style="width: 35%; font-size: 11px; text-align: right;"><i>' . $dataProfilKontak->alamat . '</i></td>
            </tr>
            <tr>
                <td style="width: 65%; font-size: 11px;"></td>
                <td style="width: 35%; font-size: 11px; text-align: right;">' . formatHariTanggal($dataId->tglperencanaansurat) . '</td>
            </tr>
            <tr>
                <td style="width: 65%; font-size: 11px;">' . $dataId->namaperusahaan . '</td>
                <td style="width: 35%; font-size: 11px; text-align: right;"></td>
            </tr>
            <tr>
                <td style="width: 65%; font-size: 11px;"><i>' . $dataId->alamat . '</i></td>
                <td style="width: 35%; font-size: 11px; text-align: right;"></td>
            </tr>
            <tr>
                <td style="width: 65%; font-size: 11px;">' . $dataId->kota . ', Kode Pos : ' . $dataId->kodepos . '</td>
                <td style="width: 35%; font-size: 11px; text-align: right;"></td>
            </tr>
            <tr>
                <td style="width:100%"></td>
            </tr>
            <tr>
                <td style="width: 65%; font-size: 11px;">PERIHAL : ' . $dataId->perihal . '</td>
                <td style="width: 35%; font-size: 11px; text-align: right;"></td>
            </tr>
            <tr>
                <td style="width:100%"></td>
            </tr>
            <tr>
                <td style="width:100%">' . $dataId->keterangan . '</td>
            </tr>
            <tr>
                <td style="width:100%"></td>
            </tr>
            <tr>
                <td style="width: 70%; font-size: 11px;"></td>
                <td style="width: 30%; font-size: 11px; text-align: center;">Hormat Kami,</td>
            </tr>
            <tr>
                <td style="width: 70%; font-size: 11px;"></td>
                <td style="width: 30%; font-size: 11px; text-align: center;">' . $dataProfil->namaperusahaan . '</td>
            </tr>
            <tr>
                <td style="width: 70%; font-size: 11px;"></td>
                <td style="width: 30%; font-size: 11px; text-align: left;"></td>
            </tr>
            <tr>
                <td style="width: 70%; font-size: 11px;"></td>
                <td style="width: 30%; font-size: 11px; text-align: left;"></td>
            </tr>
            <tr>
                <td style="width: 70%; font-size: 11px;"></td>
                <td style="width: 30%; font-size: 11px; text-align: left;"></td>
            </tr>
            <tr>
                <td style="width: 70%; font-size: 11px;"></td>
                <td style="width: 30%; font-size: 11px; text-align: center;"><u><b>' . $dataId->namapimpinan . '</b></u></td>
            </tr>
            <tr>
                <td style="width: 70%; font-size: 11px;"></td>
                <td style="width: 30%; font-size: 11px; text-align: center;">' . strtoupper($dataId->levelpimpinan) . '</td>
            </tr>
        </tbody>
    </table>


';

$pdf->SetTopMargin(15);
$pdf->SetFont('times', '', 9);
$pdf->writeHTML($table, true, false, false, false, '');

$tglcetak = date('d-m-Y');

$pdf->Output();
