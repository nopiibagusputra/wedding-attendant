@extends('layouts.app')

@section('title', 'List Users')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-drawer icon-gradient bg-happy-itmeo"></i>
            </div>
            <div>Daftar Tamu
                <div class="page-title-subheading">Tables are the backbone of almost all web applications.</div>
            </div>
        </div>
        <div class="page-title-actions">
            <div class="d-inline-block dropdown">
                <button class="btn-shadow btn btn-info" data-toggle="modal" data-target="#UserAddModal"">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-user-plus fa-w-20"></i>
                    </span>
                    Tambahkan Tamu
                </button>
                <button class="btn-shadow btn btn-info" data-toggle="modal" data-target="#GuestImportModal"">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-user-plus fa-w-20"></i>
                    </span>
                    Import Tamu
                </button>
                <a href="{{route('guestPrint')}}" class="btn-shadow btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-user-plus fa-w-20"></i>
                    </span>
                    Cetak Barcode
                </a>
                <a href="{{route('guestPrints')}}" class="btn-shadow btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-user-plus fa-w-20"></i>
                    </span>
                    Cetak Nama
                </a>
            </div>
        </div>
    </div>
</div>
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
        <p class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="Close">&times;</a></p>
    @endif
@endforeach
@if(count($errors) > 0)
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }} <br/>
    @endforeach
</div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">List</h5>
                <table class="mb-0 table table-hover" id="tabel_list">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>Kode</th> --}}
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($data as $data)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                {{-- <td>{{ $data->kode_guest }}</td> --}}
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td class="text-center">{!! $data->status === 1 ? '<div class="mb-2 mr-2 badge badge-pill badge-success">Tamu Hadir</div>' :  '<div class="mb-2 mr-2 badge badge-pill badge-danger">Tamu Belum Hadir</div>' !!}</td>
                                <td class="text-center">
                                    <button class="btn btn-icon-wrapper btn-edit pr-2" data-toggle="modal" data-target="#GuestEditModal" data-nama="{{ $data->nama }}" data-alamat="{{ $data->alamat }}" data-id="{{ $data->id_guest }}">
                                        <span class="btn-icon-wrapper opacity-7">
                                            <i class="fa fa-user-plus fa-w-20"></i>
                                        </span>
                                        Edit
                                    </button>
                                    <a href="{{ route('guestDelete', $data->id_guest) }}" class="remove" style="color: red">
                                        <span class="btn-icon-wrapper opacity-7">
                                            <i class="fa fa-user-times fa-w-20"></i>
                                        </span>
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@push('modal')
<div class="modal fade" id="UserAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('guestStore') }}" method="POST">
                    @csrf
                    <div class="position-relative row form-group">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input name="nama" id="nama" placeholder="Masukkan Nama Tamu" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="name" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" id="alamat" placeholder="Masukkan Alamat Tamu" type="text" class="form-control"></textarea>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="GuestImportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('guestImport') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="position-relative row form-group">
                        <div class="col-sm-10">
                            <input type="file" name="file" accept=".xlsx">
                        </div>
                    </div>
                    <small>
                        <a href="{{url('/assets/download/Import_Tamu.xlsx')}}">Download Format Import</a>
                    </small>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="GuestEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="position-relative row form-group">
                        <label for="nama_edit" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input name="nama_edit" id="nama_edit" value="" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="alamat_edit" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input name="alamat_edit" id="alamat_edit" value="" type="text" class="form-control">
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush
@push('scripts')
<script type="text/javascript">
 $('.remove').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Apakah Anda Yakin<br>Ingin Menghapus Data ?',
                text: "Data Yang Sudah Dihapus Tidak Dapat Dikembalikan !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Data !',
                cancelButtonText: 'Batalkan'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Terhapus!',
                    'Data Berhasil Dihapuskan!',
                    'success'
                    )
                    setTimeout(function() {
                    if (result.isConfirmed) {
                        window.location.href = url;}
                    }, 2000);
                }
            })
        });
</script>

<script type="text/javascript">
    $(document).on('click', '.btn-edit', function() {
        var nama = $(this).data('nama');
        var alamat = $(this).data('alamat');
        var id_guest = $(this).data('id');

        $('#nama_edit').val(nama);
        $('#alamat_edit').val(alamat);

        $('#form-edit').attr('action', '/admin/guest/update/' + id_guest);
    });
</script>
@endpush

@endsection
