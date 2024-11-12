@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .owl-carousel .card {
            transition: transform 0.3s ease;
        }

        .owl-carousel .card:hover {
            transform: scale(1.05);
        }

        .counter-carousel .card {
            padding: 20px;
        }

        .recent-entries {
            margin-top: 40px;
        }

        .recent-entry-title {
            font-weight: bold;
            color: #555;
        }

        .entry-date {
            color: #999;
        }

        .entry-image {
            max-width: 80px;
            max-height: 80px;
            border-radius: 8px;
            margin-right: 15px;
        }
    </style>
@endpush

@section('content')
    <!-- Counter Carousel Section -->
    <div class="owl-carousel counter-carousel owl-theme mb-5">
        <!-- Card for Kegiatan -->
        <div class="item">
            <div class="card border-0 shadow-lg bg-light-success text-center">
                <div class="card-body">
                    <i class="ti ti-calendar fs-1 mb-3 text-success"></i>
                    <p class="fw-semibold fs-3 text-success mb-1">Kegiatan</p>
                    <h5 class="fw-bold text-success mb-0">{{ $count_kegiatan ?? 0 }}</h5>
                </div>
            </div>
        </div>

        <!-- Card for Harga -->
        <div class="item">
            <div class="card border-0 shadow-lg bg-light-danger text-center">
                <div class="card-body">
                    <i class="ti ti-cash fs-1 mb-3 text-danger"></i>
                    <p class="fw-semibold fs-3 text-danger mb-1">Harga</p>
                    <h5 class="fw-bold text-danger mb-0">{{ $count_harga ?? 0 }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Entries Section -->
    <div class="recent-entries">
        <!-- Latest Kegiatan with Images -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title text-primary">Latest Kegiatan</h5>
                <ul class="list-unstyled">
                    @foreach ($latest_kegiatan as $kegiatan)
                        <li class="d-flex align-items-center mb-3">
                            <!-- Display the first image from kegiatan if available -->
                            @if(is_array($kegiatan->foto_kegiatan) && count($kegiatan->foto_kegiatan) > 0)
                                <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan[0]) }}" alt="Kegiatan Image" class="entry-image">
                            @else
                                <img src="{{ asset('images/default-placeholder.png') }}" alt="No Image" class="entry-image">
                            @endif
                            <div>
                                <span class="recent-entry-title">{{ $kegiatan->nama_kegiatan }}</span>
                                <div class="entry-date">{{ $kegiatan->created_at->format('d M Y') }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Latest Harga -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title text-warning">Latest Harga</h5>
                <ul class="list-unstyled">
                    @foreach ($latest_harga as $harga)
                        <li>
                            <span class="recent-entry-title">{{ $harga->nama }}</span>
                            <span class="entry-date">- {{ $harga->created_at->format('d M Y') }}</span>
                        </li>
                    @endforeach
                </ul>
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
            $(".counter-carousel").owlCarousel({
                loop: true,
                margin: 30,
                mouseDrag: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplaySpeed: 1500,
                nav: false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    576: {
                        items: 2,
                    },
                    768: {
                        items: 2,
                    },
                    1200: {
                        items: 2,
                    }
                },
            });
        });
    </script>
@endpush
