<?php  

$data = [
	"20 Agustus 2018" => [
		"negatif" => rand(1, 6000),
		"positif" => rand(1, 6000),
		"netral" => rand(1, 6000)
	],
	"21 Agustus 2018" => [
		"negatif" => rand(1, 6000),
		"positif" => rand(1, 6000),
		"netral" => rand(1, 6000)	
	],
	"22 Agustus 2018" => [
		"negatif" => rand(1, 6000),
		"positif" => rand(1, 6000),
		"netral" => rand(1, 6000)
	],
	"24 Agustus 2018" => [
		"negatif" => rand(1, 6000),
		"positif" => rand(1, 6000),
		"netral" => rand(1, 6000)
	]
];

$topics = [
	"ganti presiden",
	"jokowi dodo",
	"prabowo subianto",
	"suporter sepakbola",
	"abdul somad",
	"xiaomi meledak",
	"dollar melonjak",
	"perdagangan organ",
	"pengusaha bangkrut",
	"siswi bunuh diri"
];
$no = 1;
$accounts = [
	["1314156", "@maspiyu", "Mas Piyu Ganteng"],
	["1329410", "@esbatugoreng", "Suradi Sang Penjual Es Batu"],
	["1782919", "<i>no username</i>", "Saprapto"],
	["1562111", "@rtgggmmm", "Rotringue Onoderka"],
	["1050121", "@vasco_leer", "Vasco dot Leer"],
	["2815403", "@peterjkambey", "Peter Jack Kambey"],
	["4715403", "@thamura999", "Frans Thamura"],
	["4815301", "@sosispanggang", "Farah Clarasinta Rahmady"],
	["2145678", "<i>no username</i>", "Es Dawet"],
	["3375699", "@kimiamania", "Rezha Julio"],
];
?><!DOCTYPE html>
<html>
<head>
	<title>Laporan Telegram Monitoring</title>
	<style type="text/css">
		* {
			font-family: Arial;
		}
		.dt {
			padding: 5px;
		}
		.ib {
			display: inline-block;
		}
		.jd {
			margin-top: 25px;
			border: 1px solid #000;
			height: 240px;
			width: 700px;
		}
		.jd2 {
			margin-top: 25px;
			border: 1px solid #000;
			height: auto;
			padding-bottom: 20px;
			width: 285px;
		}
		.jd3 {
			margin-top: -175px;
			margin-left: -290px;
			border: 1px solid #000;
			height: auto;
			padding-bottom: 20px;
			width: 700px;
		}
	</style>
</head>
<body>
	<center>
		<h1>Laporan Telegram Monitoring</h1>
		<h2>20 Agustus 2018 sampai 24 Agustus 2018</h2>
		<div class="ib jd">
			<h2>Jumlah Pesan dan Sentimennya</h2>
			<table border="1" style="border-collapse: collapse;">
				<tr>
					<td class="dt"></td>
					<?php
					$negatif = $positif = $netral = $total = "";
					foreach ($data as $key => $value) {
						$td = "<td class=\"dt\" align=\"center\">";
						?><td class="dt" align="center"><?php print $key; ?></td><?php
						$negatif .= $td.$value["negatif"]."</td>";
						$positif .= $td.$value["positif"]."</td>";
						$netral  .= $td.$value["netral"]."</td>";
						$total .= $td.($value["negatif"] + $value["positif"] + $value["netral"])."</td>";
					}
					?>
				</tr>
				<tr>
					<td class="dt" align="center">Sentimen Negatif</td>
					<?php print $negatif; ?>
				</tr>
				<tr>
					<td class="dt" align="center">Sentimen Positif</td>
					<?php print $positif; ?>
				</tr>
				<tr>
					<td class="dt" align="center">Sentimen Netral</td>
					<?php print $netral; ?>
				</tr>
				<tr>
					<td class="dt" align="center">Total</td>
					<?php print $total; ?>
				</tr>
			</table>
		</div>
		<div class="ib jd2">
			<h2>Topik yang Dibicarakan</h2>
			<table border="1" style="border-collapse: collapse;">
				<tr><td class="dt" align="center">No.</td><td class="dt" align="center">Topik</td></tr>
				<?php foreach($topics as $topic): ?>
					<tr>
						<td class="dt" align="center"><?php print $no++; ?>.</td>
						<td class="dt" align="center"><?php print $topic; ?></td>
					</tr>
				<?php endforeach; $no = 1;?>
			</table>
		</div>
		<div class="jd3">
			<h2>10 Akun Pengirim Pesan Terbanyak</h2>
			<table border="1" style="border-collapse: collapse;">
				<tr><td class="dt" align="center">No.</td><td class="dt" align="center">User ID</td><td class="dt" align="center">Username</td><td class="dt" align="center">Nama Akun</td></tr>
				<?php foreach($accounts as $account): ?>
					<tr>
						<td class="dt" align="center"><?php print $no++; ?>.</td>
						<td class="dt" align="center"><?php print $account[0]; ?></td>
						<td class="dt" align="center"><?php print $account[1]; ?></td>
						<td class="dt" align="center"><?php print $account[2]; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</center>
</body>
</html>