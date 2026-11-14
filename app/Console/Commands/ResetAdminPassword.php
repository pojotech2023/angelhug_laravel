<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-password {email=admin@gmail.com} {password?} {--new-email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Safely reset or set an administrator email and password with proper Bcrypt hashing';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $currentEmail = trim($this->argument('email'));
        $password = $this->argument('password');
        $newEmail = $this->option('new-email') ? trim($this->option('new-email')) : null;

        if (!$password) {
            $password = $this->ask('Enter new admin password');
        }

        if (empty($password)) {
            $this->error('Password cannot be empty.');
            return 1;
        }

        // Locate existing admin
        $admin = Login::where('email', $currentEmail)->whereNotNull('password')->first();
        if (!$admin) {
            $admin = Login::where('email', $currentEmail)->first();
        }
        if (!$admin) {
            $admin = Login::find(1);
        }

        if (!$admin) {
            $admin = new Login();
            $admin->email = $newEmail ?: $currentEmail;
        } else {
            if ($newEmail) {
                $admin->email = $newEmail;
            }
        }

        $admin->password = Hash::make($password);
        $admin->save();

        $finalEmail = $admin->email;
        $this->info("✓ Successfully updated administrator account (ID: {$admin->id})");
        $this->line("  • Email: {$finalEmail}");
        $this->line("  • Password: [UPDATED & HASHED WITH BCRYPT]");

        return 0;
    }
}
