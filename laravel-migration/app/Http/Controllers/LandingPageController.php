<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display the landing page
     */
    public function index()
    {
        $data = [
            'heroTitle' => 'برامج المنح الدراسية',
            'heroSubtitle' => 'احصل على أفضل التدريب مع معهد رواد اللياقة',
            
            'features' => [
                [
                    'icon' => 'icons/feature-1.svg',
                    'title' => 'معتمد دوليًا',
                    'description' => 'شهادات معترفة عالميًا'
                ],
                [
                    'icon' => 'icons/feature-2.svg',
                    'title' => 'خبراء معتمدون',
                    'description' => 'فريق من أفضل المدربين'
                ],
                [
                    'icon' => 'icons/feature-3.svg',
                    'title' => 'برامج مرنة',
                    'description' => 'تدريب حسب احتياجاتك'
                ],
            ],

            'aboutTitle' => 'عن معهد رواد اللياقة',
            'aboutBadge' => 'معتمد دوليًا',
            'aboutDescription' => 'معهد رواد اللياقة هو أول معهد عربي متخصص في تدريب وتأهيل الكادر المتخصص في مجال اللياقة البدنية والتدريب الرياضي. نقدم برامج تدريبية معتمدة من وزارة الرياضة بمنهج عالمي الجودة.',
            
            'aboutFeatures' => [
                [
                    'title' => 'دورات معتمدة',
                    'description' => 'برامج تدريبية معتمدة من الجهات الرسمية'
                ],
                [
                    'title' => 'محاضرون خبراء',
                    'description' => 'متدربون متخصصون بخبرة عملية طويلة'
                ],
                [
                    'title' => 'منح دراسية',
                    'description' => 'فرص تمويل للمتدربين المميزين'
                ],
            ],

            'coursesTitle' => 'أشهر الدورات',
            'courseCategories' => ['تدريب شامل', 'لياقة بدنية', 'إعادة تأهيل'],
            
            'courses' => [
                [
                    'title' => 'دورة التدريب الأساسي',
                    'description' => 'برنامج شامل يغطي كل أساسيات اللياقة البدنية والتدريب الرياضي',
                    'image' => 'images/course-1.jpg',
                    'price' => '1500',
                    'duration' => '8 أسابيع',
                    'level' => 'مبتدئ'
                ],
                [
                    'title' => 'دورة التدريب المتقدم',
                    'description' => 'برنامج متقدم للمدربين والمتخصصين في المجال الرياضي',
                    'image' => 'images/course-2.jpg',
                    'price' => '2500',
                    'duration' => '12 أسبوع',
                    'level' => 'متقدم'
                ],
            ],

            'statsTitle' => 'ثقة الآلاف من المتدربين',
            'stats' => [
                ['number' => '5000', 'label' => 'متدرب'],
                ['number' => '150', 'label' => 'دورة'],
                ['number' => '20', 'label' => 'سنة خبرة'],
                ['number' => '98', 'label' => '% رضا العملاء'],
            ],

            'teamTitle' => 'فريق الخبراء',
            'teamMembers' => [
                [
                    'name' => 'أحمد محمود',
                    'role' => 'مدير التدريب',
                    'image' => 'images/team-1.jpg'
                ],
                [
                    'name' => 'فاطمة علي',
                    'role' => 'مدربة لياقة بدنية',
                    'image' => 'images/team-2.jpg'
                ],
            ],

            'ctaTitle' => 'برامج المنح الدراسية',
            'ctaDescription' => 'نؤمن بأن التعليم حق للجميع، لذلك نوفر منحًا دراسية تُمكِّنك من تحقيق أحلامك الأكاديمية والمهنية.',
            'ctaButtonText' => 'إقرأ المزيد',

            'contactTitle' => 'تواصل معنا',
        ];

        return view('pages.landing', $data);
    }
}
