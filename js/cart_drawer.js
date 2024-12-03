
document.addEventListener("DOMContentLoaded", function () {
  const minusButtons = document.querySelectorAll(".quantity-button.minus");
  const plusButtons = document.querySelectorAll(".quantity-button.plus");

  // Function to decrease quantity
  minusButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const quantityInput = button.nextElementSibling;
      let currentValue = parseInt(quantityInput.value);

      if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        updateCartQuantity(
          button.closest(".cart-item").getAttribute("data-product-id"),
          quantityInput.value
        );
      }
    });
  });

  // Function to increase quantity
  plusButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const quantityInput = button.previousElementSibling;
      let currentValue = parseInt(quantityInput.value);

      quantityInput.value = currentValue + 1;
      updateCartQuantity(
        button.closest(".cart-item").getAttribute("data-product-id"),
        quantityInput.value
      );
    });
  });

  // Function to update cart quantity in the backend
  function updateCartQuantity(productId, newQuantity) {
    fetch("../actions/update_cart_action.php", {
      // Use update_cart_action.php
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        product_id: productId,
        quantity: newQuantity,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (!data.success) {
          console.error("Error updating quantity:", data.message);
        } else {
          // Optionally update subtotal and other elements
          location.reload(); // Reload page to reflect changes in subtotal
        }
      })
      .catch((error) => {
        console.error("Error updating cart quantity:", error);
      });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const removeButtons = document.querySelectorAll(".remove-from-cart-button");

  removeButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const productId = button.getAttribute("data-product-id");

      // Send AJAX request to remove the item from the cart
      fetch("../actions/delete_cart_item_action.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          product_id: productId,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Remove the cart item from the DOM
            const cartItem = document.querySelector(
              `.cart-item[data-product-id="${productId}"]`
            );
            cartItem.remove();

            // Update subtotal
            updateSubtotal();
          } else {
            alert(data.message);
          }
        })
        .catch((error) => {
          console.error("Error removing item from cart:", error);
          alert("Failed to remove product from cart. Please try again later.");
        });
    });
  });

  // Function to update the subtotal
  function updateSubtotal() {
    let subtotal = 0;
    document.querySelectorAll(".cart-item").forEach((item) => {
      const price = parseFloat(
        item.querySelector(".cart-item-details p").textContent.replace("$", "")
      );
      const quantity = parseInt(item.querySelector(".quantity-input").value);
      subtotal += price * quantity;
    });
    document.getElementById(
      "cart-drawer-subtotal"
    ).textContent = `$${subtotal.toFixed(2)} USD`;
  }

  // Update subtotal initially
  updateSubtotal();
});
