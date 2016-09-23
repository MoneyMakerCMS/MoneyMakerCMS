<?php

namespace App\Http\Controllers\Frontend\Pages;


use App\Http\Controllers\Controller;
use App\Repositories\Pages\PagesRepository;

class PagesController extends Controller
{
	private $pages;

	public function __construct(PagesRepository $pages)
	{
		$this->pages = $pages;
	}


	public function index()
	{
		
	}

}
