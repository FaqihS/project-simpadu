@extends('layouts.app')

@section('title', 'Anggota')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>All Anggotas</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Anggota</a></div>
                    <div class="breadcrumb-item">All Anggota</div>
                </div>
            </div>
            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Anggota</h4>
                                <div class="section-header-button">
                                    <a href="{{ route('anggota.create') }}" class="btn btn-primary">New Anggota</a>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET", action="{{ route('anggota.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Usia</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status</th>
                                            <th>Hobi</th>
                                        </tr>
                                        @foreach ($anggotas as $anggota)
                                            <tr>
                                                <td>
                                                    {{ $anggota->nama }}
                                                </td>
                                                <td>
                                                    {{ $anggota->email }}
                                                </td>
                                                <td>
                                                    {{ $anggota->usia }}
                                                </td>
                                                <td>
                                                    {{ $anggota->tgl_lahir }}
                                                </td>
                                                <td>
                                                    {{ $anggota->alamat }}
                                                </td>
                                                <td>
                                                    {{ $anggota->gender ? 'Laki-Laki' : 'Perempuan' }}
                                                </td>
                                                <td>
                                                    {{ $anggota->status }}
                                                </td>
                                                <td>
                                                    {{ $anggota->hobi }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('anggota.edit', $anggota->id) }}'
                                                            class="btn btn-sm btn-info btn-icon" style="display: inline-flex; justify-content: space-around ; align-items: center; column-gap: 0.4rem;">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                                            class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete" style="display: inline-flex; justify-content: space-around ; align-items: center; column-gap: 0.4rem;">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $anggotas->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
