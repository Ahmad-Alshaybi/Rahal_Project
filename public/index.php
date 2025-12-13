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
 <!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rahal</title> <!-- Page Title -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"><!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./assets/css/style.css"> <!-- Main CSS -->
  <link rel="stylesheet" href="./assets/css/article.css"> <!-- Article CSS -->
  <link rel="icon" href="./assets/images/Favicon/favicon-32x32.png" type="image/x-icon" /> <!-- Favicon -->
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> <!-- Swiper CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Font Awesome CSS -->
</head>

<body>
  <!--
=======================================================
Nav bar
=======================================================
-->
<section dir="ltr">
    <div class="navbar" id="navbar">
        <!-- Search bar -->
        <form method="GET" action="assets/php/search_results.php" class="search-form">
            <input dir="rtl"class="search-bar" type="text" name="query" placeholder="ابحث عن معلم سياحي...">
        </form>

        <!-- Navigation links and logo -->
        <div class="navbar-right-group">
            <!-- Navigation links -->
            <ul class="nav-links" dir="rtl">
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="./assets/php/attractions_list.php">معالم المملكة</a></li>
                <li><a href="./assets/html/Qibla.html">القبلة ومواعيد الصلاة</a></li>
                <li><a href="index.php#map-section">الخريطة</a></li>
                <li><a href="./assets/php/add_attraction.php" style="background:#be9d6a;color:white;padding:8px 14px;border-radius:8px;"> إضافة معلم</a></li>
            </ul>
            <!--Logo-->
            <a href="index.php"><img loading="lazy" decoding="async" src="./assets/images/logo/first-logo.png" alt="RahalLogo" id="logo"></a>
        </div>
    </div>
</section>


  <!--
=======================================================
Background Video
=======================================================
-->
<section class="video-section">
    <video autoplay loop muted playsinline preload="metadata" loading="lazy">
      <source src="./assets/images/Video/intro-background.mp4" type="video/mp4">
    </video>
</section>


  <!--
=======================================================
Name and Slogan
=======================================================
-->
  <section>
    <div class="overlay-text" id="name"></div>
    <div class="slogan" id="slogan"></div>
  </section>


<!--
=======================================================
Important Cities Carousel
=======================================================
-->

<!--
=======================================================
Saudi Landmarks
=======================================================
-->

<!--
=======================================================
Interactive Map Section
=======================================================
-->
  <section class="map" id="map-section" dir="ltr">
    <div class="header third-header">
      <h3>سافر معنا</h3> <!-- Section Title -->
    </div>
    <div class="map-container">
      <!-- Retrieve the map from map0 file -->
      <div class="map-wrapper">
        <iframe src="./assets/html/map0.html" width="100%" height="670" id="map"></iframe>
      </div>

      <!-- Information panel -->
      <div class="info-panel" id="infoPanel">
        <div class="welcome-message">
          <h2>مرحباً بكم في المملكة العربية السعودية</h2>
          <p>اكتشف جمال وتراث مناطق المملكة</p>
          <p>مرر مؤشر الماوس فوق أي منطقة على الخريطة لمعرفة المزيد عنها</p>

          <!-- Saudi logo -->
          <div class="logo-container">
            <img src="./assets/images/Photos/white-saudi-logo.png" alt="Saudi logo" class="welcome-logo">
          </div>
        </div>

        <!--Area information will be added dynamically-->
        <div class="region-info" id="regionInfo"></div>
      </div>
    </div>
  </section>

<!--
=======================================================
Comments Section
=======================================================
-->
<section class="comments-section" dir="rtl">
    <div class="container">
        <!-- Section Title -->
        <h3 class="section-title">آراء زوارنا</h3>
        
        <!-- Comments Carousel Container -->
        <div class="comments-carousel-container">
            <div class="comments-carousel" id="commentsCarousel">
                <!-- Comments will be loaded here by JavaScript -->
            </div>
            
            <!-- Carousel Navigation Buttons -->
            <button class="carousel-btn prev-btn" id="prevComment">❮</button>
            <button class="carousel-btn next-btn" id="nextComment">❯</button>
        </div>
        
        <!-- Add Comment Form Section -->
        <div class="add-comment-form">
            <!-- Form Title -->
            <h3 style="text-align: center; margin-bottom: 30px; font-family: 'Tajawal', sans-serif; color: #142836;">
                أضف تعليقك
            </h3>
            
            <!-- Comment Submission Form -->
            <form id="commentForm" method="POST">
                <!-- Name Input Field -->
                <div class="form-group">
                    <input type="text" id="commentName" name="name" 
                          placeholder="اسمك" required 
                          style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-family: 'Tajawal', sans-serif; font-size: 16px; margin-bottom: 15px;">
                </div>
                
                <!-- Comment Text Input Field -->
                <div class="form-group">
                    <textarea id="commentText" name="text" 
                              placeholder="تعليقك..." required 
                              rows="4"
                              style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-family: 'Tajawal', sans-serif; font-size: 16px; margin-bottom: 15px; resize: vertical;"></textarea>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="custom-btn" 
                        style="display: block; margin: 0 auto; padding: 12px 40px;">
                    إرسال التعليق
                </button>
                
                <!-- Message Display Area for Form Status -->
                <div id="commentMessage" style="text-align: center; margin-top: 15px; font-family: 'Tajawal', sans-serif;"></div>
            </form>
        </div>
    </div>
</section>

<!--
=======================================================
Footer
=======================================================
-->

<!--
=======================================================
Chatbot Widget
=======================================================
-->
