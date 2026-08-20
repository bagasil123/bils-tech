<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name'        => 'Bagas Ilham Saputro',
                'description' => 'Full-stack developer berbasis di Indonesia. Saya membangun web dan aplikasi yang tidak hanya berfungsi dengan baik, tapi juga terasa menyenangkan untuk digunakan. Saat ini aktif mengerjakan project freelance dan open-source, dengan fokus pada Laravel, Vue.js, dan desain antarmuka yang bersih.',
                'email'       => 'hello@bilstech.id',
                'photo'       => null,
            ]
        );
    }
}
