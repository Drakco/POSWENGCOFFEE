<html>

<head>
    <title>Faktur Pembayaran</title>
    <style>
    #tabel {
        font-size: 15px;
        border-collapse: collapse;
    }

    #tabel td {
        padding-left: 5px;
        border: 1px solid black;
    }

    hr {
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
    }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;'>

    <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr>
                <td width='70%' align='CENTER' vertical-align:top colspan="3">
                    <span style='color:black;'>
                        <b><?php echo($dataPerusahaan->namaperusahaan); ?></b></br>
                        <i style="font-size: 10pt">
                            <?php echo($dataPerusahaanKontak->alamat); ?>
                        </i>
                    </span>
                    <hr style="display: block; margin-top: 0px;">
                </td>
            </tr>
            <tr>
                <td style="width: 50%; font-size: 10pt">
                    <?php echo(formatHariTanggal(date('Y-m-d', strtotime($dataID->tglpenjualan))).' '.date('H:i', strtotime($dataID->tglpenjualan))) ?>
                </td>
                <td style="width: 20%; font-size: 10pt; text-align: right;">
                    Kasir
                </td>
                <td style="width: 30%; font-size: 10pt; text-align: right;">
                    <?php echo($dataID->namapengguna) ?>
                </td>
            </tr>
            <tr>
                <td style="width: 50%; font-size: 10pt">
                    IVC-<?php echo($dataID->idpenjualan); ?>
                </td>
                <td style="width: 20%; font-size: 10pt; text-align: right;">
                    Customer
                </td>
                <td style="width: 30%; font-size: 10pt; text-align: right;">
                    <?php 
				if (!empty($dataID->idpelanggan)) {
					echo $dataID->namapelanggan;
				}else{
					echo "PELANGGAN UMUM";
				}
				?>
                </td>
            </tr>
        </table>
        <br>


        <table cellspacing='0' cellpadding='0'
            style='width:350px; font-size:10pt; font-family:calibri;  border-collapse: collapse; display:none;'
            border='0'>
            <tr>
                <td width='40%'>Service</td>
                <td width='60%' style="text-align:right;">Harga (Rp.)</td>
            </tr>
            <?php 
		if ($dataDetailService->num_rows() > 0) {
			foreach ($dataDetailService->result() as $rowService) { ?>
            <tr>
                <td><?php echo $rowService->namatarif; ?></td>
                <td style="text-align:right;"><?php echo number_format($rowService->harga); ?></td>
            </tr>
            <?php
			}
		}
		?>
            <tr>
                <td>
                    <div style='text-align:right; color:black'>Sub. Total Service: </div>
                </td>
                <td style='text-align:right; font-size:13pt; color:black'>
                    <?php echo('Rp. '.number_format($dataID->totalhargaservice)); ?></td>
            </tr>
        </table>

        <br><br>


        <table cellspacing='0' cellpadding='0'
            style='width:350px; font-size:10pt; font-family:calibri;  border-collapse: collapse;' border='0'>
            <tr align='center'>
                <td width='16%'>Item</td>
                <td width='13%'>Harga (Rp.)</td>
                <td width='4%'>Qty</td>
                <td width='13%'>Diskon</td>
                <td width='13%'>Total</td>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
            </tr>
            <?php 
		if ($dataDetail->num_rows() > 0) {
			foreach ($dataDetail->result() as $row) { ?>
            <tr>
                <td style='font-size: 9pt; vertical-align:top'><?php echo($row->namaproduk); ?></td>
                <td style='font-size: 9pt; vertical-align:top; text-align:right; padding-right:10px'>
                    <?php echo(number_format($row->hargajual)) ?>
                </td>
                <td style='font-size: 9pt; vertical-align:top; text-align:right; padding-right:10px'>
                    <?php echo(number_format($row->qty)); ?>
                </td>
                <td style='font-size: 9pt; vertical-align:top; text-align:right; padding-right:10px'>
                    <?php echo(number_format($row->diskon)); ?>
                </td>
                <td style='font-size: 9pt; text-align:right; vertical-align:top'>
                    <?php echo(number_format($row->totalharga)); ?>
                </td>
            </tr>
            <tr>
                <?php
			}
		}
		 ?>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan='3'>
                    <div style='text-align:right; color:black'>Sub. Total : </div>
                </td>
                <td colspan="2" style='text-align:right; font-size:13pt; color:black'>
                    <?php echo('Rp. '.number_format($dataID->totalharga)); ?></td>
            </tr>
            <tr>
                <td colspan='3'>
                    <div style='text-align:right; color:black'>Diskon : </div>
                </td>
                <td colspan="2" style='text-align:right; font-size:13pt; color:black'>
                    <?php echo('Rp. '.number_format($dataID->diskon)); ?></td>
            </tr>
            <tr>
                <td colspan='3'>
                    <div style='text-align:right; color:black'>Grand Total : </div>
                </td>
                <td colspan="2" style='text-align:right; font-size:13pt; color:black'>
                    <?php 
				$grandTotal = $dataID->grandtotal;

				$hasil = $grandTotal; 
				echo('Rp. '.number_format($hasil)); 
			?>
                </td>
            </tr>
        </table>

        <br>
        <img src="<?php echo(base_url('uploads/qrcode_penjualan/'.$dataID->qrcode.'.png')); ?>" alt=""
            style="display: block; margin: 0 auto; height: 100px; width: auto;">

        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr>
                </br>
                <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
        </table>
    </center>

    <script type="text/javascript">
    window.print();
    </script>

</body>

</html>