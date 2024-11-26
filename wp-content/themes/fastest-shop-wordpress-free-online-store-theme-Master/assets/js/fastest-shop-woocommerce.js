/*
 * woocommerce
 **/

;(function ($) {
  'use strict'
  // Dom Ready
  $(function () {
    if ($('.woocommerce-ordering .orderby').length) {
      $('.woocommerce-ordering .orderby').customSelect()
    }

    if ($('.related.products h2,.upsells.products h2,.cross-sells h2').length) {
      $('.related.products h2,.upsells.products h2,.cross-sells h2').each(
        function (index) {
          var text = $(this).html()
          $(this).html('<span>' + text + '</span>')
        },
      )
    }
    // When variable price is selected by default
    setTimeout(function () {
      if (
        0 < $('input.variation_id').val() &&
        null != $('input.variation_id').val()
      ) {
        if ($('.status-product').length) {
          $('.shopstore_variable_product_status')
            .find('.status-product')
            .remove()
        }

        $('.shopstore_variable_price').html(
          $('div.woocommerce-variation-price > span.price').html(),
        )
        $('.shopstore_variable_price')
          .next()
          .append($('div.woocommerce-variation-availability').html())
      }
    }, 300)

    // On live variation selection
    $('.variations select').blur(function () {
      if (
        0 < $('input.variation_id').val() &&
        null != $('input.variation_id').val()
      ) {
        if ($('.status-product') || $('.status-product p.stock')) {
          $('.shopstore_variable_product_status')
            .find('.status-product')
            .remove()
        }

        $('.shopstore_variable_price').html(
          $('div.woocommerce-variation-price > span.price').html(),
        )
        $('.shopstore_variable_price')
          .next()
          .append($('div.woocommerce-variation-availability').html())
      } else {
        $('.shopstore_variable_price').html(
          $('div.hidden-variable-price').html(),
        )
        if ($('.status-product').length) {
          $('.shopstore_variable_product_status')
            .find('.status-product')
            .remove()
        }
      }
    })

    /* ============== Quantity buttons ============== */

    // Target quantity inputs on product pages
    $('input.qty:not(.product-quantity input.qty)').each(function () {
      var min = parseFloat($(this).attr('min'))

      if (min && min > 0 && parseFloat($(this).val()) < min) {
        $(this).val(min)
      }
    })

    $(document).on('click', '.plus, .minus', function () {
      // Get values
      var $qty = $(this).closest('.quantity').find('.qty'),
        currentVal = parseFloat($qty.val()),
        max = parseFloat($qty.attr('max')),
        min = parseFloat($qty.attr('min')),
        step = $qty.attr('step')

      // Format values
      if (!currentVal || currentVal === '' || currentVal === 'NaN')
        currentVal = 0
      if (max === '' || max === 'NaN') max = ''
      if (min === '' || min === 'NaN') min = 0
      if (
        step === 'any' ||
        step === '' ||
        step === undefined ||
        parseFloat(step) === 'NaN'
      )
        step = 1

      // Change the value
      if ($(this).is('.plus')) {
        if (max && (max == currentVal || currentVal > max)) {
          $qty.val(max)
        } else {
          $qty.val(currentVal + parseFloat(step))
        }
      } else {
        if (min && (min == currentVal || currentVal < min)) {
          $qty.val(min)
        } else if (currentVal > 0) {
          $qty.val(currentVal - parseFloat(step))
        }
      }

      // Trigger change event
      $qty.trigger('change')
    })

    $(document).on(
      'click',
      '.fastest_shop_variations_wrap .swatch',
      function () {
        var price_element = $(this).parents('li.product').find('.price'),
          product_attr = jQuery.parseJSON(
            $(this)
              .parents('.fastest_shop_variations_wrap')
              .attr('data-product_variations'),
          ),
          variation_id = $(this).data('variations_id')

        jQuery.each(product_attr, function (index, loop_value) {
          if (
            variation_id == loop_value.variation_id &&
            typeof loop_value.price_html != 'undefined'
          ) {
            $(price_element).html(
              loop_value.price_html + loop_value.availability_html,
            )
          }
        })
      },
    )
  })
})(jQuery)
document.addEventListener('DOMContentLoaded', function () {
  // Hàm lấy danh sách sản phẩm yêu thích từ localStorage
  function getWishlist() {
    return JSON.parse(localStorage.getItem('wishlist') || '[]')
  }

  // Hàm lưu danh sách sản phẩm yêu thích vào localStorage
  function saveWishlist(wishlist) {
    localStorage.setItem('wishlist', JSON.stringify(wishlist))
  }

  // Hàm kiểm tra sản phẩm có trong wishlist không
  function isInWishlist(productId) {
    const wishlist = getWishlist()
    return wishlist.some((item) => item.id === productId)
  }

  // Hàm thêm/xóa sản phẩm khỏi wishlist
  function toggleWishlist(productId, productName) {
    let wishlist = getWishlist()
    const index = wishlist.findIndex((item) => item.id === productId)

    if (index !== -1) {
      // Xóa sản phẩm khỏi wishlist
      wishlist.splice(index, 1)
    } else {
      // Thêm sản phẩm vào wishlist
      wishlist.push({
        id: productId,
        name: productName,
        addedAt: new Date().toISOString(),
      })
    }

    saveWishlist(wishlist)
    updateWishlistUI()
  }

  // Cập nhật giao diện wishlist
  function updateWishlistUI() {
    const wishlist = getWishlist()
    const wishlistButtons = document.querySelectorAll('.add-to-wishlist')

    wishlistButtons.forEach((button) => {
      const productId = button.getAttribute('data-product-id')
      const wishlistIcon = button.querySelector('.wishlist-icon')

      if (isInWishlist(productId)) {
        wishlistIcon.classList.add('active')
        wishlistIcon.style.color = 'red'
      } else {
        wishlistIcon.classList.remove('active')
        wishlistIcon.style.color = ''
      }
    })

    // Cập nhật số lượng sản phẩm trong wishlist (nếu có)
    const wishlistCountElement = document.querySelector('.wishlist-count')
    if (wishlistCountElement) {
      wishlistCountElement.textContent = wishlist.length
    }
  }

  // Bắt sự kiện click vào nút yêu thích
  document.addEventListener('click', function (e) {
    const wishlistButton = e.target.closest('.add-to-wishlist')
    if (wishlistButton) {
      e.preventDefault()
      const productId = wishlistButton.getAttribute('data-product-id')
      const productName = wishlistButton.getAttribute('data-product-name')
      toggleWishlist(productId, productName)
    }
  })

  // Tạo trang Wishlist
  function createWishlistPage() {
    const wishlist = getWishlist()
    const wishlistContainer = document.getElementById('wishlist-container')

    if (wishlistContainer) {
      wishlistContainer.innerHTML = '' // Xóa nội dung cũ

      if (wishlist.length === 0) {
        wishlistContainer.innerHTML =
          '<p>Danh sách yêu thích của bạn đang trống.</p>'
        return
      }

      const table = document.createElement('table')
      table.classList.add('wishlist-table')
      table.innerHTML = `
<thead>
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Ngày Thêm</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody></tbody>
            `

      wishlist.forEach((item) => {
        const row = document.createElement('tr')
        row.innerHTML = `
                    <td>
                        <a href="/product/${item.id}">${item.name}</a>
                    </td>
                    <td>${new Date(item.addedAt).toLocaleDateString()}</td>
                    <td>
                        <button class="remove-from-wishlist" data-product-id="${
                          item.id
                        }">Xóa</button>
                    </td>
                `
        table.querySelector('tbody').appendChild(row)
      })

      wishlistContainer.appendChild(table)

      // Xử lý xóa sản phẩm khỏi wishlist
      wishlistContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-from-wishlist')) {
          const productId = e.target.getAttribute('data-product-id')
          toggleWishlist(productId)
          createWishlistPage() // Làm mới trang
        }
      })
    }
  }

  // Chạy các hàm khởi tạo
  updateWishlistUI()

  // Nếu đang ở trang wishlist
  if (document.getElementById('wishlist-container')) {
    createWishlistPage()
  }
})
