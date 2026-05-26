/**
 * Booking Form Validation Module
 * Demonstrates: Input validation, error handling, DOM manipulation
 * Used in: customer/booking.php
 */

class BookingValidator {
    constructor() {
        this.errors = {};
        this.form = document.getElementById('bookingForm');
        this.initializeValidation();
    }

    /**
     * Initialize form validation listeners
     */
    initializeValidation() {
        if (!this.form) return;

        // Real-time validation on input change
        this.form.addEventListener('change', (e) => this.validateField(e.target));
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    /**
     * Validate individual form fields
     * @param {HTMLElement} field - Form field to validate
     * @returns {boolean} - Validation result
     */
    validateField(field) {
        const fieldName = field.name;
        let isValid = true;
        let errorMsg = '';

        // Phone number validation
        if (fieldName === 'phone' || fieldName === 'customer_phone') {
            const phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(field.value)) {
                isValid = false;
                errorMsg = 'Phone number must be 10 digits';
            }
        }

        // Email validation
        if (fieldName === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(field.value)) {
                isValid = false;
                errorMsg = 'Invalid email format';
            }
        }

        // Address validation (not empty, minimum 5 chars)
        if (fieldName === 'pickup_address' || fieldName === 'dropoff_address') {
            if (field.value.trim().length < 5) {
                isValid = false;
                errorMsg = 'Address must be at least 5 characters';
            }
        }

        // Weight validation (positive number)
        if (fieldName === 'goods_weight') {
            const weight = parseFloat(field.value);
            if (isNaN(weight) || weight <= 0) {
                isValid = false;
                errorMsg = 'Weight must be a positive number';
            }
        }

        // Date validation (must be future date)
        if (fieldName === 'booking_date') {
            const selectedDate = new Date(field.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (selectedDate < today) {
                isValid = false;
                errorMsg = 'Booking date must be in the future';
            }
        }

        // Update error display
        this.displayError(fieldName, isValid, errorMsg);
        return isValid;
    }

    /**
     * Display validation error messages
     * @param {string} fieldName - Name of field
     * @param {boolean} isValid - Validation status
     * @param {string} errorMsg - Error message
     */
    displayError(fieldName, isValid, errorMsg) {
        const field = this.form.querySelector(`[name="${fieldName}"]`);
        const errorContainer = field.parentElement.querySelector('.error-message');

        if (!isValid) {
            if (errorContainer) {
                errorContainer.textContent = errorMsg;
                errorContainer.style.display = 'block';
            }
            field.classList.add('error-field');
            this.errors[fieldName] = errorMsg;
        } else {
            if (errorContainer) {
                errorContainer.style.display = 'none';
            }
            field.classList.remove('error-field');
            delete this.errors[fieldName];
        }
    }

    /**
     * Handle form submission
     * @param {Event} e - Submit event
     */
    handleSubmit(e) {
        e.preventDefault();
        this.errors = {};

        // Validate all fields
        const fields = this.form.querySelectorAll('input, textarea, select');
        let allValid = true;

        fields.forEach(field => {
            if (!this.validateField(field)) {
                allValid = false;
            }
        });

        if (allValid) {
            this.submitForm();
        } else {
            this.showErrorSummary();
        }
    }

    /**
     * Show summary of all errors
     */
    showErrorSummary() {
        const errorCount = Object.keys(this.errors).length;
        alert(`Please fix ${errorCount} error(s) before submitting.`);
        window.scrollTo(0, 0);
    }

    /**
     * Submit form via AJAX
     */
    submitForm() {
        const formData = new FormData(this.form);
        
        fetch('/api/bookings/create', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Booking created successfully!');
                window.location.href = '/customer/booking_history.php';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while creating booking');
        });
    }

    /**
     * Get current errors
     * @returns {Object} - Current validation errors
     */
    getErrors() {
        return this.errors;
    }
}

// Initialize validator when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.bookingValidator = new BookingValidator();
});
