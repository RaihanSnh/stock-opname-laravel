<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\User\UserCreationService;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:admin:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create Admin User';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$username = $this->ask('Admin Username');
        $email = $this->ask('Admin Email');
		$password = $this->secret('Admin Password');
		$imagePath = $this->ask('Path to admin image (optional)');

		$this->info('Creating admin user...');
		UserCreationService::getInstance()->createAdmin($username, $email, $password, $imagePath);
		$this->info('Admin user created');


		return Command::SUCCESS;
	}
}
