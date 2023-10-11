<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;


class UpdateStock implements ShouldQueue
{
    
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $products;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $products )
    {
       $this->products =  $products;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit(1800); // Set to 30 minutes (30m * 60s)

        $products =  $this->products;

        $tembisa_storeID = 0;
        $bambanani_storeID = 0;

        $stores = DB::table('stores')->get();

        for ($x=0; $x <count($stores) ; $x++){
            $storeName = strtolower($stores[$x]->name);                    
            if (strpos(strtolower($storeName), 'tembisa')  !== false || strpos(strtolower($storeName), 'mega') !== false) {
                $tembisa_storeID = $stores[$x]->storeID;
            }
            if (strpos(strtolower($storeName), 'doc') !== false || strpos(strtolower($storeName), 'bambanani') !== false) {
                $bambanani_storeID = $stores[$x]->storeID;
            } 
        }
 
        for ($i=0; $i < count($products) ; $i++) { 
          
                 DB::table('products')
                    ->where('productID', (int)$products[$i]->productID)   
                    ->limit(1)   
                    ->update([
                        'cost_price' => $products[$i]->cost_price,                                                            
                        'price' => $products[$i]->price,                                                             
                    ]);
   
              // update Tembisa stock
                $tembisa_data = [
                    'quantity' => $products[$i]->tembisa_quantity,
                    'storeID' => $tembisa_storeID,
                    'productID' => $products[$i]->productID,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];            
                DB::table('store_inventories')
                    ->updateOrInsert([
                        'storeID' => $tembisa_storeID,
                        'productID' => (int)$products[$i]->productID],
                        $tembisa_data
                    );

            // update Bambanani stock
            $bambanani_data = [
                'quantity' => $products[$i]->bambanani_quantity,
                'storeID' => $bambanani_storeID,
                'productID' => $products[$i]->productID,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('store_inventories')
                ->updateOrInsert([
                    'storeID' => $bambanani_storeID,
                    'productID' => (int)$products[$i]->productID],
                    $bambanani_data
                );

        } 



    }
}
