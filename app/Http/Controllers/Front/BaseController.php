<?php

namespace App\Http\Controllers\Front;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
	/**
	* ページ数を設定する
    * @param 
    * @return 
    */
   	protected $pagesize;
	public function __construct() {
		$page=$this -> pagesize = config('page.pagesize');
		
	}
}
