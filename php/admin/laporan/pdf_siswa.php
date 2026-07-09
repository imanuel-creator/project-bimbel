<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

require "../../../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

include "../../config/koneksi.php";

$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

$query = mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY nama ASC");

$html = '
<h2 style="text-align:center;">
LAPORAN DATA SISWA
</h2>

<table border="1" cellspacing="0" cellpadding="5" width="100%">

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>JK</th>
<th>No HP</th>
<th>Email</th>
<th>Status</th>

</tr>';

$no=1;

while($row=mysqli_fetch_assoc($query)){

$html .= '

<tr>

<td>'.$no++.'</td>

<td>'.$row['nis'].'</td>

<td>'.$row['nama'].'</td>

<td>'.$row['jenis_kelamin'].'</td>

<td>'.$row['no_hp'].'</td>

<td>'.$row['email'].'</td>

<td>'.$row['status'].'</td>

</tr>';

}

$html .= '</table>';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4','landscape');

$dompdf->render();

$dompdf->stream("laporan_siswa.pdf",["Attachment"=>false]);