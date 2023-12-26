<?php

namespace App\Contracts;

use Illuminate\Http\Request as LaravelRequest;

class Request extends LaravelRequest
{
    use Commons\HasUserDataHeader;
}
