else if (response.ext == 'zip') {
                    let html = `
                        <div class="col-lg-3 col-md-4 col-sm-6  " id="image-row-${response.image_id}">
                            <div class="dropzoneimg p-2" >
                                <img src="data:image/png;base64,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"  class="card-img-top product_image" alt="...">
                                <input readonly type="text" hidden name="images_array[]" value="${response.image_id}">
                                <div class="card-body">
                                    <a onclick="deleteImae(${response.image_id})" class="img-delte-btn">Delete</a>
                                </div>
                            </div>
                        </div>
                        `;;
                    $('#product-gallery').append(html)
                } else if (response.ext == 'docx') {
                    let html = `
        <div class="col-lg-3 col-md-4 col-sm-6" id="image-row-${response.image_id}">
            <div class="dropzoneimg p-2">
                <a href="${response.image_path}" download>Download Word File</a>
                <input readonly type="text" hidden name="images_array[]" value="${response.image_id}">
                <div class="card-body">
                    <a onclick="deleteImae(${response.image_id})" class="img-delte-btn">Delete</a>
                </div>
            </div>
        </div>
    `;
$('#product-gallery').append(html);