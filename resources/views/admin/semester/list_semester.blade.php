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
            <div>Daftar Semester
                <div class="page-title-subheading">Tables are the backbone of almost all web applications.</div>
            </div>
        </div>
        <div class="page-title-actions">
            <div class="d-inline-block dropdown">
                <button class="btn-shadow btn btn-info" data-toggle="modal" data-target="#SemesterAddModal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-window-maximize fa-w-20"></i>
                    </span>
                    Tambahkan Semester
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
                            <th class="text-center">Kode Semester</th>
                            <th>Semester</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        @php $iData = encrypt($data->id_semester); @endphp
                            <tr>
                                <td class="text-center"><div class="mb-2 mr-2 badge badge-pill badge-info">{{ $data->kode_semester}}</div></td>
                                <td>{{ $data->nama_semester }}</td>
                                <td class="text-center">{!! $data->status_semester == 1 ? '<div class="mb-2 mr-2 badge badge-pill badge-success">Aktif</div>' :  '<div class="mb-2 mr-2 badge badge-pill badge-danger">Tidak Aktif</div>' !!}</td>
                                <td class="text-center">
                                    <button class="btn btn-icon-wrapper btn-edit pr-2" data-toggle="modal" data-target="#SemesterEditModal" data-semester="{{ $data->nama_semester }}" data-status="{{ $data->status_semester }}" data-kode="{{ $data->kode_semester }}" data-id="{{ $iData }}">
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
<div class="modal fade" id="SemesterAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store_semester') }}" method="POST">
                    @csrf
                    <div class="position-relative row form-group">
                        <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <input name="semester" id="semester" placeholder="Contoh : 2022 / 2023 Ganjil | 2022 / 2023 Genap" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="kode_semester" class="col-sm-2 col-form-label">Kode Semester</label>
                        <div class="col-sm-10">
                            <input name="kode_semester" id="kode_semester" placeholder="Contoh : 22231 | 22232" type="number" class="form-control">
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

<div class="modal fade" id="SemesterEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="position-relative row form-group">
                        <label for="semester_edit" class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <input name="semester_edit" id="semester_edit" value="" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="kode_semester_edit" class="col-sm-2 col-form-label">Kode Semester</label>
                        <div class="col-sm-10">
                            <input name="kode_semester_edit" id="kode_semester_edit" value="" type="number" disabled class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="semester_status" class="col-sm-2 col-form-label">Status Semester</label>
                        <div class="col-sm-10">
                            <select name="semester_status" id="semester_status" class="form-control">
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
        var semester = $(this).data('semester');
        var kode_semester = $(this).data('kode');
        var id_semester = $(this).data('id');
        var status = $(this).data('status');

        $('#semester_edit').val(semester);
        $('#kode_semester_edit').val(kode_semester);
        $('#semester_status').val(status);
        $('#semester_status option').each(function() {
            if($(this).val() == status) {
                $(this).prop('selected', true);
            }
        });

        $('#form-edit').attr('action', '/admin/semester/update/' + id_semester);
    });
</script>
@endpush


@endsection
