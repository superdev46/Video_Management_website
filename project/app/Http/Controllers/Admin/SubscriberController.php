<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Subscriber;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$subscribers = Subscriber::orderBy('id','desc')->get();
        return view('admin.subscriber.subscribers',compact('subscribers'));
    }

    public function download()
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=subscribers.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Subscribers','Emails'));
        $result = Subscriber::all();
        $x = 1;
        foreach ($result as $row){
            $row->id = $x++;
            fputcsv($output, $row->toArray());
        }
        fclose($output);
    }
}
