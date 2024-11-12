@extends('admin.layouts.app')

@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <h4 class="fw-semibold mb-8">{{ $title ?? '' }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.' . $active) }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('admin.' . $active . '.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <!-- Nama Kegiatan -->
                        <div class="mb-3">
                            <label class="control-label mb-1">Nama Kegiatan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kegiatan"
                                class="form-control @error('nama_kegiatan') is-invalid @enderror" placeholder="Enter Event Name"
                                value="{{ old('nama_kegiatan') }}" />
                            @error('nama_kegiatan')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Tanggal Kegiatan -->
                        <div class="mb-3">
                            <label class="control-label mb-1">Tanggal Kegiatan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_kegiatan"
                                class="form-control @error('tanggal_kegiatan') is-invalid @enderror"
                                value="{{ old('tanggal_kegiatan') }}" />
                            @error('tanggal_kegiatan')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Lokasi Kegiatan -->
                        <div class="mb-3">
                            <label class="control-label mb-1">Lokasi Kegiatan <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi_kegiatan"
                                class="form-control @error('lokasi_kegiatan') is-invalid @enderror"
                                placeholder="Enter Event Location" value="{{ old('lokasi_kegiatan') }}" />
                            @error('lokasi_kegiatan')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Foto Kegiatan -->
                        <div class="mb-3">
                            <label class="control-label mb-1">Foto Kegiatan (Optional, multiple)</label>
                            <input type="file" name="foto_kegiatan[]" class="form-control @error('foto_kegiatan.*') is-invalid @enderror" multiple />
                            @error('foto_kegiatan.*')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <div class="d-flex align-items-center">
                            <i class="ti ti-device-floppy me-1 fs-4"></i>
                            Save
                        </div>
                    </button>
                    <button type="reset" class="btn btn-danger rounded-pill px-4 ms-2 text-white">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
