<?php

namespace App\Http\Controllers;

use App\Models\Bejegyzesek;
use App\Models\Tevekenyseg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BejegyzesekController extends Controller
{

    public function index()
    {
        $bejegyzesek = Bejegyzesek::with('tevekenyseg')->get();
        $osztalyok = Bejegyzesek::select('osztlay_nev')->distinct()->get();
        $tevekenysegek = Tevekenyseg::all();
        $osszesitett_pontszam = DB::table('bejegyzesek')
            ->join('tevekenyseg', 'bejegyzesek.tevekenyseg_id', '=', 'tevekenyseg.tevekenyseg_id')
            ->select('bejegyzesek.osztlay_nev', DB::raw('SUM(tevekenyseg.pontszam) as osszpont'))
            ->groupBy('bejegyzesek.osztlay_nev')
            ->get();
        return view('bejegyzesek.index', compact('bejegyzesek', 'tevekenysegek', 'osztalyok', 'osszesitett_pontszam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Adatok érvényesítése
        $validatedData = $request->validate([
            'tevekenyseg_id' => 'required|exists:tevekenyseg,tevekenyseg_id',
            'osztlay_nev' => 'required|string|max:255'
        ]);

        // Új bejegyzés létrehozása
        $bejegyzesek = Bejegyzesek::create([
            'tevekenyseg_id' => $validatedData['tevekenyseg_id'],
            'osztlay_nev' => $validatedData['osztlay_nev'],
            'allapot' => $validatedData['allapot'] ?? '0' // Alapértelmezett érték false
        ]);

        //$bejegyzesek->save();

        // Az új bejegyzés visszaadása sikerüzenettel
        return redirect()->back()->with('success', 'Az adatok sikeresen mentésre kerültek!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bejegyzes = Bejegyzesek::with('tevekenyseg')->findOrFail($id);

        return response()->json($bejegyzes);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bejegyzesek $bejegyzesek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bejegyzesek $bejegyzesek)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bejegyzesek $bejegyzesek)
    {
        //
    }
}
