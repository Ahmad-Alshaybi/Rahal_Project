<?php
require_once __DIR__ . "/db_connect.php";

$regions = get_regions($conn);
$cities  = get_cities($conn);
$categories = get_categories();

function e($v) {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>إضافة معلم</title>
<style>
body{font-family:system-ui;max-width:900px;margin:40px auto}
label{display:block;margin-top:14px;font-weight:600}
input,select,textarea{width:100%;padding:10px;margin-top:6px}
textarea{min-height:100px}
button{margin-top:20px;padding:12px 18px}
</style>
</head>
<body>

<h1>إضافة معلم جديد</h1>

<form method="post" action="save_attraction.php" enctype="multipart/form-data">

<label>اسم المعلم</label>
<input name="name" required>

<label>التصنيف</label>
<select name="category" required>
<?php foreach($categories as $c): ?>
<option value="<?= e($c) ?>"><?= e($c) ?></option>
<?php endforeach; ?>
</select>

<label>المنطقة</label>
<select name="region_id" required>
<?php foreach($regions as $r): ?>
<option value="<?= $r['id'] ?>"><?= e($r['name']) ?></option>
<?php endforeach; ?>
</select>

<label>المدينة</label>
<select name="city_id" required>
<?php foreach($cities as $c): ?>
<option value="<?= $c['id'] ?>"><?= e($c['name']) ?></option>
<?php endforeach; ?>
</select>

<label>الوصف المختصر (للكرت)</label>
<textarea name="description"></textarea>

<label>الموقع</label>
<input name="location">

<label>مقدمة</label>
<textarea name="intro" required></textarea>

<label>الموقع والأهمية</label>
<textarea name="importance" required></textarea>

<label>أبرز الأنشطة / المميزات (كل سطر ميزة)</label>
<textarea name="features" required></textarea>

<label>خلاصة</label>
<textarea name="summary" required></textarea>

<label>رابط صورة المعلم</label>
<input 
  type="url" 
  name="image_url" 
  placeholder="https://example.com/image.jpg"
  required
>

<button type="submit">حفظ المعلم</button>
</form>

</body>
</html>
