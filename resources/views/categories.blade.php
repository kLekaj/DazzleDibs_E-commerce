@foreach ($products as $product)
    <div class="product">
        <h2>{{ $product->title }}</h2>
        <img src="{{ $product->image_link }}">
        <p>{{ $product->description }}</p>

        <div class="gallery">
            @foreach ($product->gallery as $image)
                <img src="{{ $image->image_path }}">
            @endforeach
        </div>
    </div>
@endforeach
