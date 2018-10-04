<?php

namespace TelegramDaemon;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @package \TelegramDaemon
 * @license MIT
 * @version 0.0.1
 */
class TopicExtractor
{
	public const VERBS_IGNORE = ["acak","aduk","akhir","antar","ambil","ampun","angkat","ancam","arak","atur","bakar","banting","bentak","bisik","bingkai","bentang","bangun","bonceng","bunuh","cakar","centang","contek","dapat","dengar","datang","makan","minum","tidur","tuduh","tindih","timpah","topang","tolong","tusuk","turun","tumpah","tukar","tumbur","tunjang","tekan","todong","tambal","timpah","tembak","tembus","tendang","datang","dulang","hilang","hancur","hantar","hambat","hisap","pukul","pancung","potong","petik","putar","pisah","poles","pikat","lihat","dengar","sumpah","pegang","tekuk","tarik","ulur","buat","umbar","ungkap","undang","umpat","tunda","tukar","ungkit","usap","tiup","mengacak","mengaduk","diakhiri","diantar","disirami","dikurung","dilihat","menulis","mengalah","mendaftar","memanggil","menggeliat","menyimpan","menangkis","melompat","melanggar","melangkah","menyambungkan","menyita","mengangkat","bekerja","berbagi","belajar","berkelahi","berkobar","berusaha","berangkat","beradu","berandai","beranggapan","berangkulan","berkoordinasi","berkalung","berobat","terobati","berkarya","mengupayakan","mengusahakan","menghabiskan","menggeluti","mengakali","memandu","mengobarkan","mengirimi","menargetkan","menyebrangi","terangkat","terbuai","meracuni","melindugi","melestarikan","melakoni","meyarankan","terkoyak","terlatih","tersimpan","terpikat","terbakar","terpandang","terluka","menari","berkerja","tertawa","membeli","memotong","menyiram","menempelkan","mengangkat","menaiki","menuruni","memanggil","menyeret","melihat","melompati","melangkahi","mendahului","memeluk","menyimpan","mencium","mengaduk","menabrak","merapikan","menanggulangi","menagih","mengerjakan","melampuai","memperbaiki","merusak","mengurangi","mempersoalkan","memperbesar","memperkecil","menambahkan","menajamkan","menangkal","menanam","menebang","mencampur","mengaduk","meracik","merangkai","merampok","merantai","merombak","menyunting","melamar","mengukur","melemparkan","melancarkan","memperlambat","mempercepat","memperkarakan","memperbesar","memperbaharui","merampungkan","menyelesaikan","memperburuk","mewarnai","menjaga","menghasut","menggoreng","merebus","mengkukus","meringkas","memperjelaskan","mempengaruhi","mengasingkan","mendonasikan","mengguncang","menggeser","mengkorbankan","mengkebiri","menernak","membudidayakan","menitipkan","mengarahkan","menguji","membimbing","menikahi","menikahkan","menggugat","menembak","mengarahkan","merobohkan","memasukan","mengeluarkan","mendatangkan","memulangkan","meminjami","mengatasi","mengobati","menjemput","mengantar","mendanai","mengatur","memukul","menipu","menendang","menghukum","menyambut","mencukur","menjilati","merasakan","menyambung","menyulam","menyuling","menyalahkan","mencuri","menyampaikan","mengalahkan","menyarankan","menyalurkan","menyilang","memarahi","menyayangi","mengadu","menambal","memborong","mendaftarkan","mengingkari","menyalahgunakan","mendirikan","memupuk","melihat","menggores","menyukai","mencintai","membenci","membakar","memfitnah","menjual","membeli","mendesain","menemui","mendonor","menggelapkan","menggulingkan","mengikis","mengosongkan","memenuhi","memperkenalkan","memperjuangkan","melawan","menjumpai","menemukan","menemui","menjinakan","menghasilkan","mengisahkan","menceritakan","mengumumkan","menyebarkan","menduakan","menyatakan","mengkonfirmasi","meliput","mewawancarai","menyuruh","meminta","memenjarakan","mengkaramkan","meracuni","merakit","merangkai","merasuki","merapikan","merangkul","meratapi","merampungkan","meruntuhkan","meruntut","merusuhi","mencampuri","menghidupkan","mematikan","mengoperasikan","mengendarai","menghargai","menghormati","menggolongkan","mengelompokan","meyulitkan","menyalami","meluncurkan","menjerumuskan","menyoroti","membahas","menerangkan","menularkan","menyemangati","merapatkan","menarik","mendidik","mengajarkan","menyelami","menuangkan","memerankan","meyunting","meresensi","menjabarkan","menganalisa","memikirkan","menyelimuti","menyanyikan","menuliskan","menyepelekan","merawat","menasehati","menyikapi","mendoakan","menyelarasakan","mengatur","menyuntik","mengoperasi","menggerogoti","mengumpamakan","memimpikan","mendorong","mengentengkan","menggetarkan","mengorbankan","mengasihi","merintis","menyeret","menyangkal","menyiratkan","menyerukan","menyejukan","membinasakan","membubarkan","membasahi","mengeringkan","mencuci","menggilas","menyetrika","menyerobot","mendobrak","memperistrikan","memperijinkan","memejamkan","mengatkan","menginformasikan","mengumumkan","merusuhi","merakit","mengunjungi","mengyampingkan","mengiklankan","menyebutkan","mengumpulkan","mengkoleksi","menyukai","menunda","mengawali","merencanakan","merugikan","memanfaatkan","memandikan","menangis","tersenyum","tertawa","terungkap","tertimpah","tergores","terharu","terjaga","terawat","tertindih","terlupakan","terabaikan","terkelupas","tembus","terkena","terbuai","teriris","terdiam","bersedih","berlari","berorban","berjuang","berlindung","berkata","berikrar","berjanji","berkilah","berjasa","berlomba","berkarya","berbusana","berpakaian","duduk","tidur","makan","mandi","bermain","berdiri","berbaring","berjubah","berteman","bercerita","berandai","berkuasa","begadang","berkumpul","berkerjasama","mengantuk","menguap","melebur","memuai","mencair","bekemah","berwisata","berkunjung","berjualan","bepergian","bergulung","berkorban","berpikir","berkata","berbicara","berbuat","berdoa","berkumandang","bertemu","bertitah","berjuang","bersandar","berirama","berujar"];

	/**
	 * @var string
	 */
	private $text;

	/**
	 * @param string $text
	 *
	 * Constructor.
	 */
	public function __construct(string $text)
	{
		$this->text = $text;
	}

	/**
	 * @return string
	 */
	public function extract(): string
	{
		$this->text = preg_replace("/[^a-zA-Z0-9\s\-\']/Usi", " ", $this->text);
		foreach (self::VERBS_IGNORE as $verb) {
			$this->text = preg_replace(
				"/(?:^|\s|\n){$verb}(?:$|\s|\n)/Usi",
				" ",
				$this->text
			);
		}

		do {
			$this->text = str_replace("  ", " ", $this->text, $n);
		} while ($n);

		return trim($this->text);
	}
}
