function removeFromCart(id) {
  const cart = getCart().filter(p => p.id !== id);
  saveCart(cart);
  renderCart();
}

function updateQty(id, qty) {
  const cart = getCart().map(p =>
    p.id === id ? { ...p, qty: Math.max(1, qty) } : p
  );
  saveCart(cart);
  renderCart();
}

function renderCart() {
  const tbody = document.querySelector('#cart-body');
  const totalEl = document.querySelector('#cart-total');
  if (!tbody || !totalEl) return;

  const cart = getCart();
  tbody.innerHTML = '';

  if (cart.length === 0) {
    tbody.innerHTML = `
      <tr>
        <td colspan="5" class="empty">Keranjang kosong</td>
      </tr>`;
    totalEl.textContent = 'Rp 0';
    return;
  }

  cart.forEach(p => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${p.name}</td>
      <td>Rp ${p.price.toLocaleString('id-ID')}</td>
      <td>
        <input type="number" min="1" value="${p.qty}" style="width:70px">
      </td>
      <td>Rp ${(p.price * p.qty).toLocaleString('id-ID')}</td>
      <td>
        <button class="btn btn-outline" data-remove="${p.id}">Hapus</button>
      </td>
    `;

    tbody.appendChild(tr);

    tr.querySelector('input').addEventListener('change', e => {
      updateQty(p.id, parseInt(e.target.value || '1', 10));
    });

    tr.querySelector('[data-remove]').addEventListener('click', () => {
      removeFromCart(p.id);
    });
  });

  totalEl.textContent = `Rp ${cartTotal().toLocaleString('id-ID')}`;
}

document.addEventListener('DOMContentLoaded', renderCart);