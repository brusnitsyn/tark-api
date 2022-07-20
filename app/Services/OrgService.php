<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Data\OrgData;
use App\Models\Org;

class OrgService
{
    public function store(OrgData $data)
    {
        $org = new Org();
        $org->name = $data->name;
        $org->inn = $data->inn;
        $org->kpp = $data->kpp;

        if ($data->ogrn)
            $org->ogrn = $data->ogrn;

        if ($data->desc)
            $org->desc = $data->desc;

        if ($data->email)
            $org->email = $data->email;

        if ($data->call)
            $org->call = $data->call;

        if ($data->bank_bik)
            $org->bank_bik = $data->bank_bik;

        if ($data->bank_name)
            $org->bank_name = $data->bank_name;

        if ($data->bank_ks)
            $org->bank_ks = $data->bank_ks;

        if ($data->bank_rs)
            $org->bank_rs = $data->bank_rs;

        $org->type_id = $data->type_id;

        $org->slug = Str::slug($data->name);

        $org->save();

        return $org;
    }
}
