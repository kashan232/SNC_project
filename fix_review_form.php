<?php
$f = 'resources/views/frontend/pages/product_detail.blade.php';
$c = file_get_contents($f);

$old = '<div class="tab-pane fade" id="reviewTab">
								<div class="comments-section">';

$new = '<div class="tab-pane fade" id="reviewTab">
								<div class="comments-section">
                                    
                                    @auth
                                    <div class="review-form mb-4 p-4 bg-light rounded-16 border">
                                        <h5 class="mb-3 font-weight-bold">Write a Review</h5>
                                        <form class="form" method="post" action="{{route(\'review.store\',$product_detail->slug)}}">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">Rating</label>
                                                <div class="rating-stars-input" style="color: var(--primary-color); font-size: 20px; cursor: pointer;">
                                                    <i class="fa fa-star star-rate" data-val="1"></i>
                                                    <i class="fa fa-star star-rate" data-val="2"></i>
                                                    <i class="fa fa-star star-rate" data-val="3"></i>
                                                    <i class="fa fa-star star-rate" data-val="4"></i>
                                                    <i class="fa fa-star star-rate" data-val="5"></i>
                                                </div>
                                                <input type="hidden" name="rate" id="rating-val" value="5" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Your Review</label>
                                                <textarea name="review" rows="3" class="form-control" placeholder="Write your review here..." required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3" style="background: var(--primary-color); border: none;">Submit Review</button>
                                        </form>
                                    </div>
                                    @else
                                    <div class="alert alert-info text-center">
                                        You need to <a href="{{route(\'login.form\')}}" style="color: var(--primary-color); font-weight: bold;">Login</a> to write a review.
                                    </div>
                                    @endauth
                                    
                                    <h5 class="mb-3 font-weight-bold">Customer Reviews</h5>';

$c = str_replace($old, $new, $c);

// Also add a little script to handle the stars input
$script = "
<script>
    $(document).ready(function(){
        $('.star-rate').click(function(){
            var val = $(this).data('val');
            $('#rating-val').val(val);
            $('.star-rate').each(function(){
                if($(this).data('val') <= val){
                    $(this).removeClass('fa-star-o').addClass('fa-star');
                } else {
                    $(this).removeClass('fa-star').addClass('fa-star-o');
                }
            });
        });
    });
</script>
";

$c = str_replace('@endpush', $script . "\n" . '@endpush', $c);

file_put_contents($f, $c);
echo "Review form added.";
?>
