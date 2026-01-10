const CART_KEY = 'inksiders_cart';

function getCart() {
  try {
    return JSON.parse(localStorage.getItem(CART_KEY)) || [];
  } catch {
    return [];
  }
}

function saveCart(items) {
  localStorage.setItem(CART_KEY, JSON.stringify(items));
}

function addToCart(product) {
  const cart = getCart();
  const idx = cart.findIndex(p => p.id === product.id);

  if (idx >= 0) {
    cart[idx].qty += 1;
  } else {
    cart.push({ ...product, qty: 1 });
  }

  saveCart(cart);
  alert('Ditambahkan ke keranjang');
}

function cartTotal() {
  return getCart().reduce((sum, p) => sum + p.price * p.qty, 0);
}

// ===== Bind Add To Cart Buttons =====
function bindAddToCartButtons() {
  document.querySelectorAll('[data-add]').forEach(btn => {
    btn.addEventListener('click', () => {
      const prod = JSON.parse(btn.getAttribute('data-add'));
      addToCart(prod);
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  bindAddToCartButtons();
});
