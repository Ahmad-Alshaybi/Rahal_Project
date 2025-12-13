<?php
require_once __DIR__ . "/db_connect.php";

function clean($v) {
    return htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8');
}

$name = clean($_POST['name'] ?? '');
$category = clean($_POST['category'] ?? '');
$region_id = intval($_POST['region_id'] ?? 0);
$city_id = intval($_POST['city_id'] ?? 0);
$description = clean($_POST['description'] ?? '');
$location = clean($_POST['location'] ?? '');
$intro = clean($_POST['intro'] ?? '');
$importance = clean($_POST['importance'] ?? '');
$features_raw = trim($_POST['features'] ?? '');
$summary = clean($_POST['summary'] ?? '');
$image_url = trim($_POST['image_url'] ?? '');

if (empty($image_url)) {
    exit("رابط الصورة مطلوب");
}

if (!$name || !$category || !$region_id || !$city_id) {
    exit("بيانات ناقصة");
}

/* ========= إنشاء ملف HTML ========= */
$articlesDir = __DIR__ . "/../articles";
if (!is_dir($articlesDir)) {
    mkdir($articlesDir, 0775, true);
}

$slug = preg_replace('/\s+/', '_', $name);
$fileName = $slug . ".html";
$fullPath = $articlesDir . "/" . $fileName;

$i = 2;
while (file_exists($fullPath)) {
    $fileName = $slug . "_" . $i . ".html";
    $fullPath = $articlesDir . "/" . $fileName;
    $i++;
}

$html_file =  $fileName;

/* ========= تجهيز المميزات ========= */
$features_html = "";
foreach (explode("\n", $features_raw) as $f) {
    if (trim($f)) {
        $features_html .= "<li><strong>" . clean($f) . "</strong></li>";
    }
}

/* ========= قالب الصفحة ========= */
$html = "
<html dir='rtl'>
<head>
<meta charset='UTF-8'>
</head>
<body>
<h1>{$name}</h1>

<h2>مقدمة</h2>
<p>{$intro}</p>

<h2>الموقع والأهمية</h2>
<p>{$importance}</p>

<h2>أبرز الأنشطة/المميزات</h2>
<ul>
{$features_html}
</ul>

<h2>خلاصة</h2>
<p>{$summary}</p>
</body>
</html>
";

file_put_contents($fullPath, $html);

/* ========= حفظ الداتابيس ========= */
$stmt = $conn->prepare("
INSERT INTO tourist_attractions
(name, description, region_id, city_id, location, image_url, html_file, category)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssiiisss",
    $name,
    $description,
    $region_id,
    $city_id,
    $location,
    $image_url,
    $html_file,
    $category
);

$stmt->execute();
$stmt->close();

header("Location: add_attraction.php?success=1");
exit;
