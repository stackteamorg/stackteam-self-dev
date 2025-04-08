<?php

namespace App\Http\Controllers;

use App\Services\Metatag;
use Illuminate\Http\Request;

class Welcome extends Controller
{
    public function __invoke(Metatag $metatag)
    {
        // $metatag->setTitle('استک تیم');
        // $metatag->setDescription('استک تیم');
        // $metatag->setAuthor('مهدی همیلی');
        // $metatag->setLocale('fa');
        // $metatag->setType('website'); 
        // $metatag->setImage('https://www.estekteam.com/images/estekteam.png');
        // $metatag->setPublishedTime('2021-01-01');
        // $metatag->setModifiedTime('2021-01-01');    

        return view('welcome');
    }
}
