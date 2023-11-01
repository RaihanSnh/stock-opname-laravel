<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use App\Services\User\UserCreationService;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;

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
	
        // Format date of birth menjadi Dd-Mm-yyyy
        $date_of_birth_input = \DateTime::createFromFormat('d-m-Y', $this->ask('Date of Birth'));

if ($date_of_birth_input === false) {
    $this->error('Invalid date format. Please use "d-m-Y".');
    return Command::FAILURE;
}
	
		// Gender choice
        $gender = $this->choice('gender', ['1' => 'Male', '2' => 'Female'], 'Please choose your gender');

        // Format EIN
        $ein = sprintf('%s-%s-%s-%s-1-%03d',
            $date_of_birth_input->format('Y'),
            $date_of_birth_input->format('m'),
            $date_of_birth_input->format('d'),
            $gender === 'Male' ? '1' : '2',
            User::count() + 1
        );

		$date_of_birth = $date_of_birth_input->format('Y-m-d');

		$image = 'default.png';

		$this->info('Creating admin user...');
		UserCreationService::getInstance()->createUser($username, $email, $password, $image, $date_of_birth, $ein, $gender, 'admin');		
        $this->info('Admin user created');

		return Command::SUCCESS;
	}
}
