# API Documentation

## Overview

The Truck Booking System includes a comprehensive REST API built with PHP, demonstrating professional backend development practices. All API endpoints integrate seamlessly with custom JavaScript modules for real-time, responsive user experiences.

---

## Authentication

Currently uses session-based authentication. Future versions will implement JWT tokens.

**For Testing:** Include `Authorization: Bearer YOUR_TOKEN` header for authenticated endpoints.

---

## Base URL

```
http://localhost/Truck-Booking-System/api
```

---

## Bookings API

### 1. List All Bookings

**Endpoint:** `GET /bookings`

**Parameters:**
```
- customer_id (int) - Filter by customer
- status (string) - Filter by status (pending, accepted, in_transit, completed)
- limit (int) - Default: 10
- offset (int) - Default: 0
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "customer_id": 5,
      "truck_id": 2,
      "pickup_address": "123 Main St, NYC",
      "dropoff_address": "456 Park Ave, NYC",
      "goods_weight": 500,
      "goods_type": "Electronics",
      "status": "pending",
      "created_at": "2026-05-26 10:30:00"
    }
  ],
  "count": 1
}
```

**JS Integration:**
```javascript
// Using the AJAX handler module
const bookings = await ajax.get('/bookings', {
  customer_id: 5,
  status: 'pending'
});
```

---

### 2. Get Booking Details

**Endpoint:** `GET /bookings/{id}`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "customer_id": 5,
    "truck_id": 2,
    "truck_name": "Truck A",
    "capacity": 1000,
    "vehicle_number": "TN-01-AB-1234",
    "driver_name": "John Doe",
    "driver_phone": "9876543210",
    "pickup_address": "123 Main St, NYC",
    "dropoff_address": "456 Park Ave, NYC",
    "goods_weight": 500,
    "status": "in_transit",
    "special_requests": "Handle with care"
  }
}
```

**JS Integration:**
```javascript
const booking = await ajax.get(`/bookings/1`);
```

---

### 3. Create New Booking

**Endpoint:** `POST /bookings`

**Request Body:**
```json
{
  "customer_id": 5,
  "truck_id": 2,
  "pickup_address": "123 Main St, NYC",
  "dropoff_address": "456 Park Ave, NYC",
  "goods_weight": 500,
  "goods_type": "Electronics",
  "special_requests": "Handle with care"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Booking created successfully",
  "booking_id": 42
}
```

**JS Integration:**
```javascript
// From booking-validation.js
const booking = await ajax.post('/bookings', {
  customer_id: 5,
  truck_id: 2,
  pickup_address: "123 Main St",
  dropoff_address: "456 Park Ave",
  goods_weight: 500,
  goods_type: "Electronics"
});
```

---

### 4. Get Booking Status

**Endpoint:** `GET /bookings/{id}/status`

**Response:**
```json
{
  "success": true,
  "booking_id": 1,
  "status": "in_transit",
  "updated_at": "2026-05-26 11:45:00"
}
```

**JS Integration:**
```javascript
const status = await ajax.getBookingStatus(1);
```

---

### 5. Get Real-Time Driver Location

**Endpoint:** `GET /bookings/{id}/driver-location`

**Response:**
```json
{
  "success": true,
  "booking_id": 1,
  "driver_name": "John Doe",
  "driver_phone": "9876543210",
  "vehicle_number": "TN-01-AB-1234",
  "location": {
    "latitude": 40.7128,
    "longitude": -74.0060
  },
  "eta": "2026-05-26 12:30:00",
  "status": "in_transit",
  "updated_at": "2026-05-26 11:50:00"
}
```

**JS Integration:**
```javascript
// From real-time-tracking.js
const location = await ajax.get(`/bookings/1/driver-location`);
// Automatically updates map and tracking UI every 5 seconds
```

---

## Trucks API

### 1. List Trucks with Filters

**Endpoint:** `GET /trucks`

**Parameters:**
```
- type (string) - Truck type (closed, open, tanker, etc.)
- capacity_min (int) - Minimum capacity
- capacity_max (int) - Maximum capacity
- available (boolean) - Filter by availability
- rating_min (float) - Minimum driver rating
- price_min (float) - Minimum price per km
- price_max (float) - Maximum price per km
- limit (int) - Default: 10
- offset (int) - Default: 0
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Heavy Loader A",
      "type": "closed",
      "capacity": 5000,
      "vehicle_number": "TN-01-AB-1234",
      "driver_id": 3,
      "driver_name": "John Doe",
      "driver_rating": 4.8,
      "price_per_km": 25.50,
      "available": true,
      "total_bookings": 45,
      "avg_rating": 4.7
    }
  ],
  "count": 1,
  "limit": 10,
  "offset": 0
}
```

**JS Integration:**
```javascript
// From data-filtering.js
const trucks = await ajax.fetchTrucks({
  type: 'closed',
  capacity_min: 1000,
  price_max: 50
});
```

---

### 2. Get Truck Details

**Endpoint:** `GET /trucks/{id}`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Heavy Loader A",
    "type": "closed",
    "capacity": 5000,
    "vehicle_number": "TN-01-AB-1234",
    "driver_id": 3,
    "driver_name": "John Doe",
    "driver_rating": 4.8,
    "driver_phone": "9876543210",
    "price_per_km": 25.50,
    "available": true,
    "total_bookings": 45,
    "avg_booking_rating": 4.7,
    "created_at": "2026-01-15 09:00:00"
  }
}
```

**JS Integration:**
```javascript
const truck = await ajax.fetchTruckDetails(1);
```

---

### 3. Search Trucks

**Endpoint:** `GET /trucks?search=query`

**Parameters:**
```
- search (string) - Search by truck name, vehicle number, or type
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Heavy Loader A",
      "vehicle_number": "TN-01-AB-1234",
      "driver_name": "John Doe"
    }
  ],
  "count": 1
}
```

---

## Error Handling

All endpoints return consistent error responses:

```json
{
  "success": false,
  "error": "Descriptive error message"
}
```

**HTTP Status Codes:**
- `200` - Success
- `201` - Created
- `400` - Bad Request
- `404` - Not Found
- `500` - Server Error

**JS Error Handling:**
```javascript
try {
  const booking = await ajax.get('/bookings/999');
} catch (error) {
  console.error('Booking not found:', error);
}
```

---

## Rate Limiting

Currently not enforced. Production version should implement:
- 100 requests per minute for authenticated users
- 10 requests per minute for unauthenticated users

---

## CORS

API endpoints accept requests from any origin with proper Content-Type headers:
```
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET, POST, PUT, DELETE
Access-Control-Allow-Headers: Content-Type
```

---

## Implementation Examples

### Example 1: Search Trucks and Display Results

```javascript
// From data-filtering.js
async function searchTrucks() {
  const filters = {
    type: 'closed',
    capacity_min: 1000,
    price_max: 50
  };

  try {
    const trucks = await ajax.fetchTrucks(filters);
    
    // Display results using data-filtering module
    const filter = new DataFilter(trucks.data, 'truckContainer');
    filter.displayResults();
  } catch (error) {
    console.error('Search failed:', error);
  }
}
```

### Example 2: Real-Time Booking Tracking

```javascript
// From real-time-tracking.js
document.addEventListener('DOMContentLoaded', () => {
  const bookingId = document.querySelector('[data-booking-id]').dataset.bookingId;
  
  // Creates tracker that polls every 5 seconds
  const tracker = new DriverTracker(bookingId, 'trackingMap');
  
  // Map updates automatically
  // Stops when booking is completed
});
```

### Example 3: Form Validation and Submission

```javascript
// From booking-validation.js
document.addEventListener('DOMContentLoaded', () => {
  const validator = new BookingValidator();
  
  // Validates in real-time as user types
  // Submits via AJAX to /api/bookings
  // Handles errors gracefully
});
```

---

## Database Schema

### Bookings Table
```sql
CREATE TABLE bookings (
  id INT PRIMARY KEY AUTO_INCREMENT,
  customer_id INT NOT NULL,
  truck_id INT NOT NULL,
  driver_id INT,
  pickup_address VARCHAR(255),
  dropoff_address VARCHAR(255),
  goods_weight FLOAT,
  goods_type VARCHAR(100),
  status ENUM('pending', 'accepted', 'in_transit', 'completed', 'cancelled'),
  special_requests TEXT,
  rating INT,
  created_at TIMESTAMP,
  updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Trucks Table
```sql
CREATE TABLE trucks (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100),
  type VARCHAR(50),
  capacity INT,
  vehicle_number VARCHAR(50),
  driver_id INT,
  price_per_km DECIMAL(10, 2),
  available BOOLEAN,
  created_at TIMESTAMP
);
```

---

## Testing the API

### Using cURL

```bash
# Get all bookings
curl -X GET "http://localhost/api/bookings?limit=5"

# Create new booking
curl -X POST "http://localhost/api/bookings" \
  -H "Content-Type: application/json" \
  -d '{
    "customer_id": 5,
    "truck_id": 2,
    "pickup_address": "123 Main St",
    "dropoff_address": "456 Park Ave",
    "goods_weight": 500
  }'

# Get real-time driver location
curl -X GET "http://localhost/api/bookings/1/driver-location"
```

### Using JavaScript

```javascript
// Already demonstrated in each endpoint section
// See JS module files for complete examples:
// - ajax-handlers.js
// - booking-validation.js
// - real-time-tracking.js
// - data-filtering.js
```

---

## Security Considerations

✅ **Implemented:**
- Parameterized queries (prepared statements)
- Input sanitization
- Environment variables for credentials
- CORS headers for cross-origin requests

⚠️ **To Implement in Production:**
- JWT authentication
- Rate limiting
- Request logging
- SQL injection protection enhancement
- XSS prevention headers

---

## Changelog

**Version 1.0.0** (2026-05-26)
- Initial API release
- Bookings endpoints
- Trucks endpoints
- Real-time location tracking
- Advanced filtering

