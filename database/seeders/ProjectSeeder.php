<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $webDev  = Category::where('slug', 'web-development')->first();
        $uiux    = Category::where('slug', 'ui-ux-design')->first();
        $mobile  = Category::where('slug', 'mobile-app')->first();
        $oss     = Category::where('slug', 'open-source')->first();

        $projects = [
            // Web Development
            [
                'category_id' => $webDev->id,
                'title'       => 'Sistem Manajemen Inventaris',
                'image'       => 'projects/placeholder-1.jpg',
                'demo_link'   => 'https://demo.bilstech.id/inventaris',
                'description' => 'Aplikasi web untuk pengelolaan stok barang gudang dengan fitur laporan harian, notifikasi stok menipis, dan export Excel. Dibangun dengan Laravel 11 + Filament Admin.',
            ],
            [
                'category_id' => $webDev->id,
                'title'       => 'Platform E-Learning Internal',
                'image'       => 'projects/placeholder-2.jpg',
                'demo_link'   => null,
                'description' => 'LMS internal untuk pelatihan karyawan perusahaan manufaktur. Fitur: modul video, kuis interaktif, sertifikat otomatis, dan dashboard progress.',
            ],
            [
                'category_id' => $webDev->id,
                'title'       => 'Booking Lapangan Olahraga',
                'image'       => 'projects/placeholder-3.jpg',
                'demo_link'   => 'https://sport.bilstech.id',
                'description' => 'Sistem reservasi lapangan futsal dan badminton online, terintegrasi payment gateway Midtrans. Mobile-responsive dan support QR check-in.',
            ],
            // UI/UX Design
            [
                'category_id' => $uiux->id,
                'title'       => 'Redesain Aplikasi Keuangan Pribadi',
                'image'       => 'projects/placeholder-4.jpg',
                'demo_link'   => 'https://www.figma.com/community',
                'description' => 'Redesain lengkap UI/UX aplikasi pencatat keuangan pribadi. Research → wireframe → prototype high-fidelity di Figma, dengan sistem desain yang didokumentasikan.',
            ],
            [
                'category_id' => $uiux->id,
                'title'       => 'Dashboard Analytics SaaS',
                'image'       => 'projects/placeholder-5.jpg',
                'demo_link'   => 'https://www.figma.com/community',
                'description' => 'Desain dashboard analitik untuk startup SaaS bidang HR-tech. Fokus pada data visualization yang mudah dibaca dan navigasi yang efisien.',
            ],
            // Mobile App
            [
                'category_id' => $mobile->id,
                'title'       => 'Catatan Harian & Mood Tracker',
                'image'       => 'projects/placeholder-6.jpg',
                'demo_link'   => null,
                'description' => 'Aplikasi Flutter untuk jurnal harian dengan fitur mood tracking, statistik mingguan, dan reminder. Tersedia di Android.',
            ],
            // Open Source
            [
                'category_id' => $oss->id,
                'title'       => 'Laravel Simple CMS',
                'image'       => 'projects/placeholder-7.jpg',
                'demo_link'   => 'https://github.com',
                'description' => 'Package Laravel open-source untuk CMS sederhana berbasis Blade. Fitur: manajemen halaman, media library, dan SEO meta. 200+ stars di GitHub.',
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project
            );
        }
    }
}
