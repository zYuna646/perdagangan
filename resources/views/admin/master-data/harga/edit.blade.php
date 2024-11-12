@extends('admin.layouts.app')

@push('styles')
    <style>
        .btn-modal-close {
            width: 30px;
            height: 30px;
            font-size: 12px;
            color: #fff;
            background-color: rgba(255, 255, 255, .3);
            border: none;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
        }
    </style>
@endpush

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

    {{-- Success Notification --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert" id="success-alert">
            <div class="d-flex gap-2 align-items-center">
                <div>
                    <span class="d-inline-flex p-1 rounded-circle border border-2 border-white mb-0">
                        <i class="fs-5 ti ti-check"></i> 
                    </span>
                </div> 
                <div>
                    {{ $message ?? '' }}
                </div>
            </div>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('admin.' . $active . '.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <!-- Nama (Product Name) -->
                        <div class="mb-3">
                            <label class="control-label mb-1">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Enter Product Name" value="{{ old('nama', $data->nama ?? '') }}" />
                            @error('nama')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- File Harga Upload -->
                        <div class="mb-3">
                            <label class="control-label mb-1">File Harga <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="file" name="file_harga"
                                    class="form-control @error('file_harga') is-invalid @enderror" />
                                <input type="hidden" name="current_file_harga" value="{{ $data->file_harga ?? '' }}">
                                @if ($data->file_harga)
                                    <a href="{{ asset('uploads/hargas/' . $data->file_harga) }}" class="btn btn-info font-medium text-light" download>
                                        <div class="d-flex align-items-center">
                                            <i class="ti ti-download me-1 fs-4"></i>
                                            Download Current File
                                        </div>
                                    </a>
                                @endif
                            </div>
                            @error('file_harga')
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
                            Update
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
