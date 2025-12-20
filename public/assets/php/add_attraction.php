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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة معلم سياحي جديد - رحال</title>
        <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/article.css">
    <link rel="stylesheet" href="../css/add-attraction.css">
    <link rel="icon" href="../images/Favicon/favicon-32x32.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <section dir="ltr">
        <div class="navbar" id="navbar" style="background-color: white;">
            <form method="GET" action="./search_results.php" class="search-form">
                <input dir="rtl" class="search-bar" type="text" name="query" placeholder="ابحث عن معلم سياحي...">
            </form>

            <div class="navbar-right-group">
                <ul class="nav-links" dir="rtl">
                    <li><a href="../../index.php">الرئيسية</a></li>
                    <li><a href="./attractions_list.php">معالم المملكة</a></li>
                    <li><a href="../html/Qibla.html">القبلة ومواعيد الصلاة</a></li>
                    <li><a href="../../index.php#map-section">الخريطة</a></li>
                </ul>
                
                <a href="../../index.php"><img loading="lazy" decoding="async" src="../images/logo/second-logo.png" alt="RahalLogo" id="logo"></a>
            </div>
        </div>
    </section>

    <div class="add-attraction-container">
        <a href="attractions_list.php" class="back-link">
            <i class="fas fa-arrow-right"></i>
            العودة إلى قائمة المعالم
        </a>
        
        <div class="add-attraction-header">
            <h1><i class="fas fa-plus-circle" style="color: #be9d6a; margin-left: 10px;"></i> إضافة معلم سياحي جديد</h1>
            <p>املأ النموذج أدناه لإضافة معلم سياحي جديد إلى قاعدة البيانات</p>
        </div>
        
        <form method="post" action="save_attraction.php" enctype="multipart/form-data" id="attractionForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="required">اسم المعلم</label>
                        <input type="text" id="name" name="name" required placeholder="أدخل اسم المعلم السياحي">
                        <small class="help-text">مثال: قصر المصمك، سوق عكاظ، إلخ</small>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category" class="required">التصنيف</label>
                        <select id="category" name="category" required>
                            <option value="">اختر الفئة</option>
                            <?php foreach($categories as $c): ?>
                                <option value="<?= e($c) ?>"><?= e($c) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="help-text">اختر التصنيف المناسب للمعلم</small>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="region_id" class="required">المنطقة</label>
                        <select id="region_id" name="region_id" required>
                            <option value="">اختر المنطقة</option>
                            <?php foreach($regions as $r): ?>
                                <option value="<?= $r['id'] ?>"><?= e($r['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="help-text">اختر المنطقة الجغرافية للمعلم</small>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city_id" class="required">المدينة</label>
                        <select id="city_id" name="city_id" required>
                            <option value="">اختر المدينة</option>
                            <?php foreach($cities as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= e($c['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="help-text">اختر المدينة التابعة للمنطقة</small>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description" class="required">الوصف المختصر (للكرت)</label>
                <textarea id="description" name="description" required placeholder="أدخل وصفاً مختصراً عن المعلم (سيظهر في البطاقة)"></textarea>
                <small class="help-text">وصف مختصر يظهر في البطاقة الرئيسية للمعلم</small>
            </div>
            
            <div class="form-group">
                <label for="location" class="required">الموقع</label>
                <input type="text" id="location" name="location" required placeholder="أدخل موقع المعلم">
                <small class="help-text">أدخل العنوان أو الموقع الجغرافي للمعلم</small>
            </div>
            
            <div class="form-group">
                <label for="intro" class="required">مقدمة</label>
                <textarea id="intro" name="intro" required placeholder="أدخل مقدمة عن المعلم السياحي"></textarea>
                <small class="help-text">اكتب مقدمة شيقة عن المعلم</small>
            </div>
            
            <div class="form-group">
                <label for="importance" class="required">الموقع والأهمية</label>
                <textarea id="importance" name="importance" required placeholder="أدخل معلومات عن موقع وأهمية المعلم"></textarea>
                <small class="help-text">صف أهمية الموقع وأبرز ما يميزه</small>
            </div>
            
            <div class="form-group">
                <label for="features" class="required">أبرز الأنشطة / المميزات</label>
                <textarea id="features" name="features" required placeholder="كل سطر يمثل ميزة أو نشاط"></textarea>
                <small class="help-text">أدخل كل ميزة أو نشاط في سطر جديد</small>
            </div>
            
            <div class="form-group">
                <label for="summary" class="required">خلاصة</label>
                <textarea id="summary" name="summary" required placeholder="أدخل الخلاصة النهائية عن المعلم"></textarea>
                <small class="help-text">اكتب ملخصاً نهائياً عن المعلم</small>
            </div>
            
            <div class="form-group">
                <label for="image_url" class="required">رابط صورة المعلم</label>
                <input 
                    type="url" 
                    id="image_url" 
                    name="image_url" 
                    placeholder="https://example.com/image.jpg"
                    required
                >
                <small class="help-text">يجب أن يكون الرابط بصيغة صورة (jpg, png, webp) وأن يكون عاماً</small>
            </div>
            
            <button type="submit" class="submit-btn" id="submitBtn">
                <i class="fas fa-save"></i> حفظ المعلم
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('attractionForm');
            const submitBtn = document.getElementById('submitBtn');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const originalText = submitBtn.innerHTML;
                
                // تعطيل الزر وإظهار التحميل
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';
                
                // التحقق من الحقول المطلوبة
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#dc3545';
                    } else {
                        field.style.borderColor = '#be9d6a';
                    }
                });
                
                if (!isValid) {
                    alert('يرجى ملء جميع الحقول المطلوبة');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                    return false;
                }
                
                // التحقق من رابط الصورة
                const imageUrl = document.getElementById('image_url').value;
                if (imageUrl && !isValidImageUrl(imageUrl)) {
                    const confirmSubmit = confirm('الرابط المدخل قد لا يكون رابط صورة صالح. هل تريد المتابعة؟');
                    if (!confirmSubmit) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                        return false;
                    }
                }
                
                // إذا نجحت جميع الفحوصات، أرسل النموذج
                setTimeout(() => {
                    this.submit();
                }, 500);
            });
            
            function isValidImageUrl(url) {
                return /\.(jpg|jpeg|png|webp|gif)(\?.*)?$/i.test(url);
            }
            
            // إضافة تأثير عند التركيز على الحقول
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.boxShadow = '0 0 0 3px rgba(190, 157, 106, 0.1)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.boxShadow = '';
                });
            });
        });
    </script>
</body>
</html>
