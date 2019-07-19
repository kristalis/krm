<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class DashboardController extends Controller
{
    public function index()
    {
    	$cards = [
    		[
    			'title' => 'All Contacts',
    			'type' => 'value',
    			'value' => '1000'
    		],
    		[
    			'title' => 'Visitors',
    			'type' => 'value',
    			'value' => '100'
    		],
    		[
    			'title' => 'New Believers',
    			'type' => 'value',
    			'value' => '100'
    		],
    		[
    			'title' => 'Members',
    			'type' => 'value',
    			'value' => '100'
    		],
    		[
    			'title' => 'Disciples',
    			'type' => 'chart',
    			'value' => '60'
            ],
            [
    			'title' => 'Shepherds',
    			'type' => 'value',
    			'value' => '100'
            ],
            [
    			'title' => 'Centas',
    			'type' => 'value',
    			'value' => '100'
    		],
    		
    		[
    			'title' => 'Pastors',
    			'type' => 'value',
    			'value' => '100'
    		]
    	];

    	return response()
    		->json(['cards' => $cards]);
    }

    public function getChart($model, $column)
    {
    	$valueFormat = DB::raw("DATE_FORMAT(".$column.", '%d') as value");
    	$start = now()->startOfMonth();
    	$end = now()->endOfMonth();

    	$dates = [];

    	$run = $start->copy();

    	while($run->lte($end)) {
    		$dates = array_add($dates, $run->copy()->format('d'), 0);
    		$run->addDay(1);
    	}

    	$res = $model->groupBy($column)
    		->select(DB::raw('count(*) as total'), $valueFormat)
    		->pluck('total', 'value');

    	$all = $res->toArray() + $dates;

    	ksort($all);

    	return collect(array_values($all))->map(function($item) {
    		return ['value' => $item];
    	});
    }
}
