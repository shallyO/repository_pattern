<?php


namespace App\Repositories;


use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{

    protected $guarded = [];

    public function all(){
        return Customer::orderBy('name')
            ->where('active', 1)
            ->with('user')
            ->get()
            ->map(function ($customer){
                return $customer->format();
            });
    }

    public function findById($customerId){

        return Customer::where('id',$customerId)
            ->where('active', 1)
            ->with('user')
            ->firstOrfail()
            ->format();

    }

    public function findByUsername(){

    }

    public function update($customerId){
        $customer = Customer::where('id',$customerId)
            ->firstOrfail();

        $customer->update(request()->only('name'));
    }

    protected function format($customer){

    }

}
