# Location API

Bu API, lokasyonları yönetmek için kullanılan uç noktalara sahiptir. Laravel ile geliştirilmiş ve Docker ile çalıştırılabilir bir ortamda yapılandırılmıştır.

API isteklerini test etmek için [Postman koleksiyonunu indirin](Location.postman_collection.json).


---

## İçindekiler

- [Kurulum](#kurulum)
- [WEB](#web-kullanımı)
  - [GET /](#get)
- [API Kullanımı](#api-kullanımı)
  - [GET /locations](#get-locations)
  - [POST /locations](#post-locations)
  - [PUT /locations/{id}](#put-locationsid)
  - [DELETE /locations/{id}](#delete-locationsid)
  - [GET /locations/with-destroy](#get-locationswith-destroy)
  - [POST /locations/distance](#post-locationsdistance)
- [TEST Kullanımı](#test-kullanımı)
  
---

## Kurulum DOCKER

1. Depoyu klonlayın:

    ```bash
    git clone https://github.com/merveyldrm1999/location-api-with-laravel
    cd location-api-with-laravel
    ```

2. Ortam değişkenlerini ayarlayın:

    ```bash
    cp .env.example .env
    ```

3. Ortam değişkenlerinin içerisinden db şifrenizi belirleyin. **Projenin çalışması için zorunlu**

    ```bash
    DB_PASSWORD=.....
    ```

4. Docker ile projeyi başlatın:

    ```bash
    docker-compose up -d
    ```
---
## WEB
### GET /
Sistemde kayıtlı olan konumların markerlarını gösteren bir haritanın açıldığı sayfayı gösterir. Bu sayfa ile sistemde kayıt noktalar var aralarındak kuş bakışı görünüm gösterilir.

**Endpoint:** `GET localhost:8000/`

![Resim Açıklaması](https://raw.githubusercontent.com/merveyldrm1999/location-api-with-laravel/refs/heads/main/list.png)

---

## API Kullanımı

**Yanıt Kodları:**
- `200`: Başarılı istek
- `204`: Kayıtlı lokasyon yok

### GET /locations
Sisteme kaydedilen tüm lokasyonların listelenmesini sağlar. Kayıtlı lokasyon yoksa yanıt boş bir array olacaktır.

**Endpoint:** `GET localhost:8000/api/locations`


---

### POST /locations
Yeni bir lokasyon ekler.

**Endpoint:** `POST localhost:8000/api/locations`

**Body (urlencoded):**
- `name`: Lokasyon adı (örn. "Jettie")
- `latitude`: Enlem değeri (örn. -40.3217)
- `longitude`: Boylam değeri (örn. 113.7340)
- `hex`: Renk hex kodu (örn. "#6e3d08")

**Kurallar:**
- `name`: Zorunlu ve String bir alan olmalı.
- `latitude`: Zorunlu bir alan aynı zamanda Float alan olmalı.
- `longitude`: Zorunlu bir alan aynı zamanda Float alan olmalı.
- `hex`: Renk hex kodu (örn. "#6e3d08") alanını doğrulamalı ve regex:/^#?([0-9a-fA-F]{6}|[0-9a-fA-F]{3})$/ kuralına uymalı.

**Yanıt:**
```json
{
    "name": "Annabel",
    "latitude": 49.3411,
    "longitude": 14.0219,
    "hex": "#0d2e29",
    "updated_at": "2024-10-29T10:43:56.000000Z",
    "created_at": "2024-10-29T10:43:56.000000Z",
    "id": 3
}
```
**Örnek hata yanıtı:**
```json
{
    "errors": {
        "name": [
            "The Name field is required."
        ]
    }
}
```

---

### PUT /locations/{id}
Mevcut bir lokasyonu günceller. Mevcut alan yoksa id alanının geçersiz olduğunu belirten bir hata mesajı dönecektir.

**Endpoint:** `PUT localhost:8000/api/locations/{id}`

**Body (urlencoded):**
- `name`: Lokasyon adı (örn. "Jacky")
- `latitude`: Enlem değeri (örn. -41.0148)
- `longitude`: Boylam değeri (örn. 77.3338)
- `hex`: Renk hex kodu (örn. "#43800a")

**Kurallar:**
- `{id}` : Urlde gönderilen id'nin sistem içerisinde bir dataya karşılık geliyor olması gerekiyor.
- `name`: Zorunlu ve String bir alan olmalı.
- `latitude`: Zorunlu bir alan aynı zamanda Float alan olmalı.
- `longitude`: Zorunlu bir alan aynı zamanda Float alan olmalı.
- `hex`: Renk hex kodu (örn. "#6e3d08") alanını doğrulamalı ve regex:/^#?([0-9a-fA-F]{6}|[0-9a-fA-F]{3})$/ kuralına uymalı.

**Güncellemenin başarılı olması:**
```json
{
    "id": 3,
    "name": "Clemens",
    "latitude": 51.8269,
    "longitude": -25.2581,
    "hex": "#684470",
    "created_at": "2024-10-29T10:43:56.000000Z",
    "updated_at": "2024-10-29T10:57:16.000000Z",
    "deleted_at": null
}
```
**Güncellenmek istenen datanın bulunamaması:**
```json
{
    "errors": {
        "location": [
            "The selected location is invalid."
        ]
    }
}
```


---

### DELETE /locations/{id}
Belirtilen lokasyonu siler.

**Endpoint:** `DELETE localhost:8000/api/locations/{id}`

**Güncellemenin başarılı olması:**
```Başarılı olması durumunda status code olarak 204 dönmekte```

**Kurallar:**
- `{id}` : Urlde gönderilen id'nin sistem içerisinde bir dataya karşılık geliyor olması gerekiyor.

---

### GET /locations/with-destroy
Tüm silinmiş olan lokasyonları listeler.

**Endpoint:** `GET localhost:8000/api/locations/with-destroy`

---

### POST /locations/distance
Gönderilen lokasyon'a göre sistemde kayıtlı tüm lokasyonların uzaklıklarını bulur. Aynı zamanda bu lokasyonları yakından uzağa olmak üzere sıralar.

**Endpoint:** `POST localhost:8000/api/locations/distance`

**Body (urlencoded):**
- `latitude`: Enlem değeri (örn. -43.7279)
- `longitude`: Boylam değeri (örn. 54.1620)


**Örnek çıktı:**
```json
[
    {
        "id": 4,
        "name": "Brady",
        "latitude": -73.5423,
        "longitude": 120.089,
        "distance": 13944.818609146796
    },
    {
        "id": 6,
        "name": "Merlin",
        "latitude": -83.2845,
        "longitude": -49.5717,
        "distance": 15006.335683813182
    },
    {
        "id": 5,
        "name": "Athena",
        "latitude": -60.055,
        "longitude": -136.2469,
        "distance": 18069.585728561797
    }
]
```

---

### POST /locations/distance/{id}
Gönderilen lokasyon'a göre yine id de gönderilen sistemde kayıtlı olan lokasyon arasındaki uzaklık bulunur.

**Endpoint:** `POST localhost:8000/api/locations/distance/{id}`

**Body (urlencoded):**
- `latitude`: Enlem değeri (örn. -65.8344)
- `longitude`: Boylam değeri (örn. -153.9197)


**Örnek çıktı:**
```json
[
    {
        "id": 4,
        "name": "Brady",
        "latitude": -73.5423,
        "longitude": 120.089,
        "distance": 3111.4771097667576
    }
]

```
## TEST Kullanımı

### php artisan test
komutu ile test çalıştırılabilir.

### LocationTest

**it creates a location:** Bu test, yeni bir lokasyonun başarıyla oluşturulmasını doğrular.
Örnek test çıktısı
Test Sonucu: Başarılı
Süre: 2.22s

**it lists locations:** Bu test listeleme işleminin başarılı olma durumunu kontrol eder.
Örnek test çıktısı
Test Sonucu: Başarılı
Süre: 0.03s

**it updates a location:** Bu test güncelleme durumunu kontrol eder. Faker kütüphanesi ile rasgele data güncellemesi yapar.
Örnek test çıktısı
Test Sonucu: Başarılı
Süre: 0.05s

**it deletes a location:** Bu test, belirtilen lokasyonun başarıyla silindiğini doğrular.
Örnek test çıktısı
Test Sonucu: Başarılı
Süre: 0.60s

**it shows a location:** Bu test, tek bir lokasyonun bilgilerini başarıyla getirdiğini kontrol eder.
Örnek test çıktısı
Test Sonucu: Başarılı
Süre: 0.04s

**it validates location with trash:** Bu test soft olarak silinen verilerin gerçekten silinme durumunun kontrolunu sağlar faker kütüphanesi ile data eklenir sonra silinir ve gelen veriler soft mu kontrol eder.
Örnek test çıktısı
Test Sonucu: Başarılı
Süre: 0.04s

### DistanceTest

**it calculates distance between two locations** Bu test kaydedilen verilerin rastgele gönderilen kordinatlara göre sıralanma durumunu kontrol eder. küçükten büyüğe doğru bir sıralama geri dönerse çıktı başarılı olarak görünecektir

Örnek test çıktısı
Test Sonucu: Başarılı
Süre: 0.04s

---
