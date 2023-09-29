<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Biaya;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Models\Tagihan as Model;
use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;

class TagihanController extends Controller
{
    private $viewIndex = 'tagihan_index';
    private $viewCreate = 'tagihan_form';
    private $viewEdit = 'tagihan_form';
    private $viewShow = 'tagihan_show';
    private $routePrefix = 'tagihan';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $models = Model::with('user', 'siswa')
                ->whereMonth('tanggal_tagihan', $request->bulan)
                ->whereYear('tanggal_tagihan', $request->tahun)
                ->groupBy('siswa_id')
                ->latest()
                ->paginate(50);
        } else {
            $models = Model::with('user', 'siswa')->groupBy('siswa_id')->latest()->paginate(50);
        }

        $data = [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Tagihan',
        ];
        return view('operator.' . $this->viewIndex, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::all();
        $data = [
            'model' =>  new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Data Tagihan',
            'angkatan' => $siswa->pluck('angkatan', 'angkatan'),
            'kelas' => $siswa->pluck('kelas', 'kelas'),
            'biaya' => Biaya::get(),
        ];

        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagihanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagihanRequest $request)
    {
        // 1. lakukan validasi
        // 2. ambil data biaya yang ditagihkan
        // 3. ambil data siswa yang ditagihkan berdasarkan kelas atau berdasarkan angkatan
        // 4. lakukan berdasarkan data siswa
        // 5. didalam perulangan, simpan tagihan berdasarkan biaya dan siswa
        // 6. simpan notifikasi database untuk tagihan
        // 7. kirim pesan whatsapp
        // 8. redirect back() dengan pesan sukses

        $requestData = $request->validated();
        $biayaIdArray = $requestData['biaya_id'];
        $siswa = Siswa::query();

        if ($requestData['kelas'] != '') {
            $siswa->where('kelas', $requestData['kelas']);
        }
        if ($requestData['angkatan'] != '') {
            $siswa->where('angkatan', $requestData['angkatan']);
        }
        $siswa = $siswa->get();

        foreach ($siswa as $item) {
            $itemSiswa = $item;
            $biaya = Biaya::whereIn('id', $biayaIdArray)->get();
            foreach ($biaya as $itemBiaya) {
                $dataTagihan = [
                    'siswa_id' => $itemSiswa->id,
                    'angkatan' => $requestData['angkatan'],
                    'kelas' => $requestData['kelas'],
                    'tanggal_tagihan' => $requestData['tanggal_tagihan'],
                    'tanggal_jatuh_tempo' => $requestData['tanggal_jatuh_tempo'],
                    'nama_biaya' => $itemBiaya->nama,
                    'jumlah_biaya' => $itemBiaya->jumlah,
                    'keterangan' => $requestData['keterangan'],
                    'status' => 'Baru',
                ];
                $tanggalJatuhTempo = Carbon::parse($requestData['tanggal_jatuh_tempo']);
                $tanggaalTagihan = Carbon::parse($requestData['tanggal_tagihan']);
                $bulanTagihan = $tanggaalTagihan->format('m');
                $tahunTagihan = $tanggaalTagihan->format('Y');
                $cekTagihan = Model::where('siswa_id', $itemSiswa->id)
                    ->whereMonth('tanggal_tagihan', $bulanTagihan)
                    ->whereYear('tanggal_tagihan', $tahunTagihan)
                    ->first();
                if ($cekTagihan == null) {
                    Model::create($dataTagihan);
                }
            }
        }

        flash('Data tagihan berhasil disimpan')->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $tagihan = Model::with('siswa')->where('siswa_id', $request ->siswa_id)
        ->whereMonth('tanggal_tagihan', $request->bulan)
        ->whereYear('tanggal_tagihan', $request->tahun)
        ->get();
        dd($tagihan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tagihan $tagihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagihanRequest  $request
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagihanRequest $request, Tagihan $tagihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tagihan $tagihan)
    {
        //
    }
}
