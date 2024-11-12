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

        .forPraImg {
            overflow-x: auto !important;
            overflow-y: hidden;
            width: 100%;
        }

        .forPraImg::-webkit-scrollbar {
            height: 6px;
        }

        .forPraImg::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .forPraImg::-webkit-scrollbar-thumb {
            background: #888;
        }

        .forPraImg::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .my-content-img {
            position: relative;
        }

        .my-content-img:before {
            content:"";
            position:absolute;
            width:100%;
            height:100%;
            top:0;left:0;right:0;
            background-color:rgba(0,0,0,0);
            transition: .3s ease-in-out;
        }

        .my-content-img:hover::before {
            background-color:rgba(0,0,0,0.5);
        }

        .my-content-img .my-btn-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity:0;
            transition: .3s ease-in-out;
        }

        .my-content-img:hover .my-btn-img {   
            opacity: 1;
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
                        <!-- Nama Kegiatan -->
                        <div class="mb-3">
                            <label class="control-label mb-1">Nama Kegiatan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kegiatan" class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                placeholder="Enter Event Name" value="{{ old('nama_kegiatan', $data->nama_kegiatan ?? '') }}" />
                            @error('nama_kegiatan')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Tanggal Kegiatan -->
                        <div class="mb-3">
                            <label class="control-label mb-1">Tanggal Kegiatan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_kegiatan" class="form-control @error('tanggal_kegiatan') is-invalid @enderror"
                                value="{{ old('tanggal_kegiatan', $data->tanggal_kegiatan) }}" />
                            @error('tanggal_kegiatan')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Lokasi Kegiatan -->
                        <div class="mb-3">
                            <label class="control-label mb-1">Lokasi Kegiatan <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi_kegiatan" class="form-control @error('lokasi_kegiatan') is-invalid @enderror"
                                placeholder="Enter Event Location" value="{{ old('lokasi_kegiatan', $data->lokasi_kegiatan) }}" />
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

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="mb-3">Current Images</h5>
            @if (is_array($data->foto_kegiatan) && count($data->foto_kegiatan) > 0)
                <div class="forPraImg d-flex flex-row gap-2">
                    @foreach ($data->foto_kegiatan as $image)
                        <div class="my-content-img">
                            <img src="{{ asset('storage/' . $image) }}" alt="Event Image" class="img-fluid rounded" height="100" width="100">
                            <form action="{{ route('admin.' . $active . '.delete-image', ['id' => $data->id, 'image' => $image]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this image?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger rounded-pill my-btn-img position-absolute">
                                    <i class="ti ti-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning mb-0" role="alert">
                    <div class="d-flex gap-2 align-items-center">
                        <span class="rounded-circle px-1 py-0 border border-2 border-warning text-light bg-warning mb-0 d-block" style="font-size: 16px;">
                            <i class="ti ti-alert-circle"></i>
                        </span>
                        <p class="mb-0">
                            No images available. <a href="{{ route('admin.' . $active . '.edit', $data->id) }}">Add</a> images now.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
