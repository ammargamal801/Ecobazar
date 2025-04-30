document.addEventListener("DOMContentLoaded", () => {
    const updateCartTotal = () => {
      let subtotal = 0;
      document.querySelectorAll(".cart-item").forEach(item => {
        const price = parseFloat(item.querySelector(".price").textContent);
        const quantity = parseInt(item.querySelector(".quantity").value);
        const itemSubtotal = price * quantity;
        item.querySelector(".subtotal").textContent = itemSubtotal.toFixed(2);
        subtotal += itemSubtotal;
      });
      document.getElementById("cart-subtotal").textContent = subtotal.toFixed(2);
      document.getElementById("cart-total").textContent = subtotal.toFixed(2);
    };
  
    // Handle quantity changes
    document.querySelectorAll(".quantity-increase").forEach(button => {
      button.addEventListener("click", () => {
        const quantityInput = button.parentElement.querySelector(".quantity");
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateCartTotal();
      });
    });
  
    document.querySelectorAll(".quantity-decrease").forEach(button => {
      button.addEventListener("click", () => {
        const quantityInput = button.parentElement.querySelector(".quantity");
        if (quantityInput.value > 1) {
          quantityInput.value = parseInt(quantityInput.value) - 1;
          updateCartTotal();
        }
      });
    });
  
    // Handle item removal
    document.querySelectorAll(".remove-item").forEach(button => {
      button.addEventListener("click", () => {
        button.closest(".cart-item").remove();
        updateCartTotal();
      });
    });
  
    // Update cart on manual quantity change
    document.querySelectorAll(".quantity").forEach(input => {
      input.addEventListener("change", () => {
        if (input.value < 1) input.value = 1;
        updateCartTotal();
      });
    });
  
    // Initial calculation
    updateCartTotal();
  });