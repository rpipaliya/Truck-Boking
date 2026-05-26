/**
 * AJAX Handlers Module
 * Demonstrates: Asynchronous requests, error handling, state management
 * Used in: Multiple customer pages for real-time data fetching
 */

class AjaxHandler {
    constructor(apiBaseUrl = '/api') {
        this.apiBase = apiBaseUrl;
        this.timeout = 5000; // 5 seconds timeout
        this.cache = new Map();
    }

    /**
     * Generic GET request
     * @param {string} endpoint - API endpoint
     * @param {Object} params - Query parameters
     * @returns {Promise}
     */
    async get(endpoint, params = {}) {
        const queryString = new URLSearchParams(params).toString();
        const url = `${this.apiBase}${endpoint}${queryString ? '?' + queryString : ''}`;

        try {
            const response = await this.fetchWithTimeout(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP Error: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            this.handleError(error);
            throw error;
        }
    }

    /**
     * Generic POST request
     * @param {string} endpoint - API endpoint
     * @param {Object} data - Request body data
     * @returns {Promise}
     */
    async post(endpoint, data = {}) {
        try {
            const response = await this.fetchWithTimeout(`${this.apiBase}${endpoint}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error(`HTTP Error: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            this.handleError(error);
            throw error;
        }
    }

    /**
     * Fetch with timeout
     * @param {string} url - Request URL
     * @param {Object} options - Fetch options
     * @returns {Promise}
     */
    async fetchWithTimeout(url, options = {}) {
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), this.timeout);

        try {
            return await fetch(url, {
                ...options,
                signal: controller.signal
            });
        } finally {
            clearTimeout(timeoutId);
        }
    }

    /**
     * Fetch available trucks
     * @param {Object} filters - Filter criteria
     * @returns {Promise}
     */
    async fetchTrucks(filters = {}) {
        return this.get('/trucks', filters);
    }

    /**
     * Fetch truck details
     * @param {number} truckId - Truck ID
     * @returns {Promise}
     */
    async fetchTruckDetails(truckId) {
        const cacheKey = `truck_${truckId}`;
        
        if (this.cache.has(cacheKey)) {
            return this.cache.get(cacheKey);
        }

        const data = await this.get(`/trucks/${truckId}`);
        this.cache.set(cacheKey, data);
        return data;
    }

    /**
     * Search bookings
     * @param {Object} criteria - Search criteria
     * @returns {Promise}
     */
    async searchBookings(criteria = {}) {
        return this.get('/bookings/search', criteria);
    }

    /**
     * Get driver location (real-time tracking)
     * @param {number} driverId - Driver ID
     * @returns {Promise}
     */
    async getDriverLocation(driverId) {
        return this.get(`/drivers/${driverId}/location`);
    }

    /**
     * Get booking status
     * @param {number} bookingId - Booking ID
     * @returns {Promise}
     */
    async getBookingStatus(bookingId) {
        return this.get(`/bookings/${bookingId}/status`);
    }

    /**
     * Update booking
     * @param {number} bookingId - Booking ID
     * @param {Object} data - Updated data
     * @returns {Promise}
     */
    async updateBooking(bookingId, data) {
        return this.post(`/bookings/${bookingId}`, data);
    }

    /**
     * Error handler
     * @param {Error} error - Error object
     */
    handleError(error) {
        if (error.name === 'AbortError') {
            console.error('Request timeout:', error);
        } else if (error instanceof NetworkError) {
            console.error('Network error:', error);
        } else {
            console.error('AJAX Error:', error);
        }
    }

    /**
     * Clear cache
     */
    clearCache() {
        this.cache.clear();
    }
}

// Initialize global AJAX handler
const ajax = new AjaxHandler('/api');
