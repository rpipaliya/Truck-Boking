/**
 * Real-Time Driver Tracking Module
 * Demonstrates: WebSocket/polling, real-time updates, map integration
 * Used in: customer/booking_history.php - Live driver tracking
 */

class DriverTracker {
    constructor(bookingId, mapElementId = 'trackingMap') {
        this.bookingId = bookingId;
        this.mapElement = document.getElementById(mapElementId);
        this.pollingInterval = 5000; // Update every 5 seconds
        this.pollingTimer = null;
        this.currentLocation = null;
        this.map = null;
        this.marker = null;
        this.routePath = null;

        this.initializeMap();
        this.startTracking();
    }

    /**
     * Initialize Google Map
     */
    initializeMap() {
        if (!this.mapElement) return;

        const defaultLocation = { lat: 40.7128, lng: -74.0060 }; // NYC default

        this.map = new google.maps.Map(this.mapElement, {
            zoom: 14,
            center: defaultLocation,
            mapTypeControl: true,
            fullscreenControl: true
        });

        // Initialize route polyline
        this.routePath = new google.maps.Polyline({
            map: this.map,
            strokeColor: '#4285F4',
            strokeWeight: 3,
            geodesic: true
        });
    }

    /**
     * Start tracking driver location
     */
    startTracking() {
        this.updateLocation();
        this.pollingTimer = setInterval(() => this.updateLocation(), this.pollingInterval);
    }

    /**
     * Stop tracking driver location
     */
    stopTracking() {
        if (this.pollingTimer) {
            clearInterval(this.pollingTimer);
            this.pollingTimer = null;
        }
    }

    /**
     * Fetch and update driver location
     */
    async updateLocation() {
        try {
            const data = await ajax.get(`/bookings/${this.bookingId}/driver-location`);

            if (data.success && data.location) {
                this.currentLocation = {
                    lat: parseFloat(data.location.latitude),
                    lng: parseFloat(data.location.longitude)
                };

                this.updateMapMarker();
                this.updateLocationInfo(data);

                // Stop tracking if delivery is complete
                if (data.status === 'completed') {
                    this.stopTracking();
                    this.showCompletionMessage(data);
                }
            }
        } catch (error) {
            console.error('Failed to update driver location:', error);
        }
    }

    /**
     * Update marker on map
     */
    updateMapMarker() {
        if (!this.currentLocation) return;

        if (this.marker) {
            // Update existing marker
            this.marker.setPosition(this.currentLocation);
        } else {
            // Create new marker
            this.marker = new google.maps.Marker({
                map: this.map,
                position: this.currentLocation,
                title: 'Driver Location',
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
            });
        }

        // Center map on driver
        this.map.panTo(this.currentLocation);

        // Add to route path
        const path = this.routePath.getPath();
        path.push(this.currentLocation);
    }

    /**
     * Update location information display
     * @param {Object} data - Location data from server
     */
    updateLocationInfo(data) {
        const infoPanel = document.getElementById('locationInfo');
        if (!infoPanel) return;

        infoPanel.innerHTML = `
            <div class="tracking-info">
                <p><strong>Driver:</strong> ${data.driver_name || 'N/A'}</p>
                <p><strong>Vehicle:</strong> ${data.vehicle_number || 'N/A'}</p>
                <p><strong>Status:</strong> <span class="status-badge status-${data.status}">${this.formatStatus(data.status)}</span></p>
                <p><strong>Last Updated:</strong> ${this.formatTime(data.updated_at)}</p>
                <p><strong>ETA:</strong> ${data.eta || 'Calculating...'}</p>
            </div>
        `;
    }

    /**
     * Show completion message
     * @param {Object} data - Booking completion data
     */
    showCompletionMessage(data) {
        const notification = document.createElement('div');
        notification.className = 'notification notification-success';
        notification.textContent = 'Your booking has been completed!';
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 5000);
    }

    /**
     * Format status string
     * @param {string} status - Status value
     * @returns {string} - Formatted status
     */
    formatStatus(status) {
        const statuses = {
            'pending': 'Pending',
            'accepted': 'Driver Accepted',
            'on_way': 'On the Way',
            'arrived': 'Arrived at Pickup',
            'in_transit': 'In Transit',
            'completed': 'Completed'
        };
        return statuses[status] || status;
    }

    /**
     * Format timestamp
     * @param {string} timestamp - ISO timestamp
     * @returns {string} - Formatted time
     */
    formatTime(timestamp) {
        const date = new Date(timestamp);
        return date.toLocaleTimeString();
    }

    /**
     * Get current location
     * @returns {Object} - Current location coordinates
     */
    getLocation() {
        return this.currentLocation;
    }
}

// Initialize tracker when page loads
document.addEventListener('DOMContentLoaded', () => {
    const bookingIdElement = document.querySelector('[data-booking-id]');
    if (bookingIdElement) {
        const bookingId = bookingIdElement.dataset.bookingId;
        window.tracker = new DriverTracker(bookingId);
    }
});
