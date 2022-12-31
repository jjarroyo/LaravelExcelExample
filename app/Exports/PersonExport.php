<?php

namespace App\Exports;

use Faker\Factory;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Excel;

class PersonExport implements FromCollection, Responsable,WithHeadings, ShouldAutoSize,WithTitle 
{
    use Exportable;
    

    private $records;
    
    public function __construct($records){
        $this->records = $records;
    }

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'persons.xlsx';
    
    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;
    
    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function title(): string
    {
        return 'Persons';
    }

    public function headings(): array
    {
       
        return [
            '#',
            'name',
            'email',
        ];
    }

    public function collection()
    {
        $persons = [];
        $faker = Factory::create();
        for ($i = 0; $i < $this->records; $i++) {
            $persons[] = ["#"=>$i+1,"name"=>$faker->name,"date"=>$faker->email];
        } 
        return new Collection($persons);
    }
}
