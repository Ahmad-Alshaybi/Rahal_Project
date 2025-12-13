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
  <!--
=======================================================
Nav bar
=======================================================
-->


  <!--
=======================================================
Background Video
=======================================================
-->


  <!--
=======================================================
Name and Slogan
=======================================================
-->


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
