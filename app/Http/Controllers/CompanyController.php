<?php

namespace App\Http\Controllers;

use App\EnumTypes\UFEnum;
use App\Http\Controllers\Traits\ApiResponseTrait;
use App\Http\Requests\SearchRequest;
use App\Services\CompanyServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class CompanyController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private CompanyServiceInterface $companyService)
    {
    }

    public function index(SearchRequest $request)
    {
        return $this->run(function () use ($request) {
            return $this->companyService->list($request->query());
        });
    }

    public function listUF()
    {
        return $this->run(function () {
            return array_column(UFEnum::cases(), 'value');
        });
    }

    public function listCities()
    {
        return $this->run(function () {
            return $this->companyService->getValidCity();
        });
    }

    public function listStateCities(Request $request)
    {
        return $this->run(function () use ($request) {
            $request->validate([
                'UF' => [new Enum(UFEnum::class)],
            ]);

            return $this->companyService->getValidStateCities(
                UFEnum::from($request->query('UF'))
            );
        });
    }
}
