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
                        <a href="{{ route('admin.alat') }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('admin.alat.update', $data->id) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Alat Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Enter alat name" value="{{ old('name', $data->name) }}" />
                            @error('name')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $data->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tipe</label>
                            <select name="tipe_id" class="form-select @error('tipe_id') is-invalid @enderror">
                                <option value="">Select Tipe</option>
                                @foreach ($tipes as $tipe)
                                    <option value="{{ $tipe->id }}" {{ old('tipe_id', $data->tipe_id) == $tipe->id ? 'selected' : '' }}>
                                        {{ $tipe->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipe_id')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Serial Number</label>
                            <input type="text" name="no_seri" class="form-control @error('no_seri') is-invalid @enderror" 
                                   placeholder="Enter serial number" value="{{ old('no_seri', $data->no_seri) }}" />
                            @error('no_seri')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Tera</label>
                            <input type="date" name="tanggal_tera" class="form-control @error('tanggal_tera') is-invalid @enderror" 
                                   value="{{ old('tanggal_tera', $data->tanggal_tera) }}" />
                            @error('tanggal_tera')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Masa Berlaku Start</label>
                            <input type="date" name="masa_berlaku_start" class="form-control @error('masa_berlaku_start') is-invalid @enderror" 
                                   value="{{ old('masa_berlaku_start', $data->masa_berlaku_start) }}" />
                            @error('masa_berlaku_start')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Masa Berlaku End</label>
                            <input type="date" name="masa_berlaku_end" class="form-control @error('masa_berlaku_end') is-invalid @enderror" 
                                   value="{{ old('masa_berlaku_end', $data->masa_berlaku_end) }}" />
                            @error('masa_berlaku_end')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" 
                                      placeholder="Enter any additional information">{{ old('keterangan', $data->keterangan) }}</textarea>
                            @error('keterangan')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <div class="card-body border-top d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <div class="d-flex align-items-center">
                            <i class="ti ti-device-floppy me-1 fs-4"></i> Update
                        </div>
                    </button>
                    <a href="{{ route('admin.alat') }}" class="btn btn-danger rounded-pill px-4 text-white">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
