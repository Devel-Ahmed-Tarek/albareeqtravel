<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAlbareeqAdmin extends Command
{
    protected $signature = 'albareeq:admin
                            {--email=admin@albareeq.local : البريد}
                            {--password= : كلمة المرور (إن لم تُمرَّر تُستخدم ADMIN_PASSWORD من .env أو password)}';

    protected $description = 'إنشاء أو تحديث مستخدم مدير للوحة Filament (is_admin=1)';

    public function handle(): int
    {
        $email = (string) $this->option('email');
        $plain = $this->option('password');
        if ($plain === null || $plain === '') {
            $plain = (string) config('app.admin_password', 'password');
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => 'مدير الموقع',
                'password' => Hash::make($plain),
                'is_admin' => true,
            ],
        );

        $this->components->info('تم حفظ المدير بنجاح.');
        $this->line("البريد: {$email}");
        $this->line('سجّل الدخول من: '.url('/admin'));

        return self::SUCCESS;
    }
}
