@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #sync1 .btn-nav-dark {
            width: 20px;
            height: 20px;
            padding: 2px;
            background-color: rgba(0, 0, 0, .6);
            color: #fff;
            font-size: 12px;
        }

        #sync1 .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
        }

        table tr td {
            padding: 5px;
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

    <div class="kegiatan-detail">
        <div class="card shadow-none border">
            <div class="card-body p-4">
                <a href="{{ route('admin.' . $active) }}" class="btn btn-sm btn-dark mb-3">
                    <i class="ti ti-arrow-left"></i> Back to {{ $title ?? '' }}
                </a>

                <div class="row g-4">
                    <div class="col-lg-5">
                        <div id="sync1" class="owl-carousel owl-theme">
                            @if (is_array($data->foto_kegiatan) && count($data->foto_kegiatan) > 0)
                                @foreach ($data->foto_kegiatan as $image)
                                    <div class="item rounded overflow-hidden">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Kegiatan Image" class="img-fluid">
                                    </div>
                                @endforeach
                            @else
                                <div class="item rounded overflow-hidden">
                                    <p>No images available for this Kegiatan.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="kegiatan-content">
                            <h4 class="fw-semibold">{{ $data->nama_kegiatan ?? '' }}</h4>
                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->format('d M Y') }}</p>
                            <p><strong>Location:</strong> {{ $data->lokasi_kegiatan ?? '' }}</p>

                            <div class="mt-3">
                                <a href="{{ route('admin.' . $active . '.edit', $data->id) }}" class="btn btn-warning">
                                    <i class="ti ti-pencil"></i> Edit Kegiatan
                                </a>
                                <form action="{{ route('admin.' . $active . '.delete', $data->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="ti ti-trash"></i> Delete Kegiatan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            var sync1 = $("#sync1");

            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [
                    '<span class="position-absolute top-50 start-0 ms-2 translate-middle-y btn-nav-dark rounded-circle"><i class="ti ti-chevron-left"></i></span>',
                    '<span class="position-absolute top-50 end-0 me-2 translate-middle-y btn-nav-dark rounded-circle"><i class="ti ti-chevron-right"></i></span>'
                ],
            });
        })
    </script>
@endpush
