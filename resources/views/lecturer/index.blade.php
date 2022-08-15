@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('lecturer.import') }}" method="post" enctype="multipart/form-data">
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP / NIDN</th>
                                <th>Nama</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lecturers as $lecturer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lecturer->code }}</td>
                                    <td>{{ $lecturer->name }}</td>
                                    <td>
                                        @if ($lecturer->readinesses)

                                            <a href="{{ route('readiness.add', $lecturer->id) }}" class="btn btn-success">Tambah Jam</a>
                                        @else
                                            <a href="{{ route('readiness.add', $lecturer->id) }}" class="btn btn-warning">Update Jam</a>
                                        @endif
                                    </td>
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
