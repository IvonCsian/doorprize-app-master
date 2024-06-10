<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Versi Cetak</title>
    <style>

        @media print {
            @page {
                size: A3 landscape;
                padding: 10px
                    /* margin-bottom: 2cm; */
            }

            table {
                width: 100%;
            }
            * {
                -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
                color-adjust: exact !important;                 /*Firefox*/     /*Firefox*/
            }
            html,
            body {
                width: 100%;
                height: max-content;
            }

            .card{
                padding: 0;
            }
            .card-body{
                padding: 0 10px 0 10px;
            }
            .no-print, .no-print *
            {
                display: none !important;
            }
        /* ... the rest of the rules ... */
        }
    </style>
  </head>
  <body>
    <section id="pembayaran" class="pembayaran">
        <div class="container-fluid mt-5" data-aos="fade-up">
            <div class="mb-3 text-center">
                <h5 class="fw-bold">Penerima Hadiah</h5>
                <hr>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th scope="col" class="px-6 py-3 border-2 border-gray-800">
                                NAK
                            </th>
                            <th scope="col" class="px-6 py-3 border-2 border-gray-800">
                                NIK
                            </th>
                            <th scope="col" class="px-6 py-3 border-2 border-gray-800">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3 border-2 border-gray-800">
                                Departemen
                            </th>
                            <th scope="col" class="px-6 py-3 border-2 border-gray-800">
                                Bagian
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hadiah
                            </th>
                            <th scope="col" class="text-start">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerima as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nak }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->nama_penerima }}</td>
                                <td>{{ $item->departemen }}</td>
                                <td>{{ $item->bagian }}</td>
                                <td>{{ $item->hadiah_pemenang }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y ') }}
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @php
            $name = 'Penerima' . '.xls';
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=$name");
    @endphp

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
