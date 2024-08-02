<?php

namespace App\Http\Resources\Patient;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'account_nr'    => $this->account->account_nr,
            'first_name'    => $this->account->first_name,
            'last_name'     => $this->account->last_name,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'gender'        => $this->account->gender,
            'bio'           => $this->account->bio,
            'dob'           => $this->account->dob,
        ];
    }
}
