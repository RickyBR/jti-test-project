<?php

namespace App\Repositories\PhoneNumber;

use App\Contracts\Request;
use App\Models\PhoneNumber\PhoneNumber;
use App\Http\Requests\PhoneNumber\StorePhoneNumberRequest;

class PhoneNumberRepository {
    /**
     * @var \App\Models\PhoneNumber\PhoneNumber
     */
    protected $phoneNumberModel;

    /**
     * @param \App\Models\PhoneNumber\PhoneNumber $phoneNumberModel
     */

     public function __construct(
        PhoneNumber $phoneNumberModel
     )
     {
        $this->phoneNumberModel = $phoneNumberModel;
     }

     /**
      * @param \App\Http\Requests\PhoneNumber\StorePhoneNumberRequest
      * @return \App\Models\PhoneNumber\PhoneNumber
      */
      public function store(StorePhoneNumberRequest $request) {
        $input = $request->safe([
            'phoneNumber',
            'operator'
        ]);
        $phoneNumber = $this->phoneNumberModel->create([
            'phone_number'  => $input['phoneNumber'] ?? null,
            'operator'      => $input['operator'] ?? null,
        ]);
        return $phoneNumber;
      }

       /**
     * @param \App\Contracts\Request $request
     * @param \App\Models\PhoneNumber\PhoneNumber $phoneNumber
     * @return \App\Models\PhoneNumber\PhoneNumber
     */

    public function delete(Request $request, PhoneNumber $phoneNumber)
    {
        $phoneNumber->delete();
        return $phoneNumber;
    }
}