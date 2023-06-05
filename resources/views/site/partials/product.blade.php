@include('site.partials.header')

@foreach ($products as $product)
    <div>
        <h2>{{ $product->title }}</h2>
        <img src="{{ $product->image_link }}">
        <p>{{ $product->description }}</p>

        <div>
            @foreach ($product->gallery as $image)
                <img src="{{ $image->image_path }}">
            @endforeach
        </div>
    </div>
@endforeach
