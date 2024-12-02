document.addEventListener("DOMContentLoaded", () => {
  const cartDrawer = document.getElementById("cart-drawer");
  const openCartButton = document.getElementById("open-cart-button");
  const closeCartButton = document.getElementById("close-cart-button");
  const cartOverlay = document.getElementById("cart-overlay");

  // Open the cart drawer
  openCartButton.addEventListener("click", () => {
    cartDrawer.style.right = "0";
    cartOverlay.classList.add("show");
  });

  // Close the cart drawer
  closeCartButton.addEventListener("click", () => {
    cartDrawer.style.right = "-400px";
    cartOverlay.classList.remove("show");
  });

  // Close the cart drawer when clicking the overlay
  cartOverlay.addEventListener("click", () => {
    cartDrawer.style.right = "-400px";
    cartOverlay.classList.remove("show");
  });
});


