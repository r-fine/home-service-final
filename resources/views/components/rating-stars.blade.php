@props(['review' => $review])

@if ($review->rating == 5)
<span class="text-warning">
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
</span>
@elseif ($review->rating == 4)
<span class="text-warning">
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
</span>
@elseif ($review->rating == 3)
<span class="text-warning">
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
</span>
@elseif ($review->rating == 2)
<span class="text-warning">
    <i class="bi bi-star-fill"></i>
    <i class="bi bi-star-fill"></i>
</span>
@elseif ($review->rating == 1)
<span class="text-warning">
    <i class="bi bi-star-fill"></i>
</span>
@endif
