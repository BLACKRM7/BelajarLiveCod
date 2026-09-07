<?php
namespace App\Repositories;

use App\Contracts\Users\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function FindByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}