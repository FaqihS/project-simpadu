@extends('layouts.app')

@section('title', 'Edit anggota')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit anggota</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">anggotas</a></div>
                    <div class="breadcrumb-item">Edit anggota</div>
                </div>
            </div>

            <div class="section-body">

                <div class="card">
                    <form action="{{ route('anggota.update', $anggota) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit anggota</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text"
                                    class="form-control @error('nama')
                                    is-invalid
                                @enderror"
                                name="nama"
                                value={{$anggota->nama}}>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                    class="form-control @error('email')
                                    is-invalid
                                @enderror"
                                name="email"
                                value={{$anggota->email}}>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Usia</label>
                                <input type="number"
                                    class="form-control @error('usia')
                                    is-invalid
                                @enderror"
                                    name="usia"
                                    value={{$anggota->usia}}>
                                @error('usia')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" value={{$anggota->tgl_lahir}}>
                            </div>

                            <div class="form-group mb-0">
                                <label>Alamat</label>
                            <textarea class="form-control" data-height="150" name="alamat" value=>
                                 {{$anggota->alamat}}
                            </textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="gender" value="1" class="selectgroup-input"
                                        {{$anggota->gender ? 'checked' : ''}}>
                                        <span class="selectgroup-button">Laki - Laki</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="gender" value="0" class="selectgroup-input" {{$anggota->gender ? '' : 'checked'}}>
                                        <span class="selectgroup-button">Perempuan</span>
                                    </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="selectgroup w-100">
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option class="selectgroup-item" value="lajang" {{ $anggota->status == 'lajang' ? 'selected' :''}}>
                                        Lajang
                                    </option>

                                    <option class="selectgroup-item" value="menikah" {{ $anggota->status == 'menikah' ? 'selected' : ''}}>
                                        Menikah
                                    </option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hobi</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="hobi[]" value="Berenang" class="selectgroup-input"
                                        {{ str_contains($anggota->hobi,'Berenang') ? 'checked' : ''}}>
                                        <span class="selectgroup-button">Berenang</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="hobi[]" value="Sepak Bola" class="selectgroup-input"
                                        {{ str_contains($anggota->hobi,'Sepak Bola') ? 'checked' : ''}}>
                                        <span class="selectgroup-button">Sepak Bola</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="hobi[]" value="Bulu Tangkis" class="selectgroup-input"
                                        {{ str_contains($anggota->hobi,'Bulu Tangkis') ? 'checked' : ''}}>
                                        <span class="selectgroup-button">Bulu Tangkis</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="hobi[]" value="Ngoding" class="selectgroup-input"
                                        {{ str_contains($anggota->hobi,'Ngoding') ? 'checked' : ''}}>
                                        <span class="selectgroup-button">Ngoding</span>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
