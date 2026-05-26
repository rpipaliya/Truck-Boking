/**
 * Advanced Data Filtering & Search Module
 * Demonstrates: Filter algorithms, state management, event handling
 * Used in: customer/our_truck.php - Advanced truck search and filtering
 */

class DataFilter {
    constructor(dataSource = [], containerId = 'dataContainer') {
        this.originalData = dataSource;
        this.filteredData = [...dataSource];
        this.filters = {
            search: '',
            capacity: { min: 0, max: Infinity },
            type: [],
            priceRange: { min: 0, max: Infinity },
            availability: true,
            rating: 0
        };
        this.sortBy = 'name';
        this.sortOrder = 'asc';
        this.containerId = containerId;

        this.initializeFilters();
    }

    /**
     * Initialize filter event listeners
     */
    initializeFilters() {
        // Search filter
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => this.applySearchFilter(e.target.value));
        }

        // Capacity range filter
        const capacityMin = document.getElementById('capacityMin');
        const capacityMax = document.getElementById('capacityMax');
        if (capacityMin && capacityMax) {
            capacityMin.addEventListener('change', (e) => {
                this.filters.capacity.min = parseFloat(e.target.value);
                this.applyAllFilters();
            });
            capacityMax.addEventListener('change', (e) => {
                this.filters.capacity.max = parseFloat(e.target.value);
                this.applyAllFilters();
            });
        }

        // Truck type filter (multi-select)
        const typeCheckboxes = document.querySelectorAll('input[name="truckType"]');
        typeCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', (e) => this.applyTypeFilter(e));
        });

        // Price range filter
        const priceMin = document.getElementById('priceMin');
        const priceMax = document.getElementById('priceMax');
        if (priceMin && priceMax) {
            priceMin.addEventListener('change', (e) => {
                this.filters.priceRange.min = parseFloat(e.target.value);
                this.applyAllFilters();
            });
            priceMax.addEventListener('change', (e) => {
                this.filters.priceRange.max = parseFloat(e.target.value);
                this.applyAllFilters();
            });
        }

        // Rating filter
        const ratingSelect = document.getElementById('minRating');
        if (ratingSelect) {
            ratingSelect.addEventListener('change', (e) => {
                this.filters.rating = parseFloat(e.target.value);
                this.applyAllFilters();
            });
        }

        // Sort options
        const sortSelect = document.getElementById('sortBy');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                const [field, order] = e.target.value.split('_');
                this.setSortOptions(field, order);
                this.displayResults();
            });
        }
    }

    /**
     * Apply search filter
     * @param {string} searchTerm - Search term
     */
    applySearchFilter(searchTerm) {
        this.filters.search = searchTerm.toLowerCase();
        this.applyAllFilters();
    }

    /**
     * Apply truck type filter
     * @param {Event} e - Change event
     */
    applyTypeFilter(e) {
        const types = Array.from(document.querySelectorAll('input[name="truckType"]:checked'))
            .map(checkbox => checkbox.value);
        this.filters.type = types;
        this.applyAllFilters();
    }

    /**
     * Apply all active filters
     */
    applyAllFilters() {
        this.filteredData = this.originalData.filter(item => this.matchesAllFilters(item));
        this.applySorting();
        this.displayResults();
        this.updateResultCount();
    }

    /**
     * Check if item matches all active filters
     * @param {Object} item - Data item
     * @returns {boolean}
     */
    matchesAllFilters(item) {
        // Search filter
        if (this.filters.search) {
            const searchFields = ['name', 'type', 'driver_name', 'vehicle_number'];
            const matches = searchFields.some(field =>
                item[field]?.toLowerCase().includes(this.filters.search)
            );
            if (!matches) return false;
        }

        // Capacity filter
        if (item.capacity < this.filters.capacity.min || 
            item.capacity > this.filters.capacity.max) {
            return false;
        }

        // Type filter
        if (this.filters.type.length > 0 && !this.filters.type.includes(item.type)) {
            return false;
        }

        // Price range filter
        if (item.price_per_km < this.filters.priceRange.min || 
            item.price_per_km > this.filters.priceRange.max) {
            return false;
        }

        // Availability filter
        if (this.filters.availability && !item.available) {
            return false;
        }

        // Rating filter
        if (item.rating < this.filters.rating) {
            return false;
        }

        return true;
    }

    /**
     * Apply sorting
     */
    applySorting() {
        this.filteredData.sort((a, b) => {
            let aValue = a[this.sortBy];
            let bValue = b[this.sortBy];

            // Handle numeric vs string comparison
            if (typeof aValue === 'string') {
                aValue = aValue.toLowerCase();
                bValue = bValue.toLowerCase();
            }

            const comparison = aValue < bValue ? -1 : aValue > bValue ? 1 : 0;
            return this.sortOrder === 'asc' ? comparison : -comparison;
        });
    }

    /**
     * Set sorting options
     * @param {string} field - Sort field
     * @param {string} order - Sort order (asc/desc)
     */
    setSortOptions(field, order) {
        this.sortBy = field;
        this.sortOrder = order;
    }

    /**
     * Display filtered results
     */
    displayResults() {
        const container = document.getElementById(this.containerId);
        if (!container) return;

        if (this.filteredData.length === 0) {
            container.innerHTML = '<p class="no-results">No trucks found matching your criteria.</p>';
            return;
        }

        container.innerHTML = this.filteredData.map(item => this.renderItem(item)).join('');
    }

    /**
     * Render single item
     * @param {Object} item - Item to render
     * @returns {string} - HTML string
     */
    renderItem(item) {
        return `
            <div class="truck-card">
                <h3>${item.name}</h3>
                <p><strong>Type:</strong> ${item.type}</p>
                <p><strong>Capacity:</strong> ${item.capacity} tons</p>
                <p><strong>Price:</strong> ₹${item.price_per_km}/km</p>
                <p><strong>Driver:</strong> ${item.driver_name}</p>
                <p><strong>Rating:</strong> ⭐ ${item.rating}/5</p>
                <p><strong>Status:</strong> <span class="status ${item.available ? 'available' : 'unavailable'}">
                    ${item.available ? 'Available' : 'Unavailable'}
                </span></p>
                <button class="btn-primary" onclick="selectTruck(${item.id})">Book Now</button>
            </div>
        `;
    }

    /**
     * Update result count display
     */
    updateResultCount() {
        const countElement = document.getElementById('resultCount');
        if (countElement) {
            countElement.textContent = `${this.filteredData.length} truck(s) found`;
        }
    }

    /**
     * Reset all filters
     */
    resetFilters() {
        this.filters = {
            search: '',
            capacity: { min: 0, max: Infinity },
            type: [],
            priceRange: { min: 0, max: Infinity },
            availability: true,
            rating: 0
        };
        this.filteredData = [...this.originalData];
        this.displayResults();
        
        // Reset UI
        document.getElementById('searchInput').value = '';
        document.querySelectorAll('input[name="truckType"]').forEach(cb => cb.checked = false);
    }

    /**
     * Get filtered data
     * @returns {Array}
     */
    getFilteredData() {
        return [...this.filteredData];
    }

    /**
     * Get filter stats
     * @returns {Object}
     */
    getStats() {
        return {
            total: this.originalData.length,
            filtered: this.filteredData.length,
            activeFilters: this.getActiveFilterCount()
        };
    }

    /**
     * Get count of active filters
     * @returns {number}
     */
    getActiveFilterCount() {
        let count = 0;
        if (this.filters.search) count++;
        if (this.filters.type.length > 0) count++;
        if (this.filters.capacity.min > 0 || this.filters.capacity.max < Infinity) count++;
        if (this.filters.priceRange.min > 0 || this.filters.priceRange.max < Infinity) count++;
        if (this.filters.rating > 0) count++;
        return count;
    }
}

// Initialize filter when page loads
document.addEventListener('DOMContentLoaded', () => {
    const dataElement = document.querySelector('[data-trucks]');
    if (dataElement) {
        const trucks = JSON.parse(dataElement.dataset.trucks);
        window.truckFilter = new DataFilter(trucks, 'truckContainer');
    }
});
