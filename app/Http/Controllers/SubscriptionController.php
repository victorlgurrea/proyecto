<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::all();

        return view('subscriptions.index', ['subscriptions' => $subscriptions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'min_labels' => 'required',
            'max_labels' => 'required'
        ]);

        $input = $request->all();

        if($input['max_labels'] < $input['min_labels']){
            return redirect()->route('subscriptions.index')->with('error',__('error_labels_subscription'));
        }
  
        Subscription::create($request->all());
   
        return redirect()->route('subscriptions.index')->with('success',__('success_create_subscription'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        return view('subscriptions.edit',compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'name' => 'required',
            'min_labels' => 'required',
            'max_labels' => 'required'
        ]);
  
        $subscription->update($request->all());
  
        return redirect()->route('subscriptions.index')->with('success',__('success_edit_subscription'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
  
        return redirect()->route('subscriptions.index')->with('success',__('success_remove_subscription'));
    }

    public function delete($id)
    {
        $subscription_id = Subscription::where('id', $id)->first()->id;
        $subscription_name = Subscription::where('id', $id)->first()->name;
        $visible = "";
       
        return view('partials.delete_modal', [
            'rute' => 'subscriptions.destroy',
            'id'   => $subscription_id,
            'name' => $subscription_name,
            'visible' => $visible,
            'message' => '',
        ]);
        
    }
}
