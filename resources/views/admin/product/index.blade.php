@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>List Products</h1>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Product</a>
            </div>
            <div class="card p-3">
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Penerbangan </th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ formatRupiah($item->price) }}</td>

                                <td>{{ $item->is_active == 1 ? 'Active' : 'Tidak Active' }}</td>
                                <td>{{ $item->description }}</td>
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
