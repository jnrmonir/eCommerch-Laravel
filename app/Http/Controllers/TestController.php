<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    // function contact(){
    // 	return view('contact.contact');
    // }  
    function demo(){
    	$data="hello contact page";
    	return view('demo');
    	// return view('contact.contact', ['hey' => $data]);
    }  
    function contact(){
    	$data="hello contact page";
    	return view('contact.contact',compact('data'));
    	// return view('contact.contact', ['hey' => $data]);
    }
}
