<?php

namespace App\Policies;


use App\Models\User;
use App\Policies\Contracts\BasePolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

class UnitPolicy extends BasePolicy
{
    public function view(User $user, Model $model): Response
    {
        if ($user->id === $model->user_id || is_null($model->user_id)) {
            return Response::allow();
        }
        return Response::deny(__('Bu birimi görüntüleme yetkiniz yok.'));
    }
}
