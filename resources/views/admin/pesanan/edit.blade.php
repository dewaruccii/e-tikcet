@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Detail Pesanan - {{ $pesanan->uuid }} </h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="">Nama Pemesan :</label>
                                <h2>{{ $pesanan->User?->name }}</h2>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="">Nama Jumlah Tiket :</label>
                                <h2>{{ $pesanan->qty }} Tiket</h2>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="">Nama Maskapai :</label>
                                <h2>{{ $pesanan->Product?->Maskapai?->name }} </h2>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="">Bandara Keberangkatan :</label>
                                <h2>{{ $pesanan->Product?->Detail?->FromAirport?->name }}</h2>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="">Bandara Tujuan :</label>
                                <h2>{{ $pesanan->Product?->Detail?->DestinationAirport?->name }}</h2>

                            </div>
                        </div>


                    </div>
                    <div class="d-flex gap-3 justify-content-end mt-5">
                        <a href="{{ route('admin.pesanan.index') }}" class="btn btn-primary">Kembali</a>
                        <button class="btn btn-success btnConfirm">Approve</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(".btnConfirm").on('click', function() {
                let url = '{{ route('admin.pesanan.update', ':id') }}';
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
                    confirmButtonText: "Yes, Confirm "
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: url,
                            type: 'PUT',
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
                                            '{{ route('admin.pesanan.index') }}';
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
