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
	<h3>Laporan Barang Bahan Baku Keluar</h3>
    <table border="0" cellpadding="2">
        <tbody>
            <tr>
                <td style="width: 100%;">' . implode(" - ", $dataFilter) . '</td>
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
                <th style="width: 10%; text-align: center;">ID. Outgoing</th>
                <th style="width: 13%; text-align: center;">Tanggal</th>
                <th style="width: 25%; text-align: center;">Keterangan</th>
                <th style="width: 37%; text-align: center;">Detil Barang</th>
                <th style="width: 10%; text-align: center;">Total Harga <br>(Rp.)</th>
            </tr>
        </thead>
        <tbody>';

$no    = 1;
$total = 0;
if ($data->num_rows() > 0) {
	foreach ($data->result() as $row) {

		$dataDetail = array();
		$query      = $this->db->query("SELECT * FROM v_barangkeluar_detail WHERE idbarangkeluar='$row->idbarangkeluar' ORDER BY namabarang ");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $rowDetail) {

				array_push(
					$dataDetail,
					"<span style='text-align:right;'><b>" . $rowDetail->namabarang . "</b> " . number_format($rowDetail->qty) . ' / ' . $rowDetail->satuan . ' x Rp. ' . number_format($rowDetail->harga) . ' = Rp. ' . number_format($rowDetail->totalharga) . '</span>'
				);
			}
		}

		$table .= '
            <tr>
                <td style="width: 5%; text-align:center;">' . $no++ . '</td>
                <td style="width: 10%; text-align: center;">' . '<b>' . $row->idbarangkeluar . '</b></td>
                <td style="width: 13%; text-align: center;">' . formatHariTanggal($row->tglbarangkeluar) . '</td>
                <td style="width: 25%; text-align: left;">' . $row->keterangan . '</td>
                <td style="width: 37%; text-align: left;"><span style="font-size: 10px;">' . implode('<br>', $dataDetail) . '</span></td>
                <td style="width: 10%; text-align: right;">' . number_format($row->totalharga) . '</td>
                
            </tr>

        ';
		$total += $row->totalharga;
	}
}

$table .= '
                    <tr>
                        <td style="width: 83%; text-align:right; font-weight: bold;" colspan="6">Total :</td>
                        <td style="width: 17%; text-align:right;">Rp. ' . number_format($total) . '</td>
                    </tr>

                ';

$table .= '

        </tbody>
    </table>
';

$pdf->SetTopMargin(35);
$pdf->SetFont('times', '', 10);
$pdf->writeHTML($table, true, false, false, false, '');

$tglcetak = date('d-m-Y');

$pdf->Output();
