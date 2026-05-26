<?php
/**
 * Trucks API Endpoint
 * Demonstrates: Filtering, searching, pagination, OOP patterns
 * 
 * Endpoints:
 * - GET /api/trucks - List trucks with filters
 * - GET /api/trucks/{id} - Get truck details
 * - GET /api/trucks/search - Search trucks
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'truckbooking');

class TruckAPI {
    private $conn;
    private $table = 'trucks';

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            $this->respondError('Database connection failed', 500);
        }
    }

    /**
     * Route requests
     */
    public function route($method, $path) {
        $segments = explode('/', trim($path, '/'));

        try {
            if ($method === 'GET' && count($segments) === 2 && $segments[1] === 'trucks') {
                // GET /api/trucks?filters
                $this->listTrucks();
            }
            else if ($method === 'GET' && count($segments) === 3 && $segments[1] === 'trucks') {
                // GET /api/trucks/{id}
                $this->getTruck($segments[2]);
            }
            else if ($method === 'GET' && isset($_GET['search'])) {
                // GET /api/trucks/search?query=...
                $this->searchTrucks($_GET['search']);
            }
            else {
                $this->respondError('Endpoint not found', 404);
            }
        } catch (Exception $e) {
            $this->respondError($e->getMessage(), 500);
        }
    }

    /**
     * GET /api/trucks - List trucks with advanced filtering
     */
    private function listTrucks() {
        $filters = new TruckFilter($_GET);

        $sql = "SELECT t.*, 
                 d.name as driver_name, d.rating as driver_rating,
                 COUNT(DISTINCT b.id) as total_bookings,
                 AVG(b.rating) as avg_rating
                 FROM {$this->table} t
                 LEFT JOIN drivers d ON t.driver_id = d.id
                 LEFT JOIN bookings b ON t.id = b.truck_id
                 WHERE 1=1";

        $params = [];
        $types = '';

        // Apply filters
        $sql .= $filters->buildSQL($params, $types);

        // Add grouping and pagination
        $sql .= " GROUP BY t.id ORDER BY t.created_at DESC LIMIT ? OFFSET ?";
        
        $limit = intval($_GET['limit'] ?? 10);
        $offset = intval($_GET['offset'] ?? 0);
        $params[] = $limit;
        $params[] = $offset;
        $types .= 'ii';

        $stmt = $this->conn->prepare($sql);
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $trucks = $result->fetch_all(MYSQLI_ASSOC);

        $this->respond([
            'success' => true,
            'data' => $trucks,
            'count' => count($trucks),
            'limit' => $limit,
            'offset' => $offset
        ]);
    }

    /**
     * GET /api/trucks/{id} - Get truck details
     */
    private function getTruck($id) {
        $id = intval($id);

        $sql = "SELECT t.*, 
                 d.name as driver_name, d.rating, d.phone,
                 COUNT(DISTINCT b.id) as total_bookings,
                 AVG(b.rating) as avg_booking_rating
                 FROM {$this->table} t
                 LEFT JOIN drivers d ON t.driver_id = d.id
                 LEFT JOIN bookings b ON t.id = b.truck_id
                 WHERE t.id = ?
                 GROUP BY t.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $truck = $result->fetch_assoc();

        if (!$truck) {
            $this->respondError('Truck not found', 404);
        }

        $this->respond([
            'success' => true,
            'data' => $truck
        ]);
    }

    /**
     * GET /api/trucks/search - Search trucks
     */
    private function searchTrucks($query) {
        $query = '%' . $this->conn->real_escape_string($query) . '%';

        $sql = "SELECT t.*, d.name as driver_name
                FROM {$this->table} t
                LEFT JOIN drivers d ON t.driver_id = d.id
                WHERE t.name LIKE ? OR t.vehicle_number LIKE ? OR t.type LIKE ?
                LIMIT 20";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $query, $query, $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $trucks = $result->fetch_all(MYSQLI_ASSOC);

        $this->respond([
            'success' => true,
            'data' => $trucks,
            'count' => count($trucks)
        ]);
    }

    private function respond($data, $statusCode = 200) {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    private function respondError($message, $statusCode = 400) {
        http_response_code($statusCode);
        echo json_encode(['success' => false, 'error' => $message]);
        exit;
    }
}

/**
 * Helper class for building truck filter SQL
 */
class TruckFilter {
    private $filters = [];

    public function __construct($query = []) {
        $this->parseFilters($query);
    }

    private function parseFilters($query) {
        $this->filters = [
            'type' => $query['type'] ?? null,
            'capacity_min' => intval($query['capacity_min'] ?? 0),
            'capacity_max' => intval($query['capacity_max'] ?? PHP_INT_MAX),
            'available' => isset($query['available']) ? (bool)$query['available'] : null,
            'rating_min' => floatval($query['rating_min'] ?? 0),
            'price_min' => floatval($query['price_min'] ?? 0),
            'price_max' => floatval($query['price_max'] ?? PHP_INT_MAX)
        ];
    }

    public function buildSQL(&$params, &$types) {
        $sql = '';

        if ($this->filters['type']) {
            $sql .= ' AND t.type = ?';
            $params[] = $this->filters['type'];
            $types .= 's';
        }

        if ($this->filters['capacity_min'] > 0) {
            $sql .= ' AND t.capacity >= ?';
            $params[] = $this->filters['capacity_min'];
            $types .= 'i';
        }

        if ($this->filters['capacity_max'] < PHP_INT_MAX) {
            $sql .= ' AND t.capacity <= ?';
            $params[] = $this->filters['capacity_max'];
            $types .= 'i';
        }

        if ($this->filters['available'] !== null) {
            $sql .= ' AND t.available = ?';
            $params[] = $this->filters['available'] ? 1 : 0;
            $types .= 'i';
        }

        if ($this->filters['price_min'] > 0) {
            $sql .= ' AND t.price_per_km >= ?';
            $params[] = $this->filters['price_min'];
            $types .= 'd';
        }

        return $sql;
    }
}

// Route the request
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$api = new TruckAPI();
$api->route($method, $path);
?>
