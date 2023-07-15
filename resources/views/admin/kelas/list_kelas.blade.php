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
            <div>Daftar Kelas
                <div class="page-title-subheading">Tables are the backbone of almost all web applications.</div>
            </div>
        </div>
        <div class="page-title-actions">
            <div class="d-inline-block dropdown">
                <button class="btn-shadow btn btn-info" data-toggle="modal" data-target="#KelasAddModal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-window-maximize fa-w-20"></i>
                    </span>
                    Tambahkan Kelas
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
                            <th class="text-center">Nama Kelas</th>
                            <th class="text-center">Program Studi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        @php $iData = encrypt($data->id_kelas); @endphp
                            <tr>
                                <td class="text-center"><div class="mb-2 mr-2 badge badge-pill badge-info">Kelas {{ $data->nama_kelas }}</div></td>
                                <td class="text-center">{{ $data->nama_prodi == null ? 'Kurikulum Merdeka' : $data->nama_prodi }}</td>
                                <td class="text-center">{!! $data->status_kelas === 1 ? '<div class="mb-2 mr-2 badge badge-pill badge-success">Aktif</div>' :  '<div class="mb-2 mr-2 badge badge-pill badge-danger">Tidak Aktif</div>' !!}</td>
                                <td class="text-center">
                                    <button class="btn btn-icon-wrapper btn-edit pr-2" data-toggle="modal" data-target="#KelasEditModal" data-kelas="{{ $data->nama_kelas }}" data-status="{{ $data->status_kelas }}" data-id="{{ $iData }}" data-prodi="{{ $data->id_program_studi }}">
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
<div class="modal fade" id="KelasAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store_kelas') }}" method="POST">
                    @csrf
                    <div class="position-relative row form-group">
                        <label for="kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                        <div class="col-sm-10">
                            <input name="kelas" id="kelas" placeholder="Masukkan Nama Kelas" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                        <div class="col-sm-10">
                            <select name="prodi" id="prodi" class="form-control">
                                @foreach ($prodi as $p)
                                    <option value="{{$p->id_prodi}}">{{$p->nama_prodi}}</option>
                                @endforeach
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

<div class="modal fade" id="KelasEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="position-relative row form-group">
                        <label for="kelas_edit" class="col-sm-2 col-form-label">Nama Kelas</label>
                        <div class="col-sm-10">
                            <input name="kelas_edit" id="kelas_edit" value="" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="prodi_edit" class="col-sm-2 col-form-label">Program Studi</label>
                        <div class="col-sm-10">
                            <select name="prodi_edit" id="prodi_edit" class="form-control">
                                <option value=""></option>
                                @foreach ($prodi as $p)
                                    <option value="{{$p->id_prodi}}">{{$p->nama_prodi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="kelas_status" class="col-sm-2 col-form-label">Status Kelas</label>
                        <div class="col-sm-10">
                            <select name="kelas_status" id="kelas_status" class="form-control">
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
    $(document).on('click', '.btn-edit', function() {
        var kelas = $(this).data('kelas');
        var status = $(this).data('status');
        var id_prodi = $(this).data('prodi');
        var id_kelas = $(this).data('id');

        $('#kelas_edit').val(kelas);

        $('#prodi_edit option').each(function() {
            if($(this).val() == id_prodi) {
                $(this).prop('selected', true);
            }
        });
        $('#kelas_status option').each(function() {
            if($(this).val() == status) {
                $(this).prop('selected', true);
            }
        });

        $('#form-edit').attr('action', '/admin/kelas/update/' + id_kelas);
    });
</script>
@endpush
@endsection
