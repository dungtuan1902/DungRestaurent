<section id="gallery" class="gallery">
    <div class="container-fluid">

        <div class="section-title">
            <h2>Some photos from <span>Our Restaurant</span></h2>
            <p>For us to be able to achieve joy and pleasure in life in any way, it is best that we can do it at any
                given time.</p>
        </div>

        <div class="row g-0">
            @foreach ($gallery as $key => $image)
                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ Storage::url('image_room/' . $image) }}" class="gallery-lightbox">
                            <img src="{{ Storage::url('image_room/' . $image) }}" style="height: 300px; width: 500px"
                                alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section><!-- End Gallery Section -->
