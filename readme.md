# Test App

Panduan instalsi
------------
- Donwload Project dengan git command [git clone https://github.com/Abdulhmid/article-api.git]
- edit setingan database di file .env [sesuaikan dengan serve database lokal]
- jalankan migration
```{.bash}
    $ php artisan migrate --seed
```

Contoh Pengguna
------------
- admin => u : admin@app.com ; p : 12345
- editor => u : editor@app.com ; p : 123456

Available API
------------

- API Login
- API Daftar Artikel
- API Ambil Artikel


Penggunaan Api API
------------
- Buat virtual server di laravel [masuk ke directory project laravel]
```{.bash}
    $ php artisan serve
```

API Login
------------
- Contoh Penggunaan
![alt tag](http://url/to/img.png)
- Response
```{.json}
	{
	  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJzdXBlcmFkbWluIiwibmFtZSI6IlByb2dyYW1tZXIgU3VwZXJhZG1pbiIsImVtYWlsIjoiYWRtaW5AYXBwLmNvbSIsInBob3RvIjpudWxsLCJncm91cF9pZCI6MSwiY3JlYXRlZF9hdCI6IjIwMTYtMTAtMjUgMDE6MzE6NDAiLCJ1cGRhdGVkX2F0IjoiMjAxNi0xMC0yNSAwMTo0MTozOSIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL3YxXC9sb2dpbiIsImlhdCI6MTQ3NzM2MDExMiwiZXhwIjoxNDc3MzYzNzEyLCJuYmYiOjE0NzczNjAxMTIsImp0aSI6ImM1OTBmNTYzZjA2ODVkZDFkNmViMDBhNTdjNzAzN2Y4In0.MoVBqjQ9KBOrPWR3JNeHJ2iEE6YPeJE1JrOd1xIJ0ec",
	  "data": {
	    "id": 1,
	    "username": "superadmin",
	    "name": "Programmer Superadmin",
	    "email": "admin@app.com",
	    "photo": null,
	    "group_id": 1,
	    "created_at": "2016-10-25 01:31:40",
	    "updated_at": "2016-10-25 01:41:39"
	  }
	}
```

API Daftar Artikel
------------
- Contoh Penggunaan
![alt tag](http://url/to/img.png)
- Response
```{.json}
	[
	  {
	    "articles": [
	      {
	        "id": 1,
	        "title": "Dolores enim ut culpa labore",
	        "slug": "dolores-enim-ut-culpa-labore",
	        "content": "Nisi dolore aut sunt quaerat et ut tempore, dolore quo dolor asperiores aut.",
	        "user_id": 1
	      },
	      {
	        "id": 2,
	        "title": "Quas facilis voluptatem enim nisi enim et",
	        "slug": "quas-facilis-voluptatem-enim-nisi-enim-et",
	        "content": "Sint voluptates atque ab esse quia dolore voluptate officia quos autem quo odit tempora.",
	        "user_id": 2
	      }
	    ],
	    "count": 2
	  }
	]
```

API Ambil Artikel Berdasarkan ID
------------
- Contoh Penggunaan
![alt tag](http://url/to/img.png)
- Response
```{.json}
	{
	  "data": {
	    "id": 1,
	    "title": "Dolores enim ut culpa labore",
	    "slug": "dolores-enim-ut-culpa-labore",
	    "tag": "Aliquip veritatis ut sed sit est culpa non deleniti deserunt magna facere vel tempore nulla eos vitae enim",
	    "image": "photos/bullyingjpg.jpg",
	    "meta_title": "RER",
	    "meta_keyword": "SRRER",
	    "meta_description": "Aut eiusmod ducimus, ea adipisicing aperiam dolor minim sed et commodi officia temporibus amet, veniam, aliquam quasi quia.",
	    "content": "Nisi dolore aut sunt quaerat et ut tempore, dolore quo dolor asperiores aut.",
	    "user_id": 1,
	    "status": 1,
	    "created_by": "system",
	    "created_at": "2016-10-25 01:40:22",
	    "updated_at": "2016-10-25 01:40:22"
	  }
	}
```