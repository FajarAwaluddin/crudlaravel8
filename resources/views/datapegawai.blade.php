<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>CRUD Laravel 8</title>
  </head>
  <body>
    <h1 class="text-center mb-4">Data Pegawai</h1>
   <div class="container">
    <!-- button tambah data -->
      <a href="/tambahpegawai" class="btn btn-success">Tambah</a>
    
      <!-- search data -->
    <div class="row g-3 align-items-center mt-2">
      <div class="col-auto">
        <form action="/pegawai" method="GET">  
        <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
        </form>
      </div>

    <div class="col-auto">
      <!-- button export pdf -->  
      <a href="/exportpdf" class="btn btn-info">Export PDF</a>
    </div>
    <div class="col-auto">
      <!-- button export excel -->  
      <a href="#" class="btn btn-info">Export Excel</a>
    </div>

    </div> 
   <!--Akhir dari search data-->
<div class="row">
    
<table class="table">
  <!--kolom atas-->
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Foto</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">No telp</th>
      <th scope="col">Dibuat</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <!--Menampilkan data dari database-->
  <tbody>
    @php
        $no = 1;
    @endphp

    <!--menghitung data berurutan saat menggunakan pagination-->
    @foreach ($data as $index => $row)
    
    <tr>
      <th scope="row">{{ $index +  $data->firstItem() }}</th>
      <td>{{ $row->nama }}</td>
      <td>
        <img src="{{ asset('fotopegawai/'.$row->foto) }}" alt="" style="width: 40px;">
    </td>
      <td>{{ $row->jeniskelamin }}</td>
      <td>{{ $row->notelp }}</td>
      <td>{{ $row->created_at}}</td>
      <td>
        
        <a href="/tampilkandata/{{ $row->id }}" class="btn btn-info">Edit</a>
        <a href="#" type="button" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}">Delete</a>
    </td>
        
    </tr>
    @endforeach
    <!--akhir dari menampilkan data dan akhir dari penomoran pagination--> 
    </tr>
  </tbody>
</table>
<!--membuat tampilan pagination-->
{{ $data->links() }}
    </div>
   </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- link dari bootstraps, jquery, sweetalert, cdnjs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
  <!-- membuat tampilan sweetalert untuk menghapus data -->
  <script>
    $('.delete').click( function() {

      var pegawaiid = $(this).attr('data-id');
      var nama = $(this).attr('data-nama');

      swal({
      title: "Apakah Kamu Yakin?",
      text: "Kamu akan menghapus data pegawai ini dengan id "+pegawaiid+" dengan nama "+nama+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "/delete/"+pegawaiid+""
        swal("Data Berhasil dihapuskan dan tidak bisa dikembalikan", {
          icon: "success",
        });
      } else {
        swal("Hapus Data dibatalkan");
      }
    });


    });

        
  </script>
  <!-- membuat tampilan toastr -->
  <script>
    @if  (Session::has('success'))

    toastr.success("{{ Session::get('success') }}");
    
    @endif

    

  </script>
</html>