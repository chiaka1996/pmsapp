<?php

namespace App\Repositories\Eloquent\Repository;
use App\Models\Company;
class CompanyRepository extends BaseRepository
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }
}

