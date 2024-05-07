<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="{{ mix('js/app.js') }}" defer></script>

@extends('layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning">{{ $error }}</div>
        @endforeach
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Osztály Név</th>
                <th>Összes Pontszám</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($osszesitett_pontszam as $adat)
                <tr>
                    <td>{{ $adat->osztlay_nev }}</td>
                    <td>{{ $adat->osszpont }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form method="POST" action="{{ route('bejegyzesek.store') }}">
        @csrf
        <div class="row">
            <div class="col-sm-3">
                <select class="form-control" name="osztlay_nev">
                    <option value="" disabled selected>Válassz osztályt!</option>
                    @foreach ($osztalyok as $osztaly)
                        <option value="{{ $osztaly->osztlay_nev }}">{{ $osztaly->osztlay_nev }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="tevekenyseg_id">
                    <option value="" disabled selected>Válassz tevékenységet!</option>
                    @foreach ($tevekenysegek as $tevekenyseg)
                        <option value="{{ $tevekenyseg->tevekenyseg_id }}">
                            {{ $tevekenyseg->tevekenyseg_nev }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-3">
                <button type="submit" class="btn btn-success">Küld</button>
            </div>
        </div>
    </form>



    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>tevékenység neve</th>
                <th>osztlay név</th>
                <th>állapot</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bejegyzesek as $bejegyzes)
                <tr>
                    <td>{{ $bejegyzes->id }}</td>
                    <td>{{ $bejegyzes->tevekenyseg->tevekenyseg_nev }}</td>
                    <td>{{ $bejegyzes->osztlay_nev }}</td>
                    <td>{{ $bejegyzes->allapot ? 'Elfogadva' : 'Nincs elfogadva' }}</td>
                    <td> <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"
                            onclick="loadBejegyzesDetails({{ $bejegyzes->id }})">Megtekint</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="container">
        <!-- Modal -->
        <!-- resources/views/bejegyzesek/index.blade.php -->
        <div class="modal fade" id="bejegyzesModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modalTitle"></h3>
                    </div>
                    <div class="modal-body" id="modalBody">
                        <!-- Tartalom betöltése AJAX-al -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Bezárás</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadBejegyzesDetails(id) {
            $.ajax({
                url: '{{ url('bejegyzesek') }}/' + id,
                method: 'GET',
                success: function(data) {
                    $('#modalTitle').text(data.osztlay_nev);
                    $('#modalBody').html(`
                        <p>Bejegyzés ID: ${data.id}</p>
                        <p>Osztály név: ${data.osztlay_nev}</p>
                        <p>Tevékenység név: ${data.tevekenyseg.tevekenyseg_nev}</p>
                        <p>Tevékenység pontszáma: ${data.tevekenyseg.pontszam}</p>
                        <p>Állapot: ${data.allapot ? 'Elfogadva' : 'Nincs elfogadva'}</p>
                    `);
                    $('#bejegyzesModal').modal('show');
                }
            });
        }
    </script>

@endsection
