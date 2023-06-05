<form action="{{ route('reviews.store') }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <textarea name="content" placeholder="Write your review..." required></textarea>
    <input type="number" name="rating" min="1" max="5" required>
    <button type="submit">Submit Review</button>
</form>

