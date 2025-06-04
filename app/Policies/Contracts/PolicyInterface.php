<?php

namespace App\Policies\Contracts;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
interface PolicyInterface
{
    /**
     * @param User $user
     * @return Response
     */
    public function viewAny(User $user): Response;

    /**
     * @param User $user
     * @param Model $model
     * @return Response
     */
    public function view(User $user, Model $model): Response;

    /**
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response;

    /**
     * @param User $user
     * @param Model $model
     * @return Response
     */
    public function update(User $user, Model $model): Response;

    /**
     * @param User $user
     * @param Model $model
     * @return Response
     */
    public function delete(User $user, Model $model): Response;
}
