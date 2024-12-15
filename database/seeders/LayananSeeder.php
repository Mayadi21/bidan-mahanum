<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data layanan yang akan di-insert
        $layanan = [
            [
                'jenis_layanan' => 'Periksa Hamil (ANC) dan Konsultasi Bidan',
                'deskripsi' => 'Layanan ini menyediakan pemeriksaan kehamilan atau antenatal care (ANC) yang dilakukan secara rutin untuk memastikan kondisi ibu hamil dan janin tetap sehat. Pemeriksaan mencakup pengukuran tekanan darah, berat badan, dan detak jantung janin serta memberikan saran penting terkait pola makan, olahraga, dan gaya hidup sehat selama kehamilan. Selain itu, layanan ini dilengkapi dengan sesi konsultasi bersama bidan berpengalaman yang siap membantu menjawab berbagai pertanyaan dan memberikan solusi atas keluhan selama kehamilan. Konsultasi juga mencakup perencanaan persalinan dan penjelasan tentang tanda-tanda bahaya yang harus diwaspadai. Dengan pendekatan profesional dan ramah, layanan ini bertujuan mendukung ibu hamil agar menjalani kehamilan yang sehat dan persiapan persalinan yang baik.',
                'harga' => 20000,
                'besar_bonus' => 2000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Periksa Hamil (ANC) - Generik',
                'deskripsi' => 'Layanan ini menyediakan pemeriksaan kehamilan atau antenatal care (ANC) dengan dukungan obat generik yang terjangkau namun tetap berkualitas. Pemeriksaan meliputi evaluasi kesehatan ibu dan janin, seperti pengukuran tekanan darah, pemantauan detak jantung janin, serta pengecekan berat badan ibu. Obat generik yang digunakan memastikan kebutuhan nutrisi tambahan ibu hamil tetap terpenuhi, seperti vitamin dan mineral yang penting untuk pertumbuhan janin. Layanan ini sangat cocok bagi ibu hamil yang membutuhkan pemeriksaan rutin dengan biaya yang lebih ekonomis. Dengan dukungan tenaga medis profesional, layanan ini membantu ibu hamil memantau kondisi kehamilan secara berkala dan memberikan saran untuk menjaga kesehatan optimal selama masa kehamilan.',
                'harga' => 35000,
                'besar_bonus' => 3500,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Periksa Hamil (ANC) - Inject dan Generik',
                'deskripsi' => 'Layanan pemeriksaan kehamilan ini menggabungkan penggunaan obat injeksi dan generik untuk memastikan kesehatan ibu hamil serta perkembangan janin tetap optimal. Pemeriksaan antenatal care (ANC) meliputi pengecekan tekanan darah, pemantauan detak jantung janin, serta evaluasi kondisi fisik ibu hamil secara menyeluruh. Obat injeksi digunakan untuk memperbaiki kondisi tertentu, seperti anemia atau defisiensi vitamin, yang sering dialami ibu hamil. Sementara itu, obat generik berfungsi sebagai suplemen tambahan untuk memenuhi kebutuhan nutrisi penting selama kehamilan. Dengan kombinasi ini, ibu hamil mendapatkan layanan berkualitas tinggi dengan biaya yang lebih terjangkau, sekaligus memastikan kehamilan berjalan sehat dan lancar hingga persalinan.',
                'harga' => 50000,
                'besar_bonus' => 5000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Periksa Hamil (ANC) - Prenatal',
                'deskripsi' => 'Layanan pemeriksaan kehamilan ini berfokus pada pemantauan kesehatan ibu dan janin dengan dukungan obat prenatal khusus. Obat prenatal digunakan untuk membantu memenuhi kebutuhan nutrisi penting seperti asam folat, zat besi, kalsium, dan vitamin yang mendukung perkembangan optimal janin di dalam kandungan. Pemeriksaan ini mencakup evaluasi kesehatan ibu hamil, pengukuran pertumbuhan janin, serta pengecekan kemungkinan risiko kehamilan yang perlu ditangani sejak dini. Dengan pendekatan ini, ibu hamil mendapatkan perhatian khusus agar kehamilan berjalan dengan aman dan sehat. Layanan ini cocok untuk calon ibu yang ingin memastikan kesehatannya dan tumbuh kembang bayi berjalan secara optimal hingga masa persalinan tiba.',
                'harga' => 80000,
                'besar_bonus' => 8000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'KB 1 Buah',
                'deskripsi' => 'Layanan KB 1 Buah adalah salah satu bentuk pelayanan kesehatan yang bertujuan untuk memberikan pilihan kontrasepsi dengan menggunakan alat kontrasepsi berupa satu buah alat kontrasepsi, seperti IUD atau implan. Layanan ini disediakan untuk pasangan usia subur yang ingin merencanakan jumlah anak atau jarak kelahiran yang lebih ideal, dengan memberikan pengetahuan dan bimbingan terkait penggunaan alat kontrasepsi yang tepat dan aman sesuai dengan kebutuhan individu.',
                'harga' => 25000,
                'besar_bonus' => 2500,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'KB 3 Bulan',
                'deskripsi' => 'Layanan KB 3 Bulan adalah jenis pelayanan kontrasepsi yang menggunakan metode suntik KB dengan durasi efektivitas selama tiga bulan. Layanan ini memberikan pilihan bagi pasangan usia subur yang ingin menunda kehamilan dalam jangka waktu menengah, dengan melakukan suntikan hormon yang mencegah ovulasi. Selain itu, tenaga medis akan memberikan informasi tentang cara kerja metode ini, potensi efek samping, serta jadwal pengulangan suntikan untuk menjaga efektivitas kontrasepsi.',
                'harga' => 30000,
                'besar_bonus' => 3000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Cukur Bayi',
                'deskripsi' => 'Layanan cukur bayi adalah layanan yang menyediakan jasa pemotongan rambut bayi dengan tujuan untuk merawat dan menjaga kebersihan rambut bayi yang baru lahir. Proses cukur rambut ini dilakukan dengan hati-hati oleh tenaga ahli yang berpengalaman, menggunakan alat cukur yang aman dan steril. Selain memberikan kenyamanan bagi bayi, layanan ini juga menjadi tradisi bagi sebagian masyarakat untuk memperingati kelahiran dan sebagai simbol awal kehidupan baru bagi sang bayi.',
                'harga' => 5000,
                'besar_bonus' => 500,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Kerabu Tembak',
                'deskripsi' => 'Layanan kerabu tembak untuk bayi adalah layanan tradisional yang bertujuan untuk merawat kesehatan dan kebugaran bayi dengan menggunakan ramuan herbal khusus. Kerabu tembak, yang umumnya dilakukan setelah bayi lahir, dipercaya memiliki manfaat untuk meningkatkan daya tahan tubuh bayi, serta membantu proses pemulihan tubuh setelah kelahiran. Layanan ini dilakukan dengan hati-hati oleh tenaga medis yang berpengalaman, memastikan penggunaan bahan-bahan yang aman dan sesuai dengan usia bayi.',
                'harga' => 60000,
                'besar_bonus' => 6000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Sunat Anak - Laser',
                'deskripsi' => 'Layanan sunat anak menggunakan teknologi laser adalah prosedur sunat modern yang dilakukan dengan menggunakan alat laser untuk memotong jaringan kulit di sekitar area kelamin. Teknologi laser ini memiliki keunggulan dalam mengurangi rasa sakit, mempercepat proses penyembuhan, serta mengurangi risiko infeksi dibandingkan dengan metode konvensional. Prosedur ini dilakukan oleh tenaga medis yang berpengalaman dengan perhatian penuh terhadap kenyamanan dan keselamatan anak, sehingga anak dapat merasa lebih tenang dan proses pemulihan menjadi lebih cepat.',
                'harga' => 600000,
                'besar_bonus' => 60000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Sunat Anak - Manual',
                'deskripsi' => 'Layanan sunat anak secara manual adalah prosedur sunat yang dilakukan dengan menggunakan teknik pembedahan tradisional, di mana tenaga medis akan memotong bagian kulit di sekitar area kelamin menggunakan alat bedah. Proses ini dilakukan dengan hati-hati dan presisi untuk memastikan kenyamanan dan keamanan anak. Meskipun prosedur manual ini memerlukan waktu lebih lama dibandingkan dengan metode lainnya, seperti laser, prosedur ini tetap aman dilakukan oleh tenaga medis berpengalaman. Setelah sunat, anak akan diberikan perawatan untuk mempercepat proses penyembuhan dan mencegah infeksi.',
                'harga' => 800000,
                'besar_bonus' => 80000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Sunat Anak - Klem',
                'deskripsi' => 'Layanan sunat anak menggunakan metode klem adalah prosedur sunat yang dilakukan dengan memanfaatkan alat klem khusus untuk memotong bagian kulit di sekitar area kelamin. Metode ini relatif cepat dan efektif, di mana alat klem akan menahan bagian kulit yang akan dipotong, meminimalkan pendarahan dan mempercepat proses penyembuhan. Proses sunat menggunakan klem ini dilakukan oleh tenaga medis berpengalaman yang memastikan kenyamanan dan keselamatan anak selama prosedur berlangsung. Setelah tindakan, anak akan diberikan perawatan pasca-operasi untuk mempercepat penyembuhan dan menghindari infeksi.',
                'harga' => 1500000,
                'besar_bonus' => 150000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Sunat Dewasa - Laser',
                'deskripsi' => 'Layanan sunat dewasa menggunakan teknologi laser adalah prosedur sunat modern yang dilakukan dengan menggunakan alat laser untuk memotong jaringan kulit di area kelamin. Teknologi laser ini memiliki keunggulan dalam mengurangi rasa sakit, meminimalkan pendarahan, dan mempercepat proses penyembuhan dibandingkan dengan metode konvensional. Prosedur ini lebih nyaman bagi pasien dewasa karena prosesnya lebih cepat dan risiko komplikasi lebih rendah. Sunat menggunakan laser dilakukan oleh tenaga medis yang berpengalaman, dengan perhatian penuh terhadap kenyamanan dan keamanan pasien selama proses berlangsung serta perawatan pasca-prosedur untuk mempercepat pemulihan.',
                'harga' => 800000,
                'besar_bonus' => 80000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Sunat Dewasa - Manual',
                'deskripsi' => 'Layanan sunat dewasa secara manual adalah prosedur sunat yang dilakukan dengan teknik pembedahan tradisional, menggunakan alat bedah untuk memotong jaringan kulit di sekitar area kelamin. Prosedur ini dilakukan dengan ketelitian dan hati-hati oleh tenaga medis berpengalaman, untuk memastikan kenyamanan dan keamanan pasien dewasa. Meskipun membutuhkan waktu lebih lama dibandingkan dengan metode lainnya, sunat manual tetap menjadi pilihan bagi sebagian orang yang memilih teknik konvensional. Setelah prosedur, pasien akan diberikan perawatan untuk membantu proses penyembuhan dan mengurangi risiko infeksi.',
                'harga' => 1000000,
                'besar_bonus' => 100000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Sunat Dewasa - Laser',
                'deskripsi' => 'Layanan sunat dewasa dengan teknologi laser adalah prosedur sunat yang menggunakan alat laser untuk memotong bagian kulit di sekitar area kelamin dengan presisi tinggi. Metode ini menawarkan berbagai keuntungan, termasuk pengurangan rasa sakit, minimalisasi pendarahan, dan waktu pemulihan yang lebih cepat dibandingkan dengan metode konvensional. Selain itu, teknologi laser juga meminimalkan risiko infeksi dan memberikan hasil yang lebih rapi. Prosedur ini dilakukan oleh tenaga medis berpengalaman yang memastikan kenyamanan dan keselamatan pasien selama dan setelah prosedur berlangsung.',
                'harga' => 1800000,
                'besar_bonus' => 180000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Periksa Kadar Gula Darah',
                'deskripsi' => 'Layanan pemeriksaan kadar gula darah adalah prosedur medis yang dilakukan untuk mengukur jumlah glukosa dalam darah. Pemeriksaan ini penting untuk mendeteksi kondisi kesehatan seperti diabetes atau gangguan metabolisme lainnya. Dengan melakukan pemeriksaan secara rutin, seseorang dapat mengetahui apakah kadar gula darah mereka berada dalam kisaran normal atau mengalami peningkatan yang berisiko. Prosedur ini biasanya dilakukan dengan menggunakan alat pengukur gula darah (glukometer) dan dapat dilakukan dengan cara pengambilan darah dari jari atau labu darah, tergantung pada jenis pemeriksaan yang dilakukan.',
                'harga' => 20000,
                'besar_bonus' => 2000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Periksa Kolesterol',
                'deskripsi' => 'Layanan pemeriksaan kadar kolesterol adalah prosedur medis untuk mengukur tingkat kolesterol total, serta kadar kolesterol baik (HDL), kolesterol jahat (LDL), dan trigliserida dalam darah. Pemeriksaan ini sangat penting untuk menilai risiko seseorang terhadap penyakit jantung, stroke, dan gangguan pembuluh darah lainnya. Pemeriksaan kolesterol umumnya dilakukan dengan pengambilan sampel darah melalui vena, dan hasilnya akan memberikan informasi yang berguna bagi tenaga medis untuk memberikan rekomendasi pengelolaan kesehatan yang tepat. Pemeriksaan ini disarankan untuk dilakukan secara rutin, terutama bagi mereka yang memiliki faktor risiko penyakit jantung atau gangguan metabolisme.',
                'harga' => 35000,
                'besar_bonus' => 3500,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Periksa Asam Urat',
                'deskripsi' => 'Layanan pemeriksaan kadar asam urat adalah prosedur medis yang dilakukan untuk mengukur jumlah asam urat dalam darah. Pemeriksaan ini penting untuk mendeteksi adanya kadar asam urat yang tinggi, yang dapat menyebabkan kondisi seperti gout (rematik asam urat) atau gangguan ginjal. Asam urat terbentuk ketika tubuh memecah purin, yang terkandung dalam beberapa makanan dan minuman. Pemeriksaan kadar asam urat dilakukan dengan pengambilan sampel darah, dan hasilnya membantu tenaga medis untuk menentukan diagnosis dan pengobatan yang tepat, serta memberikan saran terkait perubahan gaya hidup untuk mengelola kadar asam urat dengan baik.',
                'harga' => 25000,
                'besar_bonus' => 2500,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Paket Komplit (3 in 1)',
                'deskripsi' => 'Paket pemeriksaan komplit (3 in 1) adalah layanan yang menggabungkan tiga jenis pemeriksaan kesehatan penting dalam satu paket, yaitu pemeriksaan kadar gula darah, kolesterol, dan asam urat. Paket ini dirancang untuk memberikan gambaran menyeluruh tentang kondisi kesehatan seseorang, khususnya dalam mendeteksi risiko penyakit metabolik seperti diabetes, gangguan jantung, dan gout. Dengan memeriksa ketiga indikator kesehatan ini secara bersamaan, pasien dapat lebih mudah mengetahui potensi risiko kesehatan mereka dan segera melakukan tindakan pencegahan atau pengobatan yang diperlukan. Prosedur ini dilakukan dengan pengambilan sampel darah dan hasilnya akan dianalisis oleh tenaga medis berkompeten untuk memberikan rekomendasi yang tepat.',
                'harga' => 60000,
                'besar_bonus' => 6000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Berobat - Anak/Dewasa',
                'deskripsi' => 'Layanan berobat untuk anak-anak dan dewasa menyediakan pemeriksaan dan pengobatan medis yang disesuaikan dengan kebutuhan usia pasien. Layanan ini mencakup diagnosis, perawatan, serta penanganan berbagai keluhan kesehatan mulai dari penyakit ringan hingga kondisi medis yang lebih serius. Untuk anak-anak, pengobatan dilakukan dengan pendekatan yang ramah dan sesuai dengan kebutuhan perkembangan mereka, sementara untuk dewasa, layanan ini mencakup pemeriksaan rutin hingga penanganan penyakit kronis. Tenaga medis yang berpengalaman akan memberikan diagnosis yang akurat dan rekomendasi pengobatan yang tepat agar pasien dapat pulih dengan optimal.',
                'harga' => 50000,
                'besar_bonus' => 5000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Berobat - Inject Sintetik',
                'deskripsi' => 'Layanan pengobatan menggunakan suntik sintetik adalah prosedur medis yang melibatkan pemberian suntikan bahan sintetik, seperti hormon atau obat-obatan lainnya, yang dirancang untuk mengobati kondisi kesehatan tertentu. Suntikan sintetik ini digunakan untuk membantu mengatasi masalah medis yang tidak dapat diobati hanya dengan obat oral, seperti gangguan hormon, peradangan, atau kekurangan zat tertentu dalam tubuh. Prosedur ini dilakukan oleh tenaga medis yang berkompeten, dengan perhatian penuh terhadap dosis, teknik injeksi, dan reaksi tubuh terhadap obat yang disuntikkan, guna memastikan efektivitas dan keamanan pasien selama proses pengobatan.',
                'harga' => 60000,
                'besar_bonus' => 6000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Berobat - Inject Neurobion',
                'deskripsi' => 'Layanan pengobatan menggunakan suntik Neurobion adalah prosedur medis yang melibatkan pemberian suntikan yang mengandung vitamin B kompleks, termasuk B1 (tiamin), B6 (piridoksin), dan B12 (kobalamin). Suntikan Neurobion sering digunakan untuk membantu meredakan nyeri saraf, meningkatkan fungsi saraf, dan mengatasi kekurangan vitamin B yang dapat menyebabkan gangguan pada sistem saraf. Prosedur ini dilakukan oleh tenaga medis yang berkompeten dengan dosis yang disesuaikan, bertujuan untuk mempercepat proses pemulihan dan meningkatkan kesehatan saraf pasien. Suntikan ini dapat bermanfaat untuk pasien yang mengalami keluhan seperti kesemutan, nyeri pada saraf, atau kelelahan yang disebabkan oleh kekurangan vitamin B.',
                'harga' => 40000,
                'besar_bonus' => 4000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Berobat + OBM',
                'deskripsi' => 'Layanan pengobatan dengan tambahan obat OBM (Obat Bebas Melalui Resep) adalah prosedur medis yang mencakup pengobatan dasar ditambah dengan pemberian obat-obatan tertentu yang diperlukan sesuai dengan resep dokter. Obat OBM ini biasanya digunakan untuk mengobati kondisi medis yang memerlukan perawatan tambahan di luar pengobatan umum, seperti infeksi, peradangan, atau gangguan metabolik. Penggunaan obat OBM dilakukan berdasarkan diagnosa dan kebutuhan medis pasien, dengan pengawasan ketat dari tenaga medis yang berkompeten untuk memastikan dosis dan kombinasi obat yang tepat, serta untuk menghindari interaksi obat yang tidak diinginkan.',
                'harga' => 35000,
                'besar_bonus' => 3500,
                'status' => 'aktif',
            ],
        ];

        // Insert data layanan ke tabel menggunakan Eloquent
        foreach ($layanan as $data) {
            Layanan::create($data);
        }

    }
}