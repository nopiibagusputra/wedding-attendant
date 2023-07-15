@extends('layouts.app')

@section('title', 'List Users')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                </i>
            </div>
            <div>Daftar Kurikulum
                <div class="page-title-subheading">Tables are the backbone of almost all web applications.</div>
            </div>
        </div>
        <div class="page-title-actions">
            <div class="d-inline-block dropdown">
                <button class="btn-shadow btn btn-info" data-toggle="modal" data-target="#KurikulumAddModal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-window-maximize fa-w-20"></i>
                    </span>
                    Tambahkan Kurikulum
                </button>
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
                            <th class="text-center">Kode Kurikulum</th>
                            <th>Nama Kurikulum</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        @php $iData = encrypt($data->id_kurikulum); @endphp
                            <tr>
                                <td class="text-center"><div class="mb-2 mr-2 badge badge-pill badge-info">{{ $data->kode_kurikulum}}</div></td>
                                <td>{{ $data->nama_kurikulum }}</td>
                                <td class="text-center">{!! $data->status_kurikulum == 1 ? '<div class="mb-2 mr-2 badge badge-pill badge-success">Aktif</div>' :  '<div class="mb-2 mr-2 badge badge-pill badge-danger">Tidak Aktif</div>' !!}</td>
                                <td class="text-center">
                                    <button class="btn btn-icon-wrapper btn-edit pr-2" data-toggle="modal" data-target="#KurikulumEditModal" data-kurikulum="{{ $data->nama_kurikulum }}" data-kode="{{ $data->kode_kurikulum }}" data-status="{{ $data->status_kurikulum }}" data-id="{{ $iData }}">
                                        <span class="btn-icon-wrapper opacity-7">
                                            <i class="fa fa-window-maximize fa-w-20"></i>
                                        </span>
                                        Edit
                                    </button>
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
<div class="modal fade" id="KurikulumAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Kurikulum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store_kurikulum') }}" method="POST">
                    @csrf
                    <div class="position-relative row form-group">
                        <label for="nama_kurikulum" class="col-sm-2 col-form-label">Nama Kurikulum</label>
                        <div class="col-sm-10">
                            <input name="nama_kurikulum" id="nama_kurikulum" placeholder="Contoh : Kurikulum Merdeka | Kurikulum 2013" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="kode_kurikulum" class="col-sm-2 col-form-label">Kode Kurikulum</label>
                        <div class="col-sm-10">
                            <input name="kode_kurikulum" id="kode_kurikulum" placeholder="Contoh : kumer | k13" type="text" class="form-control">
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

<div class="modal fade" id="KurikulumEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Kurikulum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="position-relative row form-group">
                        <label for="nama_kurikulum_edit" class="col-sm-2 col-form-label">Nama Kurikulum</label>
                        <div class="col-sm-10">
                            <input name="nama_kurikulum_edit" id="nama_kurikulum_edit" value="" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="kode_kurikulum_edit" class="col-sm-2 col-form-label">Kode Kurikulum</label>
                        <div class="col-sm-10">
                            <input name="kode_kurikulum_edit" id="kode_kurikulum_edit" value="" disabled type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="kurikulum_status" class="col-sm-2 col-form-label">Status Kurikulum</label>
                        <div class="col-sm-10">
                            <select name="kurikulum_status" id="kurikulum_status" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
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
        var kurikulum = $(this).data('kurikulum');
        var kode_kurikulum = $(this).data('kode');
        var id_kurikulum = $(this).data('id');
        var status = $(this).data('status');

        $('#nama_kurikulum_edit').val(kurikulum);
        $('#kode_kurikulum_edit').val(kode_kurikulum);
        $('#kurikulum_status').val(status);
        $('#kurikulum_status option').each(function() {
            if($(this).val() == status) {
                $(this).prop('selected', true);
            }
        });

        $('#form-edit').attr('action', '/admin/kurikulum/update/' + id_kurikulum);
    });
</script>
@endpush

@endsection
