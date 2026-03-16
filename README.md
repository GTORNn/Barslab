# 🛡️ BarsLab Blog CMS

Bu proje, **Siber Vatan BarsLab** programı ön mülakat aşaması için özel olarak tasarlanmış ve geliştirilmiş, PHP ve MySQL tabanlı güvenli bir İçerik Yönetim Sistemidir (CMS).

## ✨ Özellikler

* **Ziyaretçi Ön Yüzü:** Veritabanındaki yazıları kronolojik sırayla çeken, temiz ve modern (Responsive) UI.
* **Güvenli Admin Paneli:** Sadece yetkili kullanıcıların erişebildiği oturum (Session) kontrollü yönetim alanı.
* **Tam CRUD Desteği:** Yönetim panelinden blog yazısı Ekleme (Create), Okuma (Read), Güncelleme (Update) ve Silme (Delete) işlemleri.
* **Güvenlik Önlemleri:** * Tüm veritabanı sorgularında SQL Injection saldırılarına karşı **Prepared Statements (Hazırlıklı Sorgular)** kullanılmıştır.
  * XSS (Cross-Site Scripting) zafiyetlerini önlemek için çıktı anında `htmlspecialchars()` fonksiyonu entegre edilmiştir.
  * Yetkisiz sayfa erişimlerine karşı sıkı Session kontrolleri uygulanmıştır.

## 🛠️ Kullanılan Teknolojiler
* **Backend:** PHP 8, MySQLi
* **Frontend:** HTML5, CSS3 (Flexbox Mimarisi)
* **Veritabanı:** MariaDB / MySQL

## 🚀 Kurulum ve Çalıştırma

1. Projeyi bilgisayarınıza klonlayın:
   `git clone https://github.com/GTORNn/Barslab.git`
2. phpMyAdmin üzerinden `barslabdb` adında yeni bir MySQL veritabanı oluşturun.
3. Proje dizinindeki `barslabdata/barslabdb.sql` dosyasını içe aktararak (Import) gerekli tabloları kurun.
4. `barslabdata/barslabdb.php` ve `barslabpage/config.php` dosyalarındaki veritabanı bağlantı ayarlarını (kullanıcı adı, şifre) kendi yerel sunucunuza göre güncelleyin.
5. Ziyaretçi arayüzünü (Blog) görüntülemek için tarayıcınızdan şu adrese gidin:
   `localhost/Barslab/barslabpage/index.php`
6. Yönetim paneline erişmek için şu adrese gidin:
   `localhost/Barslab/barslabpage/barslablogin.php`
**🕵️‍♂️ Gizli Admin Erişimi (Easter Egg):**
Siber güvenlik temasına ve CTF kültürüne uygun olarak, ön yüzde (Frontend) bariz bir "Admin Paneli" linki bilerek bırakılmamıştır. Yönetim paneline giriş sayfasına (`barslablogin.php`) erişmek için ana sayfadaki **BarsLab logosuna tıklamanız** gerekmektedir.
* **Email:** admin@admin.com
* **Şifre:** admin
