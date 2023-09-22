<?php

namespace App\Http\Controllers;

class SampleController extends Controller
{
    public function index()
    {
        return response()->json([
            [
                'name' => 'DBを通さないデータです1'
            ],
            [
                'name' => 'DBを通さないデータです2'
            ],
            [
                'name' => 'DBを通さないデータです3'
            ],
            [
                'name' => 'DBを通さないデータです4'
            ],
            [
                'name' => 'DBを通さないデータです5'
            ],
        ]);
    }
}
