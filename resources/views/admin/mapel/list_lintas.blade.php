@extends('layouts.app')

@section('title', 'List Users')

@section('content')
@push('css')
    <style>
        h5 {
            padding: 5px;
        }
    </style>
@endpush

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                </i>
            </div>
            <div>Daftar Mata Pelajaran Lintas Minat
                <div class="page-title-subheading">Tables are the backbone of almost all web applications.</div>
            </div>
        </div>
        <div class="page-title-actions">
            <div class="d-inline-block dropdown">
                <button class="btn-shadow btn btn-info" data-toggle="modal" data-target="#MapelAddModal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-window-maximize fa-w-20"></i>
                    </span>
                    Tambahkan Lintas Minat
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
                <div class="list-group" id="sortable-list">
                    <h5 class="card-title">Matapelajaran</h5>
                </div>
                <table class="mb-0 table table-hover" id="tabel_list">
                    <thead>
                        <tr>
                            <th>Semester</th>
                            <th>Nama Matapelajaran</th>
                            <th>Kelas</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center"><div class="mb-2 mr-2 badge badge-pill badge-primary"></div></td>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <button class="btn btn-icon-wrapper btn-edit pr-2" data-toggle="modal" data-target="#MapelEditModal">
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
<div class="modal fade" id="MapelAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Matapelajaran Lintas Minat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('store_lm')}}" method="POST">
                    @csrf
                    <div class="position-relative form-group">
                        <label for="mapel" class="">Matapelajaran</label>
                        <select name="mapel" id="mapel" class="form-control">
                                    @foreach ($mapel as $item)
                                        <option value="{{$item->id_mapel}}">{{$item->nama_mapel}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="position-relative form-group">
                                <label for="sms" class="">Semester</label>
                                <select name="sms" id="sms" class="form-control">
                                    @foreach ($sms as $item)
                                        <option value="{{$item->id_semester}}">{{$item->nama_semester}}</option>
                                    @endforeach
                                </select>
                            </div>
                    <div class="position-relative form-group">
                        <b>
                            <h5>Kelas X</h5>
                        </b>
                        @foreach($kelasx as $item)
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" id="kelas_{{ $item->id_kelas }}" class="custom-control-input" name="kelas[]" value="{{ $item->id_kelas }}">
                                <label class="custom-control-label" for="kelas_{{ $item->id_kelas }}">{{ $item->nama_kelas }}</label>
                            </div>
                        @endforeach
                        <hr>
                        <b>
                            <h5>Kelas XI</h5>
                        </b>
                        @foreach($kelasxi as $item)
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" id="kelas_{{ $item->id_kelas }}" class="custom-control-input" name="kelas[]" value="{{ $item->id_kelas }}">
                                <label class="custom-control-label" for="kelas_{{ $item->id_kelas }}">{{ $item->nama_kelas }}</label>
                            </div>
                        @endforeach
                        <hr>
                        <b>
                            <h5>Kelas XII</h5>
                        </b>
                        @foreach($kelasxii as $item)
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" id="kelas_{{ $item->id_kelas }}" class="custom-control-input" name="kelas[]" value="{{ $item->id_kelas }}">
                                <label class="custom-control-label" for="kelas_{{ $item->id_kelas }}">{{ $item->nama_kelas }}</label>
                            </div>
                        @endforeach
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

<div class="modal fade" id="MapelEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Matapelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="position-relative form-group">
                        <label for="edit_nama_mapel" class="">Nama Matapelajaran</label>
                        <div class="">
                            <input name="edit_nama_mapel" id="edit_nama_mapel" value="" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative form-group">
                        <label for="edit_jenis_mapel" class="">Jenis Matapelajaran</label>
                            <select name="edit_jenis_mapel" id="edit_jenis_mapel" class="form-control">
                                <option value="mn">Muatan Nasional</option>
                                <option value="mk">Muatan Kewilayahan</option>
                                <option value="mc">Muatan C</option>
                                <option value="lm">Lintas Minat</option>
                            </select>
                    </div>
                    <div class="position-relative form-group">
                        <label for="edit_urutan_mapel" class="">Nomor Urut Matapelajaran Pada Rapor</label>
                        <div class="">
                            <input name="edit_urutan_mapel" id="edit_urutan_mapel" value="" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative form-group">
                        <label for="edit_mapel_status" class="">Status Matapelajaran</label>
                            <select name="edit_mapel_status" id="edit_mapel_status" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
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
        var mapel = $(this).data('mapel');
        var kode_mapel = $(this).data('kode');
        var id_mapel = $(this).data('id');
        var jenis = $(this).data('jenis');
        var urutan = $(this).data('sort');
        var status = $(this).data('status');

        $('#edit_nama_mapel').val(mapel);
        $('#edit_urutan_mapel').val(urutan);
        $('#edit_jenis_mapel option').each(function() {
            if($(this).val() == jenis) {
                $(this).prop('selected', true);
            }
        });
        $('#edit_mapel_status option').each(function() {
            if($(this).val() == status) {
                $(this).prop('selected', true);
            }
        });

        $('#form-edit').attr('action', '/admin/mapel/update/' + id_mapel);
    });
</script>
@endpush

@endsection
