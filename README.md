<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# ❤️ DatingApp – Laravel Web Application

DatingApp je web aplikacija za upoznavanje korisnika razvijena pomoću **Laravel framework-a**.
Aplikacija omogućava registraciju korisnika, kreiranje profila, pregled drugih korisnika, lajkove, dislajkove i pronalaženje međusobnih podudaranja (**match sistem**).

---

## 📌 Osnovne funkcionalnosti

✔ Registracija i prijava korisnika
✔ Kreiranje i uređivanje profila
✔ Upload profilne slike
✔ Galerija slika korisnika
✔ Pregled drugih korisnika
✔ Like / Dislike sistem
✔ Match sistem
✔ Undo like/dislike
✔ Statistika korisnika
✔ Eksterni API (mapa lokacija korisnika)

---

## 🛠 Korištene tehnologije

- Laravel 10 – PHP framework za brzi razvoj web aplikacija
- PHP – serverski jezik za dinamičke web stranice
- MySQL – relacijska baza za čuvanje podataka
- Blade Templates – Laravel-ovi HTML šabloni sa PHP logikom
- Tailwind CSS – brzo stilizovanje pomoću utility klasa
- Jetstream Auth – gotov sistem za login, registraciju i 2FA
- Leaflet.js – lagana JavaScript biblioteka za interaktivne mape

---

## 🗄 Baza podataka

Aplikacija koristi relacijsku bazu podataka sa sljedećim tabelama:

- users
- profils
- profil_slikes
- likes
- dislikes

---

## 🌱 Seeders i Factories

Projekt sadrži:

✔ Factories za:

- User
- Profil
- ProfilSlika
- Like
- Dislike

✔ Seeders koji generišu:

- 10 korisnika
- 10 profila
- galerije slika
- like/dislike odnose

Pokretanje seedera:

```
php artisan migrate:fresh --seed
```

---

## 👤 Korisnički profil

Svaki korisnik može imati jedan profil koji sadrži:

- ime
- prezime
- datum rođenja
- spol
- grad
- opis
- profilnu sliku
- galeriju slika
- interesovanja
- minimalne godine partnera
- maksimalne godine partnera

---

## ❤️ Match sistem

Korisnici mogu:

- lajkovati profile
- dislajkovati profile
- poništiti like/dislike

Match nastaje kada:

✔ dva korisnika lajkuju jedan drugog

U match sekciji moguće je:

- vidjeti match korisnike
- otvoriti chat (demo verzija)

---

## 🖼 Galerija slika

Korisnici mogu:

✔ upload više slika
✔ brisati slike
✔ pregledati galeriju drugih korisnika

---

## 📊 Statistika

Dashboard prikazuje:

✔ broj korisnika
✔ procent muškaraca i žena
✔ starosnu strukturu
✔ prosječnu starost
✔ najčešće gradove

---

## 🗺 Mapa korisnika (External API)

Dashboard sadrži mapu koja prikazuje:

✔ gradove korisnika
✔ raspored korisnika po lokacijama

Koristi se:

Leaflet.js API

---

## 📷 Screenshots

### Login

<p align="center">
  <img src="screenshots/Screenshot_1.png" width="70%">
</p>

---

### Registracija

<p align="center">
  <img src="screenshots/Screenshot_2.png" width="70%">
</p>

---

### Kreiranje računa

<p align="center">
  <img src="screenshots/Screenshot_3.png" width="70%">
</p>
<p align="center">
  <img src="screenshots/Screenshot_4.png" width="70%">
</p>

---

### Dashboard

<p align="center">
  <img src="screenshots/Screenshot_5.png" width="70%">
</p>
<p align="center">
  <img src="screenshots/Screenshot_6.png" width="70%">
</p>
<p align="center">
  <img src="screenshots/Screenshot_7.png" width="70%">
</p>

---

### Pregled profila

<p align="center">
  <img src="screenshots/Screenshot_8.png" width="70%">
</p>

---

### Moj profil

<p align="center">
  <img src="screenshots/Screenshot_9.png" width="70%">
</p>
<p align="center">
  <img src="screenshots/Screenshot_10.png" width="70%">
</p>

---

### Profili ostalih korisnika

<p align="center">
  <img src="screenshots/Screenshot_11.png" width="70%">
</p>
<p align="center">
  <img src="screenshots/Screenshot_12.png" width="70%">
</p>

---

### Match sistem

<p align="center">
  <img src="screenshots/Screenshot_13.png" width="70%">
</p>
<p align="center">
  <img src="screenshots/Screenshot_14.png" width="70%">
</p>

---

---

## 🚀 Pokretanje projekta

1️⃣ Kloniranje projekta

```
git clone https://github.com/tvoj-username/datingapp.git
```

2️⃣ Instalacija

```
composer install
```

3️⃣ Konfiguracija

```
cp .env.example .env
```

4️⃣ Generisanje ključa

```
php artisan key:generate
```

5️⃣ Migracije i seeders

```
php artisan migrate:fresh --seed
```

6️⃣ Pokretanje servera

```
php artisan serve
```

---

## 🔐 Autentifikacija

Aplikacija koristi:

Laravel Jetstream Authentication

Omogućeno:

✔ Registracija
✔ Login
✔ Logout
✔ Email verifikacija

---

## 👨‍💻 Autor

Ime i prezime: Sajra Alijagić

Predmet: Objektno orijentirane baze podataka

Godina: 2026

---

## 📄 Napomena

Ovaj projekat je razvijen u edukativne svrhe kao studentski projekat.
