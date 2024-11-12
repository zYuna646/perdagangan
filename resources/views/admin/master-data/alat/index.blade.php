@extends('admin.layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.alat') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="category_id" class="form-label">Filter by Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="tipe_id" class="form-label">Filter by Tipe</label>
                    <select name="tipe_id" id="tipe_id" class="form-select">
                        <option value="">All Tipes</option>
                        @foreach ($tipes as $tipe)
                            <option value="{{ $tipe->id }}" 
                                {{ request('tipe_id') == $tipe->id ? 'selected' : '' }}>
                                {{ $tipe->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-md-3">
                    <label for="search" class="form-label">Search by Name</label>
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="Search Alat..." value="{{ request('search') }}">
                </div>
                
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1 d-flex align-items-center justify-content-center">
                        <i class="ti ti-filter fs-5 me-1"></i> Apply Filter
                    </button>
                    <a href="{{ route('admin.alat') }}" class="btn btn-secondary flex-grow-1 d-flex align-items-center justify-content-center">
                        <i class="ti ti-reload fs-5 me-1"></i> Reset
                    </a>
                    <a href="{{ route('admin.alat.create') }}" class="btn btn-success flex-grow-1 d-flex align-items-center justify-content-center">
                        <i class="ti ti-plus fs-5 me-1"></i> Add {{ $title ?? 'Alat' }}
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    
    

    {{-- Notification --}}
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

    @if (count($datas) > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table_config" class="table align-middle text-nowrap">
                    <thead class="header-item">
                        <tr>
                            <th>No</th>
                            <th>Alat Name</th>
                            <th>Category</th>
                            <th>Tipe</th>
                            <th>Serial Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $result)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result->name }}</td>
                                <td>{{ $result->category->name ?? '-' }}</td>
                                <td>{{ $result->tipe->name ?? '-' }}</td>
                                <td>{{ $result->no_seri }}</td>
                                <td>
                                    <a href="{{ route('admin.alat.edit', $result->id) }}" class="btn btn-sm btn-warning">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.alat.delete', $result->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <div class="alert alert-warning mb-0" role="alert">
                <div class="d-flex gap-2 align-items-center">
                    <span class="rounded-circle px-1 py-0 border border-2 border-warning text-light bg-warning mb-0 d-block" style="font-size: 16px;">
                        <i class="ti ti-alert-circle"></i>
                    </span>
                    <p class="mb-0">
                        No alat data yet. <a href="{{ route('admin.alat.create') }}">Add</a> now.
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>

    <script>
        dTable = $("#table_config").DataTable({
            "dom": "lrtip"
        });

        $("#search-box").keyup(function() {
            dTable.search($(this).val()).draw();
        }); 
    </script>
@endpush
