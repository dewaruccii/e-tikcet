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
                            <th>Nama </th>
                            <th>Email</th>
                            <th>Is Owner</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>
                                    {{ $item->Maskapai?->name }}
                                </td>
                                <td>
                                    {{ $item->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                </td>
                                <th>{{ $item->getRoleNames() }}</th>
                                <td>
                                    <div class="d-flex " style="gap:5px;">
                                        <a href="{{ route('admin.user.edit', $item->id) }}" class="btn btn-primary"><i
                                                class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>
                                        <button class="btn btn-danger btnDelete" data-id="{{ $item->id }}"><i
                                                class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
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
        $(document).ready(function() {
            $(".btnDelete").on('click', function() {
                let url = '{{ route('admin.maskapai.destroy', ':id') }}';

                let uuid = $(this).data('uuid');
                url = url.replace(':id', uuid);
                console.log(url);
                Swal.fire({
                    title: "Are you sure?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Continue "
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(e) {
                                if (e.status == 200) {
                                    Swal.fire({
                                        title: "Succesfully!",
                                        text: " the page will automatically redirect!.",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        let redirect =
                                            '{{ route('admin.maskapai.index') }}';
                                        location.href = redirect;
                                    });
                                }
                            }
                        })

                    }
                });
            });
        });
    </script>
@endpush
