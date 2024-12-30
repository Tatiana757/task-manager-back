<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'created_at' => $this->created_at,
            'token' => $this->when(
                isset($this->additional['token']),
                fn() => $this->additional['token']
            ),
        ];
    }
} 