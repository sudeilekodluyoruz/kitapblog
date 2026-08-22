-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Tem 2026, 15:10:01
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `odevv_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `kategori_id` int(11) NOT NULL,
  `kategori_adi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`kategori_id`, `kategori_adi`) VALUES
(1, 'Bilim Kurgu'),
(2, 'Dünya Klasikleri'),
(3, 'Kişisel Gelişim'),
(4, 'Tarih'),
(5, 'Yazılım'),
(6, 'Psikoloji'),
(7, 'Roman');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitaplar`
--

CREATE TABLE `kitaplar` (
  `kitap_id` int(11) NOT NULL,
  `kitap_adi` varchar(150) NOT NULL,
  `kitap_turu` int(11) NOT NULL,
  `yazar` varchar(100) NOT NULL,
  `sayfa` int(11) DEFAULT NULL,
  `yili` int(11) DEFAULT NULL,
  `dili` varchar(50) DEFAULT NULL,
  `fiyat` decimal(10,2) DEFAULT NULL,
  `barkod` varchar(50) DEFAULT NULL,
  `kapak_foto` varchar(255) DEFAULT NULL,
  `ozet` text DEFAULT NULL,
  `eklenme_tarihi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kitaplar`
--

INSERT INTO `kitaplar` (`kitap_id`, `kitap_adi`, `kitap_turu`, `yazar`, `sayfa`, `yili`, `dili`, `fiyat`, `barkod`, `kapak_foto`, `ozet`, `eklenme_tarihi`) VALUES
(0, 'Python', 0, 'Mustafa Başer ', 544, 2025, 'Türkçe', 600.00, NULL, 'kitap2.jpeg', 'Python, ilk sürümünden (1990 yılının başında) bu yana dikkatleri üzerine çeken genel amaçlı, yorumlamalı, nesne tabanlı, temiz kod yazılabilen, hızlı öğrenilebilen, hızlı uygulama geliştirilebilen ve birçok aracı (kütüphaneyi) içeren bir programlama dilidir. Bu kitap, programcılığa yeni başlayanlar için bir rehber, Python’u bilenler için bir başvuru kaynağı niteliğindedir.\r\n\r\nPython konusunda uzun yıllar yayın üreten, kitaplar yazan ve akademik hayatına bu yönde devam eden Doç. Dr. Mustafa Başer’in 15 yıldan fazla deneyim ve tecrübesine dayanan kitabın başlıca konular şöyle:\r\n\r\n• Programlama ve Python\r\n• Python Nasıl Çalışır?\r\n• Değişkenler, İfadeler, Deyimler\r\n• İşlevler\r\n• Argümanlar ve Parametreler\r\n• İsim Alanları (NameSpace)\r\n• Mantıksal İşleçler\r\n• İç İçe Döngüler\r\n• Listeler ve İterasyon\r\n• Nesneler ve Özellikleri\r\n• Listelerde Arama\r\n• Cümleler (String) ve Dosyalar\r\n• Tüpler ve Sözlükler\r\n• İstatistikler\r\n• Menüler\r\n• Modüller\r\n• Rastgele Sayı Modülü\r\n• Sınıflar\r\n• Veritabanı\r\n• Web Programcılığı\r\n• PyQt’ye Giriş\r\n• Qt Kaynak Dosyaları\r\n• Diyaloglar\r\n• Düzenler\r\n• Çoklu Dokümanlar ile Çalışmak\r\n• PyQt Dosyaları\r\n• PyQt ve Python Veri Tipleri\r\n• Olaylar, Pano ve Sürükle Bırak\r\n• Çizimler\r\n• Kalem ve Fırça\r\n• Geometrik Şekiller\r\n• Qt Designer\r\n• Örnek Uygulamalar\r\n• Alıştırmalar', '2026-06-22 16:55:11'),
(1, 'çalıkuşu', 7, 'Reşat Nuri Güntekin', 452, 2019, 'Türkçe', 200.00, '52051487521', '1045_1354_çalıkuşu.jpg', 'Çalıkuşu, Reşat Nuri Güntekin tarafından 1922 yılında yazılmış bir romandır. Türk edebiyatının en çok sevilen klasik eserleri arasında yer alır. Ağırlıklı olarak Anadolu’da geçen ve arka planda Osmanlı’nın son yıllarını anlatan bir romandır. Kitabın son kısmı hariç, ki bu bölüm dışarıdan bir gözlemcinin anlattıklarıdır, romanın ana kahramanı Feride’nin hatıra defteri şeklinde yazılmıştır.\r\n\r\nReşat Nuri Güntekin, Çalıkuşu’nu önce İstanbul Kızı adıyla dört perdelik bir oyun olarak yazmıştır. Yapıtı, 1922’de Vakit Gazetesi’nde Çalıkuşu adıyla roman olarak yayınlanınca büyük ilgi çekmiştir.\r\n\r\nÇalıkuşu, duygusal bir olayı anlatmakla birlikte dönemin toplumsal sorunlarının eleştirel olarak da ortaya koymaktadır. Çalıkuşu, Türkiye’de yeni ve modern bir dönemin başlamasını özendiren bir roman olarak kabul edilmektedir.', '2025-12-23 15:09:32'),
(2, 'İçimizdeki Şeytan', 7, 'Sabahattin Ali', 140, 2012, 'Türkçe', 89.00, '965320568', '7501_içimizdeki.jpg', 'İçimizdeki Şeytan, Macide ve Ömer’in aşkını okuyucularla buluşturuyor. Ömer bir yandan postanede çalışmakta bir yandan da üniversitede eğitim görmekte olan bir çocuktur. Bir gün Kadıköy vapurunda karşılaştığı Macide’ye âşık olur. Macide, sesinin güzelliği ile herkesi kendine hayran bırakan genç bir kızdır. Bu yeteneği yüzünden, Konservatuar eğitimi görmek üzere Emine Hanım’in yardımları sayesinde Balıkesir\'den İstanbul’a alınmıştır. Gel gelelim İstanbul’da işler Macide için iyi gitmez.\r\n\r\nHer ne kadar konservatuar eğitimini tamamlamak istese de Emine Hanım’ın evini pansiyon gibi kullanmakta ve evdekilerle hemen hemen hiç samimiyet kurmamaktadır. Sabahları Ömer gelmekte ve Macide’yi konservatuara kadar bırakmaktadır ve aynı şekilde de akşam okuldan alır. Kısa süre sonra hemen her akşam buluşmaya ve birlikte vakit geçirmeye başlarlar. Macide’nin eve geç dönmesi teyzesinden azar işitmesine neden olur.\r\n\r\nMacide’nin tavırları kaldığı evdeki huzursuzluğun artmasını sağlamıştır. Macide, kısa süre sonra Emine Hanım’a daha fazla yük olmak istemez ve evden ayrılır. Çok geçmeden Ömer ile daha sık vakit geçirmeye başlayan Macide, kendini onunla evlilik hayatı yaşarken bulur. Ömer ise tabir-i caizse içindeki Şeytan’ın esiri olmuş bir kişidir. Sürekli olarak başkalarından geçinmekte ve sadece günü yaşamaktadır.\r\n\r\nYaşadıkları evlilik hayatı çok geçmeden sorunlar çıkartır. Ömer’in aldığı maaş ikisini geçindirmek için yetmemektedir. Çiftin geçim sıkıntıları gittikçe artar ve para sıkıntısı yaşamaya başlarlar.\r\n\r\nBir gün Macide ve Ömer’i arkadaşları saza davet eder. Macide o gece eski musiki hocası Bedri ile karşılaşır. Daha önce aralarında duygusal bir yakınlaşma olan Bedri ablası hasta olduğu için başka bir işe başlamıştır. Macide o gece Bedri’nin aynı zamanda Ömer’in eski bir arkadaşı olduğunu öğrenir. İkisinin evlendiğini duyan Bedri, onlara para yardımında bulunmayı teklif eder. Öte yandan Bedri’nin Macide’ye olan tutkusu da asla sönmemiştir.\r\n\r\n', '2025-12-23 15:10:07'),
(3, 'Yoldaki Mühendis', 6, 'Abdullah Galib Bergusi', 200, 2010, 'Türkçe Çeviri', 182.00, '9684532567', 'mih_200.jpeg ', 'Abdullah Galib Bergusi. Filistin Direniş Hareketi Kassam\'ın Batı Şeria ve Ramallah’ta bilinen en meşhur komutanı. Kod adı Yoldaki Mühendis ya da Gölgeler Prensi olan Bergusi, Filistin tarihinde en çok ceza alan kişi. 67 müebbet ve ayrı ayrı onlarca yıl hapis cezası... 2003 yılından beri tek kişilik hücrede yaşıyor. Tutsak alınmadan önce İsrail’in tüm istihbaratını peşinden koşturan Filistin’in bu meşhur komutanı bedeni tutsak alınsa da zindanda kalemiyle kelimeleriyle direnmeye devam ediyor.\r\n“Uzun zamandır tek kişilik karanlık bir hücrede yaşıyorum. O kadar uzun zaman ki artık senelerini saymakta acizim…\r\n \r\nTek kişilik karanlık hücreye konulmadan tam altı ay boyunca soruşturma merkezlerinde dolaştırıldım. Bu merkezlerde ölümü gördüm… Ölümle konuştum… O da benimle konuştu… Çok defa ölüme dokundum… Fakat el-Kahhâr olan Allah\'ın yardımıyla ölüme galip geldim…\r\nSiyonistler tarafından tutuklanmadan önce hayatımın en güzel yıllarını geçirdim.  Başım dik ve yükseklerdeydi. \r\n \r\nMescid-i Aksa\'nın kandillerinin yakılacağı yağın Filistin\'e, özgür savaşçıların toprağına gelmesi çok yakındır…\r\n \r\nAydınlık yarınlar yakındır. Siyonistlerin, Allah\'ın mübarek kıldığı Mescid-i Aksa\'dan gitmeleri yakındır. Filistin\'in emperyalizmden, işgalden ve zulümden özgürlüğüne kavuşacağı günler çok daha yakındır.”\r\n\r\n', '2025-12-23 15:10:38'),
(4, 'Veri Yapıları ve Algoritmalar Bilgisayar Programlama ve Yazılım Mühendisliğinde', 1, 'Dr. Rifat Çölkesen ', 480, 2025, 'Türkçe Çeviri', 860.00, '36525236202', 'kıtap1.jpeg', 'Bu kitap, program geliştiren, matematik ve mühendislik problemlerini\r\nbilgisayar ortamında çözmek isteyen, iş dünyasına yönelik yazılım\r\ntasarımları yapan her düzeyden programcı veya yazılımcılar için ciddi bir\r\nbaşvuru kitabıdır. Kitap, aynı zamanda, üniversitelerin bilişimle ilgili\r\nbölümlerinde okutulan Veri Yapıları ve Algoritmalar dersleri için bir ders\r\nkitabı özelliğindedir. Program ve yazılım tasarımında, ciddi bir bakış açısı\r\nyakalamak isteyenlere önerilir...\r\n\r\nVeri Yapıları ve Algoritmalar, program tasarımında çoğu zaman eksikliği\r\nhissedilen önemli bir konu; yalnız başına bir programlama dili bilmek,\r\nprogram geliştirmeye yetmemektedir. Bu kitap, C programlama diline\r\ndayanılarak çeşitli veri yapıları ve modellerini ele almakta, onlara ait\r\nprogramın algoritmik ifadesini incelmekte ve örneklerle açıklamaktadır;\r\nbütün bunlara ek olarak, program tasarımında yapılması gereken aşamalar\r\nsistem analizi ve tasarımı konularına uygun olarak adım adım açıklanmış ve\r\nNetwork yazılımı ve Veri modeli de açıklanmıştır. Program tasarımında en\r\nönemli konu, ele alınan uygulamaya en uygun veri modelinin belirlenmesi,\r\nveri yapısının tanımlanması ve programın algoritmik olarak ifade\r\nedilmesidir. Veri yapısı, verinin veya bilginin bellekte tutulma şeklini ve\r\ndüzenini gösterir. Veri modeliyse, verilerin birbirleriyle ilişkisel ve\r\nsırasal durumunu gösterir. Bilgisayar ortamında uygulanacak tüm matematik ve\r\nmühendislik problemleri bir veri modeline yaklaştırılarak veya yeni veri\r\nmodelleri tanımlanması yapılarak çözülebilmektedir. Uygun bir veri modeliyle\r\nçözüme gidilemeyen problemler, çoğu zaman ya çözümsüz kalmakta veya bellek\r\nyetmiyor, bilgisayarın hızı yetmiyor gibi sebeplerle yarım bırakılmaktadır.\r\nUygulamada, her problem, doğası gereği en uygun bir veri modeline sahiptir.\r\n\r\nKitap, sırasıyla şu bölümleri kapsamaktadır:\r\nBilgisayar Yazılım Dünyası, Program/Yazılım Geliştirme Süreci, Algoritmik Yaklaşımda C Dili Esnekliği ve\r\nÖzellikleri, Veri Yapıları ve Veri Modelleri, Algoritmalar ve Tasarım\r\nYaklaşımları, Program Çalışma Hızı ve Bellek Gereksinimi, Sıralama\r\nAlgoritmaları, Arama Algoritmaları, Yığın ve Kuyruk Yapısı, Bağlantılı\r\nListeler ve Uygulamaları, Ağaç Veri Modeli, Ağaç Uygulamaları, Graf Veri\r\nModeli, Graf Algoritmaları (Shortest Path, Minumum Spanning Tree, BFS, DFS,\r\nDurum Makinaları, Veri Sıkıştırma ve Yazılım Geliştirme Süreci.', '2025-12-23 15:11:15'),
(5, 'Sefiller - 100 Temel Eser', 2, 'Victor Hugo', 200, 2019, 'Türkçe Çeviri', 309.00, '9782956243867', '9501_sefiller.jpg', 'Fransız Romantik döneminin en önemli yazarlarından sayılan Viktor Hugo, romancı oyun yazarı ve şairdir. 1862’de yayımlanan \"Sefiller\" olağanüstü bir ilgiyle karşılandı ve Hugo, Fransa’da büyük bir üne kavuştu. Yayımlandığı yıllarda kısa sürede dünyanın bütün önemli dillerine çevrilen roman, yazarın ününe de Fransa sınırlarının dışına taşıyarak onu bir dünya yazarı yaptı. Paris’in yer altı dünyasında geçen bir dedektif öyküsüne dayanan roman, aynı zamanda Paris halkının yaşamının da bir destanıydı... Gizem ve esrarengiz hava yaratmakta usta olan Hugo’nun \"Sefiller\"i dünyada en çok dile çevirilen ve hala en fazla okunan romanlar arasındadır.\r\nFransız edebiyatında Hugo kadar yapıt vermiş hemen hemen başka bir yazar yoktur. 1830’da \"Romantizm’in en önemli temsilcisi\" sayılmış, şiirleri ve yazılarıyla Çağdaş Fransız edebiyatının temellerinden biri olmuştur.', '2025-12-24 09:04:56'),
(6, 'Kaşağı - 100 Temel Eser', 1, 'Ömer Seyfettin', 85, 2010, 'Türkçe', 152.00, '9788966288789', '3306_kaşağı.jpg', 'Yazar küçük bir çocukken ailesiyle birlikte büyük bir çiftlikte yaşıyorlar. Ömer çiftlikteki hayvanlar arasında en çok atları sever ve atları kaşımayı da sever. Ancak atlardan sorumlu hizmetkârları Dadaruh, Ömer’e izin vermez çünkü Ömer’in boyu atların midesini bile zor büyütür. Değerli bir kaşağı alır ve atların yanına gider. Kaşağı hiç kullanılmadığı için Ömer atlara dokunur dokunmaz atlar huysuzlaşır. Ömer dişlerini duvara sürterek dişlerini sıkmaya çalışır. Atlara gider ama kaşağı dişleri kırılmış ve daha beter olmuştur. Ömer sinirlenir ve değerli kaşağını alır, büyük bir taşla ezer ve çeşmenin yanına fırlatır.\r\n\r\n', '2025-12-24 09:05:53'),
(7, 'Akıllı Yatırımcı', 3, ' Benjamin Graham', 134, 2020, 'Türkçe Çeviri', 556.00, '9781365038088', '9702_akıl.jpg', '“Yatırımcılık hakkında gelmiş geçmiş en iyi kitap.”\r\nWarren Buffett, Ünlü yatırımcı, dünyanın en zengin 3. adamı\r\n \r\n“Hayatınız boyunca tek bir yatırım kitabı okuyacaksanız, bu olsun.”\r\nForbes\r\n \r\n“Bu kitap Benjamin Graham’ın yatırımcılık hakkındaki olağanüstü başarı kazanmış temel ilkelerini net bir şekilde açıklıyor.”\r\nMoney\r\n \r\n“Bu kitap hayatınız boyunca başarılı yatırımlar yapabilmeniz için gerekli bilgileri ve mantıksal çerçeveyi eksiksiz ve anlaşılır biçimde sunuyor. Sizin yapmanız gerekense gerekli duygusal disiplini sağlamak.”\r\n \r\n“Yatırımcılığın temel ilkeleri hisselere iş ortaklığı gibi bakmak, piyasa dalgalanmalarını yararınıza kullanmak ve hesaplamalarınızda bir güvenlik marjı bırakmaktır. Bunları bize Benjamin Graham öğretti, yüz yıl sonra da yatırımcılığın temel taşları bunlar olacak.”\r\nWarren Buffett\r\n \r\nWarren Buffett’ın önsözü ve sonsözü ile, Jason Zweig’in güncel yorumlarıyla\r\n \r\nAmazon’un en çok satan 100 kitap listesinden hiç düşmeyen bu efsane kitaptaki ilkeleri dikkat ve istikrarla uygulayarak:\r\n●Yatırımcılıkla spekülasyonun farkını öğrenerek spekülasyondan korunacak,\r\n●Yatırımcı profilinizi, riske bakış açınızı öğrenerek kendiniz için doğru yatırım stratejisini oluşturacak,\r\n●Özel emeklilik fonlarınızı etkili ve verimli yönetmeyi öğrenecek,\r\n●Birikimlerinizi krizlere, enflasyona ve panik dalgalarına karşı koruyacak,\r\n●Orta ve uzun vadede akılcı, sürdürülebilir ve reel getiriler elde edecek,\r\n●Niteliği ne olursa olsun varlıkların doğru değer ve fiyatlarını güvenilir şekilde bilecek,\r\n●Akıllı bir yatırımcı için panik dalgalarının ve fiyat düşüşlerinin fırsat olduğunun bilincine varacak,\r\n●Doğru zaman ve koşullarda alım-satım yapmanın ilkelerini kavrayacak,\r\n●Gereksiz alım-satım ve pozisyon alımların daima zarar getirdiğini bilecek,\r\n●Değerli ve doğru fiyattan alınmış varlıkları furyalara kapılmadan elde tutmanın önemini anlayacaksınız.\r\nTahmin edileceği gibi bu kitap kısa vadede zengin olma hayali kuranlara ve spekülatörlere göre değil. Ancak ister birikimlerini koruma ve makul risklerle akılcı getiriler sağlama peşindeki bir pasif yatırımcı olun, ister piyasalara gereken emek ve zamanı harcayarak daha yüksek getiriler elde etme hedefi olan bir aktif yatırımcı, bu kitaptaki ilkeleri özümseyip yatırımlarınıza yansıtırsanız, olağanüstü sonuçlar elde ettiğinizi göreceksiniz.\r\n \r\nYatırım gibi zor ve rekabetçi bir alanda 45 yıl önce yazılmış bir kitabın bugün hâlâ çok satanlar listelerinin üst sıralarında yer alması sıradışı bir durum, ancak Benjamin Graham de sıra dışı bir yazar. Warren Buffett, David Abrams, Walter Schloss gibi uzun vadede dahi ortalamaların çok üzerinde getiriler sağlamış ünlü yatırımcıların akıl hocası ve “değer yatırımcılığı” ekolünün yaratıcısı Graham, aynı zamanda fikirlerini açık ve duru şekilde ifade edebilen iyi bir yazar ve ilkelerini kendi parasıyla uygulayarak ortalama üstü getiriler elde eden iyi bir yatırımcıydı. Bu kitapta başarılı yatırımcılara yön veren ilkelerin, ustalarının ağzından en nitelikli ve anlaşılır anlatımını bulacaksınız.\r\n \r\nBuna ek olarak; Wall Street Journal, Money, Time, Forbes gibi saygın yayınlarda yazmış ünlü finans gazetecisi Jason Zweig’ın bu kitaptaki fikirleri 21. yüzyıl koşullarına uyarlayarak ve kitabın yazımından 30 yıl sonra gerçekleşmiş “dot.com balonu” gibi olayları inceleyerek eklediği “yorum” kısımlarını okuduğunuzda, Graham’in öğretilerinin çok az öğretinin geçebildiği bir testi geçerek hem günümüze, hem geleceğe ışık tutmaya devam ettiğini net bir şekilde göreceksiniz.\r\n', '2025-12-24 09:07:39'),
(8, 'Filistin', 6, 'Abdullah Galib Bergusi ', 120, 2000, 'Türkçe Çeviri', 260.00, '9781380104617', 'filistinn.jpeg', 'Bu kitap, Türkiye\'de \"Yoldaki Mühendis\" olarak tanınan Filistin direnişinin sembol isimlerinden Abdullah Galib Bergusi\'nin Türkçe yayımlanan 4. kitabı.\r\nBedeni tutsak edilse de Bergusi kelimeleriyle direnmeye devam ediyor.\r\n\"Sözlerim; direniş yoluna taş koyanları, bu yolda zorluk çıkaranları, direnişi engellemeye çalışanları ve tüm zalimleri ilelebet rahatsız edecektir.\r\nSadece denedim. “Filistin” adlı bu eserimde, hoş köklü ve keskin kokulu Filistin yaban kekiğini bulmayı denedim. Dağı, taşı, hatta güzel kokulu yaban kekiğini ve hayalleri dahi işgal etmeye yeltenen kindar, zalim ve zorba Siyonistlere rağmen izzetiyle yaşamaya devam edenler aradıklarını mutlaka bulacaklardır.\r\nBitmeyen işgal, drama dönen hayatlar ve tertemiz bir sevgi hücremde Filistin adında bir avukata dönüştü. Filistin’in toprağını ve çamurunu seven, direnişe hayran olan bir Yaban Kekiği…\"', '2025-12-24 09:08:46'),
(9, 'Kudüs… Ey Kudüs', 6, 'Larry Collins', 640, 2018, 'Türkçe', 725.00, '9781870990663', 'kudüs.jpg', 'TARİHİN İÇİNE SIĞMAYAN,\r\nTÜM COĞRAFYALARIN ÖTESİNDE, BAŞLI BAŞINA BİR MEDENİYET: KUDÜS\r\n\"14 Mart 1948 günüydü. O gün İngilizlerin Filistin’den ayrıldıklarını, Yahudilerin İsrail Devleti’nin kuruluşunu ilan ettiklerini, Arapların savaşa girdiklerini gördü. Bir ihtilaf Kutsal Toprağı alevlere boğacak ve alevler bir daha da sönmeyecekti. Bu kitap ihtilafın doğuşunu anlatıyor.\"\r\nŞehir tarihi, dinler tarihi, kültür tarihi... Hiç şüphe yok ki dünyada Kudüs\'ten başka, tüm bu konulara tek başına cevap verebilecek bir şehir yok. Kudüs bir şehirden çok daha ötesi olduğu gibi çağlar öncesini ve sonrasını kendinde buluşturan başlı başına bir medeniyet.\r\nKudüs… Ey Kudüs, 1948 Arap-İsrail Savaşı sırasında iki kesim tarafından parçalanan Kutsal Kent\'in, Kudüs\'ün dramatik ve olağanüstü öyküsünü anlatıyor. Larry Collins ve Dominique Lapierre, titiz ve sıkı bir araştırma süreci elde ettiği bilgileri etkileyici bir üslupla okuyucuya aktarıyorlar. Filistin\'i bölmek için Birleşmiş Milletler’deki oylama ve oylamanın Yahudiler arasında yarattığı sevinç ve Araplar arasında yaşanan keder, Tel-Aviv - Kudüs karayolu boyunca yaşanan savaşlar, 1948 yılı Mart ayı sonlarında Kudüs\'ün neredeyse aç bırakılması, Hurva’nın tahrip edilmesi ve Eski Şehir’in yıkılmasına neden olan saldırılar, İsrail Devleti’nin ilan edilişi, Arap Lejyonu’nun Kudüs’e girişi, Deir Yassin ve Hadassah Hastanesi katliamları gibi dramatik, önemli ve günümüze dek yankıları devam eden olayları Arap ve Yahudi aktörler üzerinden tüm ayrıntılarıyla anlatıyorlar.\r\nElinizdeki kitapta Kudüs\'e dair her şeyi, bir arada bulabileceksiniz. Bazen siyaset ve politika, bazen tarih ve coğrafya, benzersiz fotoğraflar, önemli tarihler, yeni okumalara yönlendirebilecek devasa bir kaynakça... \r\nKudüs... Ey Kudüs, sizi hem bir roman gibi peşinden sürükleyecek hem de bir belgesel gibi sarsacak.', '2025-12-24 09:10:23'),
(10, 'Filistin\'i Bölüşmek', 5, 'Avi Shlaim ', 48, 2014, 'Türkçe Çeviri', 450.34, '9783413508220', 'filistini-bolusmek.jpg', 'Bu kitap, Avi Shlaim’in hayli olumlu eleştiriler alan önceki çalışması Collusion across the Jordan (1998)’ın, halen çok doyurucu olmakla birlikte gözden geçirilerek kısaltılmış bir baskısı. Kitap, Doğu Ürdün Emiri Abdullah ile sonradan İsrail hükümeti olacak olan Yahudi Ajansı’nın lider kadrosu arasındaki ekseriyetle gizli ilişkilere odaklanmak suretiyle, talihsiz Arap-İsrail sorununun en önemli öğelerini gayet okunabilir ve parlak bir anlatımla ortaya koyuyor. Sempati ile menfaat birliğini, anlaşmazlık ile bir uzlaşı yakalamaya giden yolda trajik bir biçimde kaçırılan fırsatları yan yana resmettiği bu sıradışı ilişkinin etkileyici bir tablosunu çiziyor. Ağırlıklı olarak İngiliz, Arap ve İsrail yazılı kaynaklarını kullanan Shlaim, 1921’den 1951’e kadar 30 yıllık bir ilişkinin izlerini sürüyor.’\r\nJudith L. Bara, Book Notes\r\n \r\n‘Tıpkı Collusion Across the Jordan gibi, Filistin’i Taksim Siyaseti de revizyonist literatürün önemli bir ürünü olma vasfını koruyor. . . Revizyonistler, İsrail’in kuruluşuna ilişkin eski pek çok mitin yanlışlığını açıkça ortaya koyuyorlar – örneğin İsrail’i yok etmeye adanmış yekpare bir Arap koalisyonuyla karşı karşıya kaldığı; Arap ordularının hem sayıca hem de silahça daha üstün olduğu, kendisininse ancak azim ve iradenin benzersiz bir bileşimi sayesinde ayakta kaldığı; yalnızca onu yok etmeyi arzulayan uzlaşmaz Arap komşularıyla barış anlaşmaları yapabilmek için umutsuzca çabaladığı gibi.’\r\nKathleen Christison, Journal of Palestine Studies\r\n \r\n‘Shlaim’in merak uyandıran anlatımı, yalnızca birkaç kişinin aşina olduğu modern İsrail tarihininin tamamını, en hafif ifadesiyle, gözler önüne seriyor. . . . Bu titiz araştırma, Filistin’in trajik tarihini anlamak isteyen herkes için vazgeçilmez bir kitap.’', '2025-12-24 09:12:13'),
(11, 'Bilgi Deneyim ve Gelecek', 3, 'Ahmet Taştan', 120, 2024, 'Türkçe', 1000.00, '9789752444591', 'ahmethoca.png', '1969’da Kayseri’de doğdu. İlk, orta ve lise öğrenimini Kayseri’de tamamladı. Gazi Üniversitesi Endüstriyel Sanatlar Fakültesi Bilgisayar Eğitimi Bölümü’nden 1992 yılında mezun oldu. 1992 yılında M.E. B. Kayseri Melikgazi Merkez Endüstri Meslek Lisesi’nde Teknik Öğretmen olarak atandı. 1995 yılında Mustafa Kemal Üniversitesi Antakya Meslek Yüksekokulu’nda öğretim görevlisi, 1997-1998 yılları arasında Kayseri Kocasinan Belediyesi’nde Bilgi İşlem Müdürü olarak görev yaptı. 1999 yılında Kırıkkale Üniversitesi Kırıkkale Meslek Yüksekokulu’nda öğretim görevlisi olarak atandı ve halen bu görevini Bilgisayar Teknolojileri bölümünde sürdürmektedir. Yayınlanmış ders kitabı ve kitap bölümleri bulunmaktadır. Evli ve dört çocuk babasıdır.', '2025-12-24 11:06:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

CREATE TABLE `yoneticiler` (
  `id` int(11) NOT NULL,
  `kadi` varchar(50) NOT NULL,
  `sifre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `kadi`, `sifre`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `kitaplar`
--
ALTER TABLE `kitaplar`
  ADD PRIMARY KEY (`kitap_id`),
  ADD KEY `kitap_turu` (`kitap_turu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
