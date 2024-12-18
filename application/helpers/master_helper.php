<?php
function time_elapsed_string($datetime, $full = false)
{
    $now  = new DateTime;
    $ago  = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diffInDays = $diff->d + ($diff->m * 30) + ($diff->y * 365);

    $diff->y = floor($diffInDays / 365);
    $diff->m = floor(($diffInDays % 365) / 30);
    $diff->d = $diffInDays % 30;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }

    return $string ? implode(', ', $string) . ' lalu' : 'sekarang';
}



function hp($nohp)
{
    // kadang ada penulisan no hp 0811 239 345
    $nohp = str_replace(" ", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace("(", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(")", "", $nohp);
    // kadang ada penulisan no hp 0811.239.345
    $nohp = str_replace(".", "", $nohp);

    // cek apakah no hp mengandung karakter + dan 0-9
    if (!preg_match('/[^+0-9]/', trim($nohp))) {
        // cek apakah no hp karakter 1-3 adalah +62
        if (substr(trim($nohp), 0, 3) == '+62') {
            $hp = trim($nohp);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif (substr(trim($nohp), 0, 1) == '0') {
            $hp = '+62' . substr(trim($nohp), 1);
        }
    }
    return $hp;
}

function bulan($id_bulan)
{
    switch ($id_bulan) {
        case '1':
            $strbulan = 'Januari';
            break;
        case '2':
            $strbulan = 'Februari';
            break;
        case '3':
            $strbulan = 'Maret';
            break;
        case '4':
            $strbulan = 'April';
            break;
        case '5':
            $strbulan = 'Mei';
            break;
        case '6':
            $strbulan = 'Juni';
            break;
        case '7':
            $strbulan = 'Juli';
            break;
        case '8':
            $strbulan = 'Agustus';
            break;
        case '9':
            $strbulan = 'September';
            break;
        case '10':
            $strbulan = 'Oktober';
            break;
        case '11':
            $strbulan = 'November';
            break;
        case '12':
            $strbulan = 'Desember';
            break;
        default:
            $strbulan = '';
            break;
    }
    return $strbulan;
}

function hariIndonesia($waktu)
{
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
    );

    $hr          = date('w', strtotime($waktu));
    $hari        = $hari_array[$hr];

    return $hari;
}

function formatHariTanggal($waktu)
{
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
    );
    $hr          = date('w', strtotime($waktu));
    $hari        = $hari_array[$hr];
    $tanggal     = date('j', strtotime($waktu));
    $bulan_array = array(
        1  => 'Januari',
        2  => 'Februari',
        3  => 'Maret',
        4  => 'April',
        5  => 'Mei',
        6  => 'Juni',
        7  => 'Juli',
        8  => 'Agustus',
        9  => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl    = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam   = date('H:i:s', strtotime($waktu));

    return "$hari, $tanggal $bulan $tahun";
}

function untitik($n)
{
    $output = str_replace(',', '', $n);
    return $output;
}

function singkat_angka($n, $presisi = 1)
{
    if ($n < 900) {
        $format_angka = number_format($n, $presisi);
        $simbol       = '';
    } else if ($n < 900000) {
        $format_angka = number_format($n / 1000, $presisi);
        $simbol       = 'rb';
    } else if ($n < 900000000) {
        $format_angka = number_format($n / 1000000, $presisi);
        $simbol       = 'jt';
    } else if ($n < 900000000000) {
        $format_angka = number_format($n / 1000000000, $presisi);
        $simbol       = 'M';
    } else {
        $format_angka = number_format($n / 1000000000000, $presisi);
        $simbol       = 'T';
    }

    if ($presisi > 0) {
        $pisah        = '.' . str_repeat('0', $presisi);
        $format_angka = str_replace($pisah, '', $format_angka);
    }

    return $format_angka . $simbol;
}

function tglindonesia($tanggal)
{
    if (!empty($tanggal)) {
        $ntgl = date('d', strtotime($tanggal));
        $nbln = date('m', strtotime($tanggal));
        $nthn = date('Y', strtotime($tanggal));

        switch ($nbln) {
            case '01':
                $cBln = 'Jan';
                break;
            case '02':
                $cBln = 'Feb';
                break;
            case '03':
                $cBln = 'Mar';
                break;
            case '04':
                $cBln = 'Apr';
                break;
            case '05':
                $cBln = 'Mei';
                break;
            case '06':
                $cBln = 'Jun';
                break;
            case '07':
                $cBln = 'Jul';
                break;
            case '08':
                $cBln = 'Ags';
                break;
            case '09':
                $cBln = 'Sep';
                break;
            case '10':
                $cBln = 'Okt';
                break;
            case '11':
                $cBln = 'Nov';
                break;
            default:
                $cBln = 'Des';
                break;
        }

        return $ntgl . ' ' . $cBln . ' ' . $nthn;
    } else {
        return '';
    }
}
