<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-1">
        <audio id="winSound">
            <source src="{{ asset('audio/short-crowd-cheer-6713.mp3') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <audio id="winSoundLoading">
            <source src="{{ asset('audio/level-up-bonus-sequence-2-186891.mp3') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <div class="pyro z-50 hidden" id="firework">
            <div class="before"></div>
            <div class="after"></div>
        </div>
        <div class="mx-auto h-full">

            <section style="background-image: url('{{ asset('img/DSCF2981.jpg') }}')" class="relative h-screen bg-no-repeat bg-center bg-cover bg-fixed overflow-hidden">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @endauth
                    </div>
                @endif

                <section class="bg-gray-300 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-50 max-w-4xl border-4 mx-auto mt-48 mb-5 border-gray-800" id="form-dooprize">
                    <div class="flex justify-end p-5">
                        <a href="{{ route('grandprize') }}" class="underline font-bold hover:text-blue-900">Grand Prize</a>
                    </div>
                    <script src="{{ mix('js/app.js') }}"></script>
                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-12 space-y-6 bg-opacity-50 dark:bg-opacity-50">
                        <h1 class="mb-10 from-indigo-500 via-purple-500 to-pink-500 text-4xl font-extrabold text-center tracking-tight leading-none text-blue-800 md:text-5xl lg:text-6xl dark:text-white underline decoration-wavy decoration-indigo-500">RANDOM DOORPRIZE</h1>
                        <div>
                            <form id="dooprizeForm" class="max-w-full mx-auto space-y-6">
                                @csrf
                                <div>
                                    <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                                            </svg>
                                        </div>
                                        <input type="text" id="jumlah" name="jumlah" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-800 focus:border-gray-800 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-800 dark:focus:border-gray-800" placeholder="Jumlah yang mendapatkan...">
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" id="random" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                            Random
                                        </span>
                                    </button>
                                </div>
                                @include('components.loading')

                            </form>
                            <div id="loading" class="w-full h-full invisible flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    Mohon bersabar pemenangnya adalah...
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-gray-300 dark:bg-gray-900 max-w-4xl border-4 mx-auto mt-48 mb-5 border-gray-800 hidden overflow-y-auto h-screen" id="list-pemenang">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-12 space-y-6">
                        <div class="flex justify-between">
                            <h4 class="font-bold">List Pemenang : </h4>
                            <div class="gap-2">
                                <button type="button" id="kembali" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        Kembali
                                    </span>
                                </button>
                                <a href="{{ route('export') }}"  class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Export</a>
                            </div>

                        </div>
                        <div class="relative overflow-y-auto h-screen">
                            <table class=" text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-2 border-gray-800 overflow-scroll w-full">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-900 bg-opacity-50  dark:text-gray-400">
                                    <tr class="border-2 border-gray-800">
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
                                    </tr>
                                </thead>
                                <tbody id="winnersList">
                                    <!-- Daftar pemenang akan ditampilkan di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </section>
        </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#kembali').on('click',function() {
            $('#list-pemenang').addClass('hidden')
            $('#form-dooprize').removeClass('hidden')
            $('#firework').addClass('hidden');
        })
        $(document).ready(function() {
            $('#random').on('click',function() {
                   // loading screen
                $("#preload-data").removeClass("hidden");
                const winSoundLoad = document.getElementById('winSoundLoading');

                winSoundLoad.addEventListener('ended', function() {
                    this.currentTime = 0;
                    this.play();
                }, false);

                winSoundLoad.play();
            })
            $('#dooprizeForm').on('submit', function(event) {
                event.preventDefault();

                const jumlah = $('#jumlah').val();
                const loading = $('#loading');
                loading.removeClass('invisible');
                // loading screen

                // Memanggil route pick.winners dengan menggunakan AJAX
                $.ajax({
                    url: "{{ route('pick.winners') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "jumlah": jumlah
                    },
                    success: function(data) {
                        if (data != 'Tidak ada pemenang') {
                            $('#list-pemenang').removeClass('hidden')
                            const winnersList = $('#winnersList');
                            winnersList.empty(); // Menghapus konten sebelumnya

                            // Menambahkan daftar pemenang ke dalam tabel
                            $.each(data, function(index, winner) {
                                winnersList.append(`
                                    <tr class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white border-2 border-gray-800">
                                        <td class="px-6 py-4">
                                            ${winner.nak}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white border-2 border-gray-800">
                                            ${winner.nik}
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white border-2 border-gray-800">
                                            ${winner.recipient}
                                        </th>
                                        <td class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white border-2 border-gray-800">
                                            ${winner.departemen}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white border-2 border-gray-800">
                                            ${winner.bagian}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white border-2 border-gray-800">
                                            ${winner.prize}
                                        </td>
                                    </tr>
                                `);
                            });

                            loading.addClass('invisible');
                            $("#preload-data").addClass("hidden");
                            const winSoundLoading = document.getElementById('winSoundLoading');
                                        winSoundLoading.pause();
                            // Munculkan animasi kembang api
                            // const firework = $('').css({
                            //     top: Math.random() * $(window).height(),
                            //     left: Math.random() * $(window).width()
                            // });
                            // Putar suara menang
                            const winSound = document.getElementById('winSound');
                            winSound.play();

                            $('#firework').removeClass('hidden');
                            $('#form-dooprize').addClass('hidden')

                            // $('body').append(firework);
                        }else{
                            loading.addClass('invisible');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        loading.addClass('invisible');
                        $('#form-dooprize').removeClass('hidden')

                    }
                });
            });
        });
    </script>
</html>
