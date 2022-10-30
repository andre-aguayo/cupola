<?php

namespace App\Services;

use App\EnumTypes\UFEnum;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService implements CompanyServiceInterface
{
    public function list(array $searchParams): Collection
    {
        return Company::select([
            'name',
            'description',
            'email',
            'phone',
            'UF',
            'city'
        ])
            ->where($searchParams)
            ->get();
    }

    public function getValidUF(): array
    {
        return Company::select('UF')->groupBy('UF')->get()->toArray();
    }

    public function getValidStateCities(UFEnum $uf): array
    {
        return Company::select('city')->where('UF', $uf)->groupBy('city')->get()->toArray();
    }

    public function getValidCity(): array
    {
        return Company::select('city')->groupBy('city')->get()->toArray();
    }
}
