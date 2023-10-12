<?php

declare (strict_types=1);

namespace App\Services\User;

use App\Models\Requester;
use App\Models\User;
use App\Traits\SingletonTrait;

class CreateUserService 
{

    use SingletonTrait;

    public function createRequester(string $email, string $password, string $name, string $user_ein, string $image) : void
    {
        $user = $this->create($email, $password, User::ROLE_REQUESTER);

        $requester = new Requester();
        $requester->user_ein = $user->$user_ein;
        $requester->name = $user->$name;
        $requester->image = $user->$image;

        $requester->save();
    }

    public function updateRequester(Requester|int $requester, string $email, string $password, string $name, string|int $user_ein, string $image) 
    {
        $user = $this->update($requester, $email, $password, User::ROLE_REQUESTER);

        Requester::query()->find($requester instanceof Requester ? $requester->user_ein : $requester)
            ->update([
                'user_ein' => $user->ein,
                'name' => $user->name,
                'image' => $user->image,
            ]);
    }
}

?>