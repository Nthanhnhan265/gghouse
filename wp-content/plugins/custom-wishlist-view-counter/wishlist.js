jQuery(document).ready(function ($) {
  $(".wishlist-btn").on("click", function () {
    var $btn = $(this);
    var productId = $btn.data("product-id");

    $.ajax({
      url: wishlistAjax.ajax_url,
      type: "POST",
      data: {
        action: "add_to_wishlist",
        product_id: productId,
        nonce: wishlistAjax.nonce,
      },
      success: function (response) {
        if (response.success) {
          $btn.addClass("added");
          $btn.attr("title", "Đã thêm vào danh sách yêu thích");

          // Hiệu ứng nhấp nháy
          $btn.addClass("pulse");
          setTimeout(function () {
            $btn.removeClass("pulse");
          }, 1000);
        } else {
          alert(response.data);
        }
      },
    });
  });
});
