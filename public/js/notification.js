/**
 * Notification Popup System
 * Auto-dismiss notification with smooth animation
 */

// Create notification container if not exists
function initNotificationContainer() {
    if (!document.querySelector('.notification-container')) {
        const container = document.createElement('div');
        container.className = 'notification-container';
        document.body.appendChild(container);
    }
}

// Show notification
function showNotification(message, type = 'success', duration = 3000) {
    initNotificationContainer();
    
    const container = document.querySelector('.notification-container');
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    
    // Icon based on type
    const icons = {
        success: '✓',
        error: '✕',
        warning: '⚠',
        info: 'ℹ'
    };
    
    const titles = {
        success: 'Berhasil!',
        error: 'Error!',
        warning: 'Peringatan!',
        info: 'Informasi'
    };
    
    notification.innerHTML = `
        <div class="notification-icon">${icons[type]}</div>
        <div class="notification-content">
            <div class="notification-title">${titles[type]}</div>
            <div class="notification-message">${message}</div>
        </div>
        <button class="notification-close" onclick="closeNotification(this)">×</button>
        <div class="notification-progress"></div>
    `;
    
    container.appendChild(notification);
    
    // Auto dismiss
    setTimeout(() => {
        closeNotification(notification);
    }, duration);
}

// Close notification
function closeNotification(element) {
    const notification = element.classList ? element : element.closest('.notification');
    
    if (notification) {
        notification.classList.add('hiding');
        
        setTimeout(() => {
            notification.remove();
            
            // Remove container if empty
            const container = document.querySelector('.notification-container');
            if (container && container.children.length === 0) {
                container.remove();
            }
        }, 300);
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Check for Laravel flash messages
    const successMsg = document.querySelector('[data-success-message]');
    const errorMsg = document.querySelector('[data-error-message]');
    const warningMsg = document.querySelector('[data-warning-message]');
    const infoMsg = document.querySelector('[data-info-message]');
    
    if (successMsg) {
        const message = successMsg.getAttribute('data-success-message');
        showNotification(message, 'success', 1000);
        successMsg.remove();
    }
    
    if (errorMsg) {
        const message = errorMsg.getAttribute('data-error-message');
        showNotification(message, 'error', 1000); // Error stays longer
        errorMsg.remove();
    }
    
    if (warningMsg) {
        const message = warningMsg.getAttribute('data-warning-message');
        showNotification(message, 'warning', 4000);
        warningMsg.remove();
    }
    
    if (infoMsg) {
        const message = infoMsg.getAttribute('data-info-message');
        showNotification(message, 'info');
        infoMsg.remove();
    }
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { showNotification, closeNotification };
}