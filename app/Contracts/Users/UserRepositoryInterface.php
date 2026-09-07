<?php
namespace App\Contracts\Users;

use App\Contracts\BaseRepositoryInterface;
use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    function FindByEmail(string $email) : ?User;
}