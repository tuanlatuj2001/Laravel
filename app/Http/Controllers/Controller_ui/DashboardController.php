<?php

namespace App\Http\Controllers\Controller_ui;

use App\Http\Controllers\Controller;
use App\Repository\IDashboardRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $dashboard;
    public function __construct(IDashboardRepository $dashboard){
        $this->dashboard = $dashboard;
    }
    public function index(){
        $u=$this->dashboard->getUser();
        $a=$this->dashboard->getAsset();
        $cAsset=$this->dashboard->countAsset();
        $cUser=$this->dashboard->countUser();
        return view("admin.dashboard",compact("u","a",'cAsset','cUser'));
    }
}
