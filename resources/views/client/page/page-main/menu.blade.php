<section id="menu" class="menu">
    <div class="container">

        <div class="section-title">
            <h2>Check our tasty <span>Menu</span></h2>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="menu-flters">
                    <li data-filter="*" class="filter-active">Show All</li>
                    {{-- @foreach ($food['food'] as $item) --}}
                    @foreach ($food['food_type'] as $ftype)
                        {{-- @if ($ftype->id == $item->food_type_id) --}}
                        <li data-filter=".filter-{{ $ftype->id }}">{{ $ftype->name }}</li>
                        {{-- @endif --}}
                    @endforeach
                    {{-- @endforeach --}}
                    {{-- <li data-filter=".filter-starters">Starters</li>
                    <li data-filter=".filter-salads">Salads</li>
                    <li data-filter=".filter-specialty">Specialty</li> --}}
                </ul>
            </div>
        </div>

        <div class="row menu-container">
            @foreach ($food['food_type'] as $ftype)
                <div class="col-lg-6 menu-item filter-{{ $ftype->id }}">
                    @foreach ($food['food'] as $f)
                        @if ($ftype->id == $f->food_type_id)
                            <div class="menu-content">
                                <a href="#">{{ $f->name }}</a><span>{{ number_format($f->price , 0, '', ',') }}
                                    VND </span>
                            </div>
                            <div class="menu-ingredients">
                                {{ $f->ingredient }}
                            </div>
                        @endif
                    @endforeach

                </div>
            @endforeach
        </div>

    </div>
</section><!-- End Menu Section -->
