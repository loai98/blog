<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
   public function about(){
       $title = "About us";
       return view("pages.about")->with("title",$title);
   }
   public function index(){
       $title = "Homepage";
       return view("pages.index")->with("title",$title);
   }
   public function services(){
       $data = [
            'title'=>"Services",
            'services'=>[
                'Web disign',
                "Programming",
                "SEO"
            ]
       ];
       return view("pages.services")->with($data);
   }
}
