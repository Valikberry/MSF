<?php

namespace App\Exports\Admin;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select([
            'customers.uid', DB::raw('CONCAT(COALESCE(agents.first_name,""), \' \', COALESCE(agents.middle_name,""), \' \', COALESCE(agents.last_name,""), \' (\', agents.id, \')\') as agent_name'), 'customers.first_name', 'customers.middle_name', 'customers.last_name', 'customers.nepali_name',
            'customers.phone_no', 'customers.phone_no2', 'customers.password_text',
            'provinces.name as province_name', 'districts.name as district_name', 'municipalities.name as municipality_name',
            'customers.ward', 'customers.tol',
            'customers.family',
        ])
            ->join('agents', 'customers.agent_id', 'agents.id')
            ->join('provinces', 'customers.province_id', 'provinces.id')
            ->join('districts', 'customers.district_id', 'districts.id')
            ->join('municipalities', 'customers.municipality_id', 'municipalities.id')
            ->orderBy('uid')->get();
        //dd($data->toArray());
    }


    public function headings(): array
    {
        return [
            'ID',
            'Agent',
            'First Name',
            'Middle Name',
            'Last Name',
            'Nepali Name',
            'Phone',
            'Phone 2',
            'Password',
            'Province ID',
            'District ID',
            'Municipality ID',
            'Ward',
            'Tol',
            'Family',
        ];
    }

}

