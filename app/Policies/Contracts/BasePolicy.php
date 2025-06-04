<?php

namespace App\Policies\Contracts;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

abstract class BasePolicy implements PolicyInterface
{
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    public function view(User $user, Model $model): Response
    {
        /** @var Model $model */
        return $user->id === $model->user_id
            ? Response::allow()
            : Response::deny('Görüntüleme yetkiniz yok.');
    }

    public function create(User $user): Response
    {
        return Response::allow();
    }

    public function update(User $user, Model $model): Response
    {
        /** @var Model $model */
        return $user->id === $model->user_id
            ? Response::allow()
            : Response::deny('Güncelleme yapmak için yetkiniz yok.');
    }

    public function delete(User $user, Model $model): Response
    {
        /** @var Model $model */
        return $user->id === $model->user_id
            ? Response::allow()
            : Response::deny('Bu veriyi silmek için yetkiniz yok.');
    }
}
