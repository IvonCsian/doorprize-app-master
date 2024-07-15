<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome  -->
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: 'Tinos', serif;
            font: 12pt;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        p, table, ol{
            font-size: 9pt;
        }
        

        @page {
            margin: 0;  /* Ini akan diterapkan ke setiap halaman */
            size: portrait;
        }

        @page :first {
            margin-top: 0mm;  /* Hanya diterapkan ke halaman pertama */
        }
        @media print {
            /* Sembunyikan thead di semua halaman */
            thead {
                display: table-header-group;
            }

            thead.no-print {
                display: none;
            }

            @page {
                /* Hanya tampilkan thead di halaman pertama */
                margin-top: 0;
            }

            @page :not(:first) {
                margin-top: 0;
            }
            /* html, body {
                width: 210mm;
                height: 297mm;
            } */
            .no-print, .no-print *
            {
                display: none !important;
            }
        /* ... the rest of the rules ... */
        }
    </style>
</head>
<body>
    <div class="p-4 my-5">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card" style="border: none">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title pt-2 font-weight-bold" style="font-weight: bold">Laporan</h4>
                            <div class="mx-3">
                                <button onclick="history.back()" class="btn btn-primary btn-icon-text no-print"><i class="ti-angle-left btn-icon-prepend"></i> Kembali</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                  <tr>
                                    <th>No</th>
                                    <td>{{$loop->iteration}}</td>
                                  </tr>
                                  <tr>
                                    <th>NAK</th>
                                    <td>{{ ucwords($data->nak) }}</td>
                                  </tr>
                                  <tr>
                                    <th>NIK</th>
                                    <td>{{ ucwords($data->nik) }}</td>
                                  </tr>
                                  <tr>
                                    <th>Nama</th>
                                    <td>{{ ucwords($data->nama_penerima) }}</td>
                                  </tr>
                                  <tr>
                                    <th>Departemen</th>
                                    <td>{{ ucwords($data->departemen) }}</td>
                                  </tr>
                                  <tr>
                                    <th>Bagian</th>
                                    <td>{{ date('d M Y', strtotime($data->tanggal )) }}</td>
                                  </tr>
                                  <tr>
                                    <th>Hadiah</th>
                                    <td>{{ ucwords($data->hadiah_pemenang) }}</td>
                                  </tr>              
                              </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
<script>
     print();
</script>
</html>
