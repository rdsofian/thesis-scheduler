@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('temporary.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" >
                        </div>
                        <div class="form-group">
                            <input type="submit" value="import" >
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id="temporary-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari, Tanggal</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Pembimbing</th>
                                <th>Penguji 1</th>
                                <th>Penguji 2</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temporaries as $temporary)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $temporary->day_name . ", " . date("d M Y", strtotime($temporary->date)) }}</td>
                                    <td>{{ $temporary->time }}</td>
                                    <td>{{ $temporary->room }}</td>
                                    <td>{{ $temporary->code }}</td>
                                    <td>{{ $temporary->name }}</td>
                                    <td>{{ $temporary->faculty }}</td>
                                    <td>{{ $temporary->lecturer }}</td>
                                    <td>{{ $temporary->chairman }}</td>
                                    <td>{{ $temporary->vice_chairman }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $.noConflict();

            $('#temporary-table').DataTable({
                "columnDefs": [
                    { "searchable": false, "targets": 7 }
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection
