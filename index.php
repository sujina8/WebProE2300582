<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'includes/db.php';
$pageTitle = 'EduSkill Marketplace — Home';

// Count stats for hero section
$totalCourses   = $pdo->query("SELECT COUNT(*) FROM courses WHERE is_active=1")->fetchColumn();
$totalProviders = $pdo->query("SELECT COUNT(*) FROM providers WHERE status='Approved'")->fetchColumn();
$totalLearners  = $pdo->query("SELECT COUNT(*) FROM users WHERE role='learner'")->fetchColumn();

// Get latest 6 courses
$featured = $pdo->query("
    SELECT c.*, p.org_name
    FROM courses c
    JOIN providers p ON c.providerID = p.providerID
    WHERE c.is_active = 1
    ORDER BY c.created_at DESC
    LIMIT 6
")->fetchAll();
?>
<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="ems-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <span class="badge bg-warning text-dark mb-3 px-3 py-2 fw-semibold">
          <i class="bi bi-star-fill me-1"></i>
          Ministry of Human Resources Initiative
        </span>
        <h1 class="mb-3">
          Upskill. Reskill.
          <span style="color:#f9ab00;">Grow.</span>
        </h1>
        <p class="mb-4">
          Discover short courses, workshops and certifications
          from approved training providers across Malaysia.
          Enrol online in minutes.
        </p>
        <div class="d-flex gap-3 flex-wrap">
          <a href="courses.php" class="btn btn-warning btn-lg fw-bold px-4">
            <i class="bi bi-search me-2"></i>Browse Courses
          </a>
          <a href="register.php" class="btn btn-outline-light btn-lg px-4">
            <i class="bi bi-building me-2"></i>List Your Courses
          </a>
        </div>
      </div>
      <div class="col-lg-5 text-center mt-4 mt-lg-0">
        <div class="row g-3">
          <div class="col-4">
            <div class="bg-white bg-opacity-10 rounded-3 p-3">
              <div style="font-size:2rem;font-weight:800;color:#f9ab00;">
                <?= $totalCourses ?>
              </div>
              <small class="text-light">Courses</small>
            </div>
          </div>
          <div class="col-4">
            <div class="bg-white bg-opacity-10 rounded-3 p-3">
              <div style="font-size:2rem;font-weight:800;color:#f9ab00;">
                <?= $totalProviders ?>
              </div>
              <small class="text-light">Providers</small>
            </div>
          </div>
          <div class="col-4">
            <div class="bg-white bg-opacity-10 rounded-3 p-3">
              <div style="font-size:2rem;font-weight:800;color:#f9ab00;">
                <?= $totalLearners ?>
              </div>
              <small class="text-light">Learners</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Featured Courses -->
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="fw-bold mb-1">Featured Courses</h2>
        <p class="text-muted mb-0">
          Latest listings from approved training providers
        </p>
      </div>
      <a href="courses.php" class="btn btn-outline-primary">
        View All <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </div>

    <?php if (empty($featured)): ?>
    <div class="text-center py-5 text-muted">
      <i class="bi bi-journal-x" style="font-size:3rem;"></i>
      <p class="mt-3">
        No courses listed yet.
        <a href="register.php">Register as a provider</a>
        to add courses.
      </p>
    </div>
    <?php else: ?>
    <div class="row g-4">
      <?php foreach ($featured as $c): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card course-card h-100">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between mb-2">
              <span class="course-badge">
                <?= htmlspecialchars($c['category']) ?>
              </span>
              <span class="course-badge">
                <?= htmlspecialchars($c['duration']) ?>
              </span>
            </div>
            <h5 class="fw-bold mt-2 mb-1">
              <?= htmlspecialchars($c['title']) ?>
            </h5>
            <p class="text-muted small mb-3">
              <?= htmlspecialchars(substr($c['description'] ?? '', 0, 90)) ?>...
            </p>
            <p class="small text-muted mb-3">
              <i class="bi bi-building me-1"></i>
              <?= htmlspecialchars($c['org_name']) ?>
            </p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="price-tag">
                <?= $c['price'] == 0
                  ? '<span class="text-success fw-bold">FREE</span>'
                  : 'RM ' . number_format($c['price'], 2) ?>
              </span>
              <a href="enrol.php?id=<?= $c['courseID'] ?>"
                 class="btn btn-ems btn-sm">
                Enrol Now
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- How It Works -->
<section class="py-5 bg-white">
  <div class="container">
    <h2 class="fw-bold text-center mb-2">How It Works</h2>
    <p class="text-center text-muted mb-5">
      Simple steps to start learning or teaching
    </p>
    <div class="row g-4 text-center">
      <div class="col-sm-6 col-lg-3">
        <div class="p-4">
          <div style="width:64px;height:64px;background:#e8f0fe;
                      border-radius:50%;display:flex;
                      align-items:center;justify-content:center;
                      margin:0 auto 16px;font-size:1.6rem;
                      color:#1a73e8;">
            <i class="bi bi-search"></i>
          </div>
          <h5 class="fw-bold">Browse</h5>
          <p class="text-muted small">
            Find courses that match your career goals
            from verified providers.
          </p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-4">
          <div style="width:64px;height:64px;background:#e8f0fe;
                      border-radius:50%;display:flex;
                      align-items:center;justify-content:center;
                      margin:0 auto 16px;font-size:1.6rem;
                      color:#1a73e8;">
            <i class="bi bi-person-plus"></i>
          </div>
          <h5 class="fw-bold">Register</h5>
          <p class="text-muted small">
            Create a free learner account in under 2 minutes.
          </p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-4">
          <div style="width:64px;height:64px;background:#e8f0fe;
                      border-radius:50%;display:flex;
                      align-items:center;justify-content:center;
                      margin:0 auto 16px;font-size:1.6rem;
                      color:#1a73e8;">
            <i class="bi bi-credit-card"></i>
          </div>
          <h5 class="fw-bold">Enrol & Pay</h5>
          <p class="text-muted small">
            Secure online payment with instant confirmation.
          </p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-4">
          <div style="width:64px;height:64px;background:#e8f0fe;
                      border-radius:50%;display:flex;
                      align-items:center;justify-content:center;
                      margin:0 auto 16px;font-size:1.6rem;
                      color:#1a73e8;">
            <i class="bi bi-patch-check"></i>
          </div>
          <h5 class="fw-bold">Learn & Review</h5>
          <p class="text-muted small">
            Complete your course and share your experience.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
