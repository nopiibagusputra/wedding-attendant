@extends('layouts.app')

@section('title', 'List Users')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-drawer icon-gradient bg-happy-itmeo"></i>
            </div>
            <div>Daftar Pengguna
                <div class="page-title-subheading">Tables are the backbone of almost all web applications.</div>
            </div>
        </div>
        <div class="page-title-actions">
            <div class="d-inline-block dropdown">
                <button class="btn-shadow btn btn-info" data-toggle="modal" data-target="#UserAddModal"">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-user-plus fa-w-20"></i>
                    </span>
                    Tambahkan Pengguna
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
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($data as $data)
                        @php $iData = encrypt($data->id_users); @endphp
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td class="text-center">{!! $data->active === 1 ? '<div class="mb-2 mr-2 badge badge-pill badge-success">Aktif</div>' :  '<div class="mb-2 mr-2 badge badge-pill badge-danger">Tidak Aktif</div>' !!}</td>
                                <td class="text-center">
                                    @if($data->level == 'admin')
                                        <div class="badge badge-pill badge-info">{{ $data->level }}</div>
                                    @else
                                        <div class="badge badge-pill badge-alternate">{{ $data->level }}</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-icon-wrapper btn-edit pr-2" data-toggle="modal" data-target="#UserEditModal" data-nama="{{ $data->name }}" data-level="{{ $data->level }}" data-id="{{ $iData }}" data-email="{{ $data->email }}" data-active={{ $data->active }}>
                                        <span class="btn-icon-wrapper opacity-7">
                                            <i class="fa fa-user-plus fa-w-20"></i>
                                        </span>
                                        Edit
                                    </button>
                                    <a href="{{ route('hapus_users', $iData) }}" class="remove" style="color: red">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store_users') }}" method="POST">
                    @csrf
                    <div class="position-relative row form-group">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input name="name" id="name" placeholder="Masukkan Nama" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" id="email" placeholder="Masukkan Email" type="email" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input name="password" id="password" placeholder="Masukkan Password" type="password"
                            class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" type="password"
                            class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="level" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <select name="level" id="level" class="form-control">
                                <option value="sekolah">Sekolah</option>
                                <option value="admin">Admin</option>
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

<div class="modal fade" id="UserEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger fade show" role="alert">Jika tidak ingin mengganti Password, Biarkan Kolom Password Kosong !</div>
                <form id="form-edit" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="position-relative row form-group">
                        <label for="name_edit" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input name="name_edit" id="name_edit" value="" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="email_edit" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email_edit" id="email_edit" value="" type="email" class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="password_edit" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input name="password_edit" id="password_edit" placeholder="Masukkan Password" type="password"
                            class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="password_confirmation_edit" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input name="password_confirmation_edit" id="password_confirmation_edit" placeholder="Konfirmasi Password" type="password"
                            class="form-control">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="level_edit" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <select name="level_edit" id="level_edit" class="form-control">
                                <option value="sekolah">Sekolah</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="users_status" class="col-sm-2 col-form-label">Status Pengguna</label>
                        <div class="col-sm-10">
                            <select name="users_status" id="users_status" class="form-control">
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
        var nama = $(this).data('nama');
        var level = $(this).data('level');
        var email = $(this).data('email');
        var active = $(this).data('active');
        var id_users = $(this).data('id');

        $('#name_edit').val(nama);
        $('#email_edit').val(email);

        $('#level_edit option').each(function() {
            if($(this).val() == level) {
                $(this).prop('selected', true);
            }
        });
        $('#users_status option').each(function() {
            if($(this).val() == active) {
                $(this).prop('selected', true);
            }
        });

        $('#form-edit').attr('action', '/admin/users/update/' + id_users);
    });
</script>
@endpush

@endsection
