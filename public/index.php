<?php
include './assets/php/db_connect.php'; // Database connection

// Bring some landmarks to display on the homepage
$featured_sql = "SELECT 
            t.*,
            r.name AS region_name, 
            c.name AS city_name 
        FROM tourist_attractions t
        LEFT JOIN regions r ON t.region_id = r.id
        LEFT JOIN cities c ON t.city_id = c.id 
        ORDER BY t.id
        LIMIT 6";
$featured_result = $conn->query($featured_sql);
$featured_attractions = [];
if ($featured_result) {
    $featured_attractions = $featured_result->fetch_all(MYSQLI_ASSOC);
}
// City and region data for carousel
$cities_data = [
    'الطائف' => ['region' => 1, 'city' => 'الطائف'], // مكة المكرمة (region 1)
    'العلا' => ['region' => 3, 'city' => 'العلا'], // المدينة المنورة (region 3)
    'المدينة المنورة' => ['region' => 3, 'city' => 'المدينة المنورة'], // المدينة المنورة (region 3)
    'عسير' => ['region' => 13, 'city' => 'أبها'], // عسير (region 13)
    'مكة المكرمة' => ['region' => 1, 'city' => 'مكة المكرمة'], // مكة المكرمة (region 1)
    'جدة' => ['region' => 1, 'city' => 'جدة'], // مكة المكرمة (region 1)
    'الرياض' => ['region' => 2, 'city' => 'الرياض'], // الرياض (region 2)
    'الدمام' => ['region' => 4, 'city' => 'الدمام'] // الشرقية (region 4)
];
?>
