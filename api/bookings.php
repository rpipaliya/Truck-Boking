<?php
/**
 * Bookings API Endpoint
 * Demonstrates: RESTful API design, error handling, database interaction, validation
 * 
 * Endpoints:
 * - GET /api/bookings - List all bookings
 * - GET /api/bookings/{id} - Get booking details
 * - POST /api/bookings - Create new booking
 * - GET /api/bookings/{id}/status - Get booking status
 * - GET /api/bookings/{id}/driver-location - Get real-time driver location
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Use environment variables for database credentials
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'truckbooking');

class BookingAPI {
    private $conn;
    private $table = 'bookings';

    public function __construct() {
        $this->connect();
    }

    /**
     * Connect to database
     */
    private function connect() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($this->conn->connect_error) {
            $this->respondError('Database connection failed: ' . $this->conn->connect_error, 500);
        }
    }

    /**
     * Route requests to appropriate handlers
     * @param string $method - HTTP method
     * @param string $path - Request path
     */
    public function route($method, $path) {
        $segments = explode('/', trim($path, '/'));

        try {
            if ($method === 'GET' && count($segments) === 2 && $segments[0] === 'api') {
                // GET /api/bookings
                $this->listBookings();
            } 
            else if ($method === 'GET' && count($segments) === 3 && $segments[1] === 'bookings') {
                // GET /api/bookings/{id}
                $this->getBooking($segments[2]);
            }
            else if ($method === 'POST' && count($segments) === 3 && $segments[1] === 'bookings') {
                // POST /api/bookings
                $this->createBooking();
            }
            else if ($method === 'GET' && count($segments) === 4 && $segments[1] === 'bookings' && $segments[3] === 'status') {
                // GET /api/bookings/{id}/status
                $this->getStatus($segments[2]);
            }
            else if ($method === 'GET' && count($segments) === 4 && $segments[1] === 'bookings' && $segments[3] === 'driver-location') {
                // GET /api/bookings/{id}/driver-location
                $this->getDriverLocation($segments[2]);
            }
            else {
                $this->respondError('Endpoint not found', 404);
            }
        } catch (Exception $e) {
            $this->respondError($e->getMessage(), 500);
        }
    }

    /**
     * GET /api/bookings - List all bookings with filters
     */
    private function listBookings() {
        $customerId = $_GET['customer_id'] ?? null;
        $status = $_GET['status'] ?? null;
        $limit = intval($_GET['limit'] ?? 10);
        $offset = intval($_GET['offset'] ?? 0);

        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        $types = '';

        if ($customerId) {
            $sql .= " AND customer_id = ?";
            $params[] = $customerId;
            $types .= 'i';
        }

        if ($status) {
            $sql .= " AND status = ?";
            $params[] = $status;
            $types .= 's';
        }

        $sql .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= 'ii';

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            $this->respondError('Query preparation failed: ' . $this->conn->error, 500);
        }

        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $bookings = $result->fetch_all(MYSQLI_ASSOC);

        $this->respond([
            'success' => true,
            'data' => $bookings,
            'count' => count($bookings)
        ]);
    }

    /**
     * GET /api/bookings/{id} - Get single booking details
     */
    private function getBooking($id) {
        $id = intval($id);
        
        $sql = "SELECT b.*, 
                 t.name as truck_name, t.capacity, t.vehicle_number,
                 d.name as driver_name, d.phone as driver_phone
                 FROM {$this->table} b
                 LEFT JOIN trucks t ON b.truck_id = t.id
                 LEFT JOIN drivers d ON b.driver_id = d.id
                 WHERE b.id = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            $this->respondError('Query failed: ' . $this->conn->error, 500);
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();

        if (!$booking) {
            $this->respondError('Booking not found', 404);
        }

        $this->respond([
            'success' => true,
            'data' => $booking
        ]);
    }

    /**
     * POST /api/bookings - Create new booking
     */
    private function createBooking() {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate required fields
        $required = ['customer_id', 'truck_id', 'pickup_address', 'dropoff_address', 'goods_weight'];
        foreach ($required as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                $this->respondError("Missing required field: {$field}", 400);
            }
        }

        // Sanitize inputs
        $customerId = intval($data['customer_id']);
        $truckId = intval($data['truck_id']);
        $pickupAddress = $this->conn->real_escape_string($data['pickup_address']);
        $dropoffAddress = $this->conn->real_escape_string($data['dropoff_address']);
        $goodsWeight = floatval($data['goods_weight']);
        $goodsType = $this->conn->real_escape_string($data['goods_type'] ?? '');
        $specialRequests = $this->conn->real_escape_string($data['special_requests'] ?? '');

        // Insert booking
        $sql = "INSERT INTO {$this->table} 
                (customer_id, truck_id, pickup_address, dropoff_address, goods_weight, goods_type, special_requests, status, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', NOW())";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            $this->respondError('Query failed: ' . $this->conn->error, 500);
        }

        $stmt->bind_param('iissdss', $customerId, $truckId, $pickupAddress, $dropoffAddress, $goodsWeight, $goodsType, $specialRequests);

        if ($stmt->execute()) {
            $bookingId = $this->conn->insert_id;
            $this->respond([
                'success' => true,
                'message' => 'Booking created successfully',
                'booking_id' => $bookingId
            ], 201);
        } else {
            $this->respondError('Failed to create booking: ' . $stmt->error, 500);
        }
    }

    /**
     * GET /api/bookings/{id}/status - Get booking status
     */
    private function getStatus($id) {
        $id = intval($id);

        $sql = "SELECT id, status, updated_at FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();

        if (!$booking) {
            $this->respondError('Booking not found', 404);
        }

        $this->respond([
            'success' => true,
            'booking_id' => $booking['id'],
            'status' => $booking['status'],
            'updated_at' => $booking['updated_at']
        ]);
    }

    /**
     * GET /api/bookings/{id}/driver-location - Get real-time driver location
     */
    private function getDriverLocation($bookingId) {
        $bookingId = intval($bookingId);

        $sql = "SELECT b.status, b.driver_id,
                 d.name as driver_name,
                 d.phone as driver_phone,
                 l.latitude, l.longitude, l.updated_at,
                 t.vehicle_number
                 FROM {$this->table} b
                 LEFT JOIN drivers d ON b.driver_id = d.id
                 LEFT JOIN driver_locations l ON d.id = l.driver_id
                 LEFT JOIN trucks t ON b.truck_id = t.id
                 WHERE b.id = ? AND b.status IN ('accepted', 'in_transit')";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            $this->respondError('Query failed: ' . $this->conn->error, 500);
        }

        $stmt->bind_param('i', $bookingId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (!$data) {
            $this->respondError('Booking or driver location not found', 404);
        }

        // Calculate ETA (example calculation)
        $eta = $this->calculateETA($data['latitude'], $data['longitude']);

        $this->respond([
            'success' => true,
            'booking_id' => $bookingId,
            'driver_name' => $data['driver_name'],
            'driver_phone' => $data['driver_phone'],
            'vehicle_number' => $data['vehicle_number'],
            'location' => [
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude']
            ],
            'eta' => $eta,
            'status' => $data['status'],
            'updated_at' => $data['updated_at']
        ]);
    }

    /**
     * Calculate estimated time of arrival (example)
     */
    private function calculateETA($lat, $lng) {
        // This is a simplified example - in production, use actual distance calculation
        return date('Y-m-d H:i:s', strtotime('+30 minutes'));
    }

    /**
     * Send successful response
     */
    private function respond($data, $statusCode = 200) {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    /**
     * Send error response
     */
    private function respondError($message, $statusCode = 400) {
        http_response_code($statusCode);
        echo json_encode([
            'success' => false,
            'error' => $message
        ]);
        exit;
    }
}

// Route the request
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$api = new BookingAPI();
$api->route($method, $path);
?>
