@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-6">
        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-primary border-primary card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Jumlah Tamu</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-success pr-2">
                                    <i class="fa pe-7s-smile"></i>
                                </span>
                                {{count($data)}}
                                <small class="opacity-5 pl-1">Orang</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-danger border-danger card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Jumlah Kehadiran Tamu</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-info pr-2">
                                    <i class="fa pe-7s-smile"></i>
                                </span>
                                {{$hadir}}
                                <small class="opacity-5 pl-1">Orang</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-7 col-lg-8">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    Daftar Tamu
                </div>
            </div>
            <div class="pt-0 card-body">
                <br>
                <div>
                    <table class="mb-0 table table-hover" id="tabel_list">
                        <thead>
                            <tr>
                                <th>#</th>
                                {{-- <th>Kode</th> --}}
                                <th>Nama</th>
                                <th class="text-center">Action</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($data as $data)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    {{-- <td>{{ $data->kode_guest }}</td> --}}
                                    <td>{{ $data->nama }}</td>
                                    <form action="{{route('guestAtt')}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="uid" value="{{$data->kode_guest}}">
                                        <td class="text-center">
                                            <button type="submit" class="btn-wide mb-2 mr-2 btn btn-success">
                                                Hadir
                                            </button>
                                        </td>
                                    </form>
                                    <td class="text-center">{!! $data->status === 1 ? '<div
                                            class="mb-2 mr-2 badge badge-pill badge-success">Tamu Hadir</div>' : '<div
                                            class="mb-2 mr-2 badge badge-pill badge-danger">Tamu Belum Hadir</div>' !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-5 col-lg-4">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Scan Barcode</h5>
                <div>
                    <form action="{{route('guestAcc')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Scan</span>
                            </div>
                            <input name="uid" id="uid" placeholder="..." type="password" class="form-control" autofocus>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
