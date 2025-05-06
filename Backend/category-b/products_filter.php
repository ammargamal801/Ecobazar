<?php
// بدء جلسة للمستخدم
session_start();

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "market");
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

/**
 * الحصول على جميع الفئات من قاعدة البيانات
 * @param mysqli $conn اتصال قاعدة البيانات
 * @return array مصفوفة تحتوي على جميع الفئات
 */
function getAllCategories($conn) {
    $categories = [];
    $cat_query = $conn->query("SELECT id, name FROM categories ORDER BY name");
    if ($cat_query && $cat_query->num_rows > 0) {
        while ($cat = $cat_query->fetch_assoc()) {
            $categories[] = $cat;
        }
    }
    return $categories;
}

/**
 * الحصول على المنتجات حسب الفئات المحددة
 * @param mysqli $conn اتصال قاعدة البيانات
 * @param array $selectedCategories مصفوفة تحتوي على معرفات الفئات المحددة
 * @return array مصفوفة تحتوي على المنتجات
 */
function getProductsByCategories($conn, $selectedCategories = []) {
    $products = [];
    
    // استعلام أساسي يحتوي على معلومات المنتج والفئة
    $baseSql = "SELECT p.id, p.name, p.description, p.main_image, p.original_price, p.stock_quantity,
                c.name as category_name, c.id as category_id 
                FROM products p 
                JOIN categories c ON p.category_id = c.id";
    
    // إذا تم تحديد فئات، قم بتصفية النتائج
    if (!empty($selectedCategories)) {
        // التأكد من أن جميع المعرفات أرقام صحيحة
        $safeCategories = array_map(function($id) use ($conn) {
            return (int)$conn->real_escape_string($id);
        }, $selectedCategories);
        
        // بناء جزء الشرط من الاستعلام
        $cat_ids = implode(',', $safeCategories);
        $sql = "$baseSql WHERE p.category_id IN ($cat_ids) ORDER BY p.name";
    } else {
        // إظهار جميع المنتجات إذا لم يتم تحديد فئات
        $sql = "$baseSql ORDER BY p.name";
    }

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // تنسيق سعر المنتج بالعملة المناسبة
            $row['formatted_price'] = number_format($row['original_price'], 2) . '$';
            $products[] = $row;
        }
    }
    
    return $products;
}

/**
 * البحث عن المنتجات بواسطة اسم المنتج
 * @param mysqli $conn اتصال قاعدة البيانات
 * @param string $searchTerm مصطلح البحث
 * @return array مصفوفة تحتوي على نتائج البحث
 */
function searchProducts($conn, $searchTerm = '') {
    $products = [];
    
    if (!empty($searchTerm)) {
        $search = '%' . $conn->real_escape_string($searchTerm) . '%';
        $sql = "SELECT p.id, p.name, p.description, p.main_image, p.original_price, p.stock_quantity, 
                c.name as category_name, c.id as category_id 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.name LIKE ? OR p.description LIKE ? 
                ORDER BY p.name";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['formatted_price'] = number_format($row['original_price'], 2) . ' $';
                $products[] = $row;
            }
        }
        $stmt->close();
    }
    
    return $products;
}

// معالجة الفئات المحددة من الطلب
$selected_categories = [];
if (isset($_GET['categories']) && is_array($_GET['categories'])) {
    $selected_categories = array_map('intval', $_GET['categories']);
}

// معالجة مصطلح البحث إذا كان موجودًا
$search_term = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = trim($_GET['search']);
    $products = searchProducts($conn, $search_term);
} else {
    // الحصول على المنتجات حسب الفئات المحددة
    $products = getProductsByCategories($conn, $selected_categories);
}

// الحصول على جميع الفئات للعرض في القائمة
$categories = getAllCategories($conn);

// إغلاق اتصال قاعدة البيانات
$conn->close();

// إذا كان الطلب يطلب استجابة JSON، قم بإرجاع البيانات بتنسيق JSON
if (isset($_GET['api']) && $_GET['api'] == 'json') {
    header('Content-Type: application/json');
    echo json_encode([
        'categories' => $categories,
        'products' => $products,
        'selected_categories' => $selected_categories,
        'search_term' => $search_term
    ]);
    exit;
}
?>