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
	<h3>Laporan Stok Barang Bahan Baku</h3>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 15%; text-align: center;">ID. Barang</th>
                <th style="width: 20%; text-align: center;">Nama Barang</th>
                <th style="width: 15%; text-align: center;">Jenis</th>
                <th style="width: 15%; text-align: center;">Kategori</th>
                <th style="width: 15%; text-align: center;">Harga (Rp.)</th>
                <th style="width: 15%; text-align: center;">Stok Satuan</th>
            </tr>
        </thead>
        <tbody>';

$no = 1;
if ($data->num_rows() > 0) {
	foreach ($data->result() as $row) {
		if ($row->statusaktif == 'Aktif') {
			$statusaktif = '<span class="bagde badge-success">Aktif</span>';
		} else {
			$statusaktif = '<span class="bagde badge-danger">Tidak Aktif</span>';
		}

		$table .= '
                    <tr>
                        <td style="width: 5%; text-align: center;">' . $no++ . '</td>
                        <td style="width: 15%; text-align: center;">' . '<b>' . $row->idbarang . '</b><br>' . $statusaktif . '</td>
                        <td style="width: 20%; text-align: left;">' . $row->namabarang . '</td>
                        <td style="width: 15%; text-align: left;">' . $row->nama . '</td>
                        <td style="width: 15%; text-align: left;">' . $row->namakategori . '</td>
                        <td style="width: 15%; text-align: right;">' . number_format($row->harga) . '</td>
                        <td style="width: 15%; text-align: center;">' . number_format($row->stok) . ' ' . $row->satuan . '</td>
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
