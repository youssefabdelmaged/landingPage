@extends('layouts.app')

@section('content')
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'رواد اللياقة') }}</title>
    <meta name="description" content="{{ config('app.description', '') }}" />
    <meta name="keywords" content="{{ config('app.keywords', '') }}" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Custom CSS -->
    @vite('resources/css/pages/landing.css')
</head>
<body>
    <!-- Header / Navigation -->
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav-menu-list navbar-nav ms-auto">
                        <li><a href="#about" class="nav-link">عن البرنامج</a></li>
                        <li><a href="#courses" class="nav-link">الدورات</a></li>
                        <li><a href="#team" class="nav-link">الفريق</a></li>
                        <li><a href="#contact" class="nav-link">تواصل معنا</a></li>
                        <li><a href="{{ route('register') }}" class="register-btn">سجل الآن</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1 class="hero-title">{{ $heroTitle ?? 'برامج المنح الدراسية' }}</h1>
                <p class="hero-subtitle">{{ $heroSubtitle ?? 'احصل على أفضل التدريب مع معهد رواد اللياقة' }}</p>
            </div>
        </div>
    </section>

    <!-- Features Bar -->
    <section class="features-bar-wrapper">
        <div class="features-bar">
            @foreach($features ?? [] as $feature)
            <div class="feature-item">
                <img src="{{ asset($feature['icon']) }}" alt="{{ $feature['title'] }}" class="feature-icon">
                <div class="feature-text">
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container-lg">
            <div class="about-content">
                <div class="about-image-stack">
                    <video class="about-main-video" src="{{ asset('videos/about.mp4') }}" controls></video>
                    <div class="about-overlay"></div>
                    <button class="about-play-btn" aria-label="Play video">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                            <circle cx="30" cy="30" r="30" fill="white" opacity="0.9"/>
                            <path d="M25 20V40L40 30Z" fill="#324094"/>
                        </svg>
                    </button>
                </div>
                <div class="about-text">
                    <div class="about-badge">
                        <span>{{ $aboutBadge ?? 'معتمد دوليًا' }}</span>
                    </div>
                    <h2 class="about-title">{{ $aboutTitle ?? 'عن معهد رواد اللياقة' }}</h2>
                    <p class="about-description">{{ $aboutDescription ?? '' }}</p>
                    <ul class="feature-list">
                        @foreach($aboutFeatures ?? [] as $feature)
                        <li class="feature-list-item">
                            <img src="{{ asset('icons/check.svg') }}" alt="✓" class="check-icon">
                            <div>
                                <h4>{{ $feature['title'] }}</h4>
                                <p>{{ $feature['description'] }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="courses-section" id="courses">
        <div class="container-lg">
            <div class="section-header">
                <div class="flex-column">
                    <h2 class="section-title">{{ $coursesTitle ?? 'أشهر الدورات' }}</h2>
                    <div class="filter-tabs">
                        <button class="filter-tab active">الكل</button>
                        @foreach($courseCategories ?? [] as $category)
                        <button class="filter-tab">{{ $category }}</button>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('courses.all') }}" class="view-all-btn">عرض الكل »</a>
            </div>

            <div class="courses-carousel">
                <div class="carousel-container">
                    <div class="carousel">
                        @foreach($courses ?? [] as $course)
                        <div class="slide">
                            <div class="course-card">
                                <img src="{{ asset($course['image']) }}" alt="{{ $course['title'] }}" class="course-image">
                                <span class="course-price">{{ $course['price'] }} ر.س</span>
                                <div class="course-content">
                                    <div class="course-meta">
                                        <span>{{ $course['duration'] }}</span>
                                        <span>{{ $course['level'] }}</span>
                                    </div>
                                    <h3 class="course-title">{{ $course['title'] }}</h3>
                                    <p class="course-description">{{ Str::limit($course['description'], 100) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button class="carousel-btn prev">❮</button>
                <button class="carousel-btn next">❯</button>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container-lg">
            <div class="stats-content">
                <div class="stats-text">
                    <span class="stats-badge">إحصائيات</span>
                    <h2 class="stats-title">{{ $statsTitle ?? 'ثقة الآلاف من المتدربين' }}</h2>
                </div>
                <div class="stats-grid">
                    @foreach($stats ?? [] as $stat)
                    <div class="stat-item">
                        <div class="stat-number">
                            <span class="stat-value">{{ $stat['number'] }}</span><span class="plus">+</span>
                        </div>
                        <p class="stat-label">{{ $stat['label'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section" id="team">
        <div class="container-lg">
            <h2 class="team-title">{{ $teamTitle ?? 'فريق الخبراء' }}</h2>
            <div class="team-grid">
                @foreach($teamMembers ?? [] as $member)
                <div class="team-card">
                    <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}" class="team-image">
                    <div class="team-info">
                        <h3 class="team-name">{{ $member['name'] }}</h3>
                        <p class="team-role">{{ $member['role'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-hero">
            <div class="cta-text-content">
                <h2 class="cta-main-title">{{ $ctaTitle ?? 'برامج المنح الدراسية' }}</h2>
                <p class="cta-description">{{ $ctaDescription ?? 'نؤمن بأن التعليم حق للجميع' }}</p>
                <a href="{{ route('scholarships') }}" class="cta-btn">{{ $ctaButtonText ?? 'إقرأ المزيد' }} »</a>
            </div>
            <div class="cta-image-stack">
                <div class="cta-bg-shape"></div>
                <img src="{{ asset('images/coach.png') }}" alt="Coach" class="cta-person-image">
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="contact-form">
            <h3 class="contact-title">{{ $contactTitle ?? 'تواصل معنا' }}</h3>
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-input" placeholder="الاسم" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="البريد الإلكتروني" required>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-textarea" placeholder="الرسالة" required></textarea>
                </div>
                <button type="submit" class="form-submit">إرسال</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'رواد اللياقة') }}. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    @vite('resources/js/pages/landing.js')
</body>
</html>
@endsection
