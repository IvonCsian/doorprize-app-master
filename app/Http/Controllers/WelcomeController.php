<?php

namespace App\Http\Controllers;

use App\Models\Dooprize;
use App\Models\PemenangGrandPrize;
use App\Models\Penerima;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    public function index() {
        return view('welcome');
    }
    public function grandprize() {

        return view('grandprize');
    }
     /**
     * Generate random dooprizes for recipients from the database.
     *
     * @param int $numberOfPrizes
     * @return array
     */
    public function generateGrandPrize(Request $request) {
        $numberOfPrizes = $request->jumlah;

        // Simulasi penundaan 5 detik untuk memperoleh pemenang
        // sleep(5);

        $dooprizes = [];
        $count = Recipient::count();
        // if ($count < $numberOfPrizes) {
        //     return 'Tidak ada pemenang';
        // }
        // Get recipients from the database
        $recipients = Penerima::inRandomOrder()->limit($numberOfPrizes)->get();
        $selectedPrizes = [];
        // Generate random prizes for each recipient
        foreach ($recipients as $recipient) {
            $prize = $this->generateRandomGrandPrize($selectedPrizes);
            $penerima = new PemenangGrandPrize;
            $penerima->nama_penerima = $recipient->nama_penerima;
            $penerima->hadiah_pemenang = $prize;
            $penerima->nak = $recipient->nak;
            $penerima->nik = $recipient->nik;
            $penerima->departemen = $recipient->departemen;
            $penerima->bagian = $recipient->bagian;
            $penerima->save();
            Dooprize::where('status','grandprize')->where('name',$prize)->first()->delete();
            // Session::put('prize', $prize);
            // Session::put('recipient', $recipient->nama_penerima);
            $selectedPrizes[] = $prize;
            $dooprizes[] = [
                'recipient' => $recipient->nama_penerima,
                'prize' => $prize,
                'nak' => $recipient->nak,
                'nik' => $recipient->nik,
                'departemen' => $recipient->departemen,
                'bagian' => $recipient->bagian,
                'status' => $recipient->status,
            ];
        }
        return $dooprizes;
    }
    public function generateDooprizes(Request $request)
    {
        $numberOfPrizes = $request->jumlah;

        // Simulasi penundaan 5 detik untuk memperoleh pemenang
        // sleep(5);

        $dooprizes = [];
        $count = Recipient::count();
        // if ($count < $numberOfPrizes) {
        //     return 'Tidak ada pemenang';
        // }
        // Get recipients from the database
        $recipients = Recipient::where('status','hadir')->inRandomOrder()->limit($numberOfPrizes)->get();

        // Generate random prizes for each recipient
        foreach ($recipients as $recipient) {
            $prize = $this->generateRandomPrize();
            $findDooprize = Dooprize::where('name',$prize)->first();
            $penerima = new Penerima;
            $penerima->id_penerima = $recipient->id;
            $penerima->id_hadiah = $findDooprize->id;
            $penerima->nama_penerima = $recipient->name;
            $penerima->nama_hadiah = $prize;
            $penerima->nak = $recipient->nak;
            $penerima->nik = $recipient->nik;
            $penerima->departemen = $recipient->departemen;
            $penerima->bagian = $recipient->bagian;
            $penerima->save();
            $deletDooprize = Dooprize::where('name',$prize)->first()->delete();
            $deletePenerima = Recipient::find($recipient->id)->delete();
            Session::put('prize', $prize);
            Session::put('recipient', $recipient->name);
            Session::put('nak', $recipient->nak);
            Session::put('nik', $recipient->nik);
            Session::put('departemen', $recipient->departemen);
            Session::put('bagian', $recipient->bagian);
            $dooprizes[] = [
                'recipient' => Session::get('recipient'),
                'prize' => Session::get('prize'),
                'nak' => Session::get('nak'),
                'nik' => Session::get('nik'),
                'departemen' => Session::get('departemen'),
                'bagian' => Session::get('bagian'),
                'status' => Session::get('status'),
            ];
        }

        return $dooprizes;
    }

    /**
     * Generate a random prize.
     *
     * @return string
     */
    private function generateRandomPrize()
    {
        // Example of possible prizes, modify as needed
        $prizes = Dooprize::where('status','general')->latest()->pluck('name')->toArray();
        return $prizes[array_rand($prizes)];
    }

    private function generateRandomGrandPrize($selectedPrizes)
    {
        // Hapus hadiah yang sudah dipilih dari daftar hadiah yang tersedia
        $prizes = Dooprize::where('status','grandprize')->latest()->pluck('name')->toArray();
        $prizes = array_diff($prizes, $selectedPrizes);

        // Memilih hadiah secara acak dari daftar hadiah yang tersedia
        $selectedPrize = $prizes[array_rand($prizes)];

        // Mengembalikan hadiah yang dipilih
        return $selectedPrize;

    }

    public function export() {
        $penerima = Penerima::latest()->get();
        return view('export',compact('penerima'));
    }
    public function exportGrandprize() {
        $penerima = PemenangGrandPrize::latest()->get();
        return view('export-grand',compact('penerima'));
    }
    public function pdfDownload(Request $request)
    {
        $data = Penerima::latest();
        $query = $data->get();
        return view('pdf',['data' => $query]);
    }
    public function gppdfDownload(Request $request)
    {
        $data = PemenangGrandPrize::latest();
        $query = $data->get();
        return view('gppdf',['data' => $query]);
    }
}
