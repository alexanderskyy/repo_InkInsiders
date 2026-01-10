function placeOrder(formData) {
  const orderId = 'INK-' + Math.floor(Math.random() * 900000 + 100000);

  sessionStorage.setItem(
    'inksiders_order',
    JSON.stringify({
      id: orderId,
      total: cartTotal(),
      data: formData
    })
  );

  saveCart([]);
  window.location.href = 'confirmation.html';
}

document.addEventListener('DOMContentLoaded', () => {
  // Checkout page
  const checkoutForm = document.querySelector('#checkout-form');
  if (checkoutForm) {
    checkoutForm.addEventListener('submit', e => {
      e.preventDefault();
      const formData = Object.fromEntries(new FormData(checkoutForm).entries());
      placeOrder(formData);
    });

    const totalEl = document.querySelector('#checkout-total');
    if (totalEl) {
      totalEl.textContent = `Rp ${cartTotal().toLocaleString('id-ID')}`;
    }
  }

  // Confirmation page
  const confBox = document.querySelector('#order-conf');
  if (confBox) {
    const order = JSON.parse(
      sessionStorage.getItem('inksiders_order') || '{}'
    );

    if (order?.id) {
      confBox.innerHTML = `
        <p><strong>Nomor Order:</strong> ${order.id}</p>
        <p><strong>Total:</strong> Rp ${order.total.toLocaleString('id-ID')}</p>
        <p>Terima kasih telah berbelanja di Inksiders!</p>
      `;
    } else {
      confBox.textContent = 'Tidak ada order yang ditemukan.';
    }
  }
});