<?php

namespace App\Http\Controllers\PhoneNumber;

use App\Contracts\Request;
use App\Contracts\Response;
use App\Events\DataSaved;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PhoneNumber\PhoneNumber;
use App\Http\Requests\UpdatePhoneNumberRequest;
use App\Http\Resources\PhoneNumber\PhoneNumberResource;
use App\Repositories\PhoneNumber\PhoneNumberRepository;
use App\Http\Requests\PhoneNumber\StorePhoneNumberRequest;
use App\Http\Resources\PhoneNumber\PhoneNumberCollection;

class PhoneNumberController extends Controller
{
    /**
     * @var \App\Models\PhoneNumber\PhoneNumber
     */
    protected $phoneNumberModel;

    /**
     * @var \App\Repositories\PhoneNumber\PhoneNumberRepository
     */
    protected $phoneNumberRepository;

    /**
     * @param \App\Models\PhoneNumber\PhoneNumber $phoneNumber
     * @param \App\Repositories\PhoneNumber\PhoneNumberRepository $phoneNumberRepository
     */

    public function __construct(
        PhoneNumber $phoneNumberModel,
        PhoneNumberRepository $phoneNumberRepository
    ) {
        $this->phoneNumberModel = $phoneNumberModel;
        $this->phoneNumberRepository = $phoneNumberRepository;
    }

    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $phoneNumber = $this->phoneNumberModel->get();

        return Response::json(new PhoneNumberCollection($phoneNumber));
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\PhoneNumber\StorePhoneNumberRequest
     * @return \Illuminate\Http\Request
     */
    
    public function store(StorePhoneNumberRequest $request)
    {
        event(new DataSaved);
        $phoneNumber = DB::transaction(function () use ($request) {
            $phoneNumber = $this->phoneNumberRepository
                ->store($request);

            return $phoneNumber;
        });

        return Response::json(
            new PhoneNumberResource($phoneNumber),
            Response::MESSAGE_CREATED,
            Response::STATUS_CREATED,
        );
    }

    /**
     * Display the specified resource.
     * @param int $id 
     * @return \Illuminate\Http\Response
     */

    public function show(PhoneNumber $phoneNumber)
    {
        return Response::json(new PhoneNumberResource($phoneNumber));
    }

 

    /**
     * Remove the specified resource from storage.
     * @param \App\Contracts\Request $request
     * @param \App\Models\PhoneNumber\PhoneNumber
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, PhoneNumber $phoneNumber)
    {
        $phoneNumber = DB::transaction(function () use ($request, $phoneNumber) {
            return $this->phoneNumberRepository
                ->delete($request, $phoneNumber);
        });

        return Response::noContent();
    }
}
