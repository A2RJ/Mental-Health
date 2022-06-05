# Welcome to Cartalog!

Cartalog web ...

## Requirement

1. PHP >= 7.3
2. PostgreSQL
3. Laravel 8

## Installation

1. Clone this repository
2. Composer Install
3. Run `cp .env.example .env`
4. Setup file **.env**
5. Run `php artisan migrate` -> build table on database (***)
6. Run `php artisan db:seed --class=RolesAndPermissionsSeeder` -> create role and permission (***)
7. Run `php artisan db:seed --class=CreateAdminSeeder` -> create user admin default : *email* `admin@cartalog.id` || *pass* `admin@cartalog.id` (***)
8. Run `php artisan server --port=8000` -> running project on web server port 8000  (**)
9. Open web browser and go to [URI](http://localhost:8000/my-admin/) or `http://localhost:8000/my-admin/`
10. done.

## Import MRP from Excel

1. Get file excel (.xlsx) on Folder **MASTER**
2. Import file excel to **base URI** => *POST* http://localhost:8000/api/import-master (NB) *use `x-api-key` on header for token app*
3. done.

Note :
*** new database
** new server

https://dribbble.com/shots/17109857-Bookshop/attachments/12209423?mode=media implementasi semua, terutama contact us, jumbotron, collections, jumbotron cowok buku, step-step 1-4,

https://dribbble.com/shots/18223047-Budbo-io-Cannabis-E-commerce-Platform list rumah sakit dengan mapbox.js
