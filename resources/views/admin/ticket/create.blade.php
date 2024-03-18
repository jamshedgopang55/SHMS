<div class="row gx-2 gy-2" id="product-gallery">
    @foreach ($Attachments as $attachment)
        {{ dd($attachment->images) }} <!-- Debug output -->
        @foreach ($attachment->images as $img)
            <!-- Your code to display images -->
        @endforeach
    @endforeach
</div>
