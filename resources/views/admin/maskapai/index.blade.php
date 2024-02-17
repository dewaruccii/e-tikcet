@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>List Maskapai</h1>
                <a href="{{ route('admin.maskapai.create') }}" class="btn btn-primary">Tambah Maskapai</a>
            </div>
            <div class="card p-3">
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Maskapai </th>
                            <th>Logo</th>
                            <th>Description</th>
                            <th>Owner</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maskapai as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ asset('storage' . $item->logo) }}" id="linkPreview" class="spotlight"
                                        data-title="Logo">

                                        <img src="{{ asset('storage' . $item->logo) }}" id="previewImage" alt="Preview"
                                            style=" max-width: 50px; max-height: 50px;">
                                    </a>
                                </td>
                                <td>
                                    {{ $item->description }}
                                </td>
                                <th>{{ $item->Owner?->name }}</th>

                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.maskapai.edit', $item->uuid) }}" class="btn btn-primary"><i
                                                class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
@push('js')
    <script>
        $("#datatables").DataTable({});
    </script>
@endpush
