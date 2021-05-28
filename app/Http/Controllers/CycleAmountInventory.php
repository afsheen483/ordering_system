<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CycleAmountInventory extends Controller
{
        public function index()
        {
         $cycle_amount_inventory = new DB();
            $cycle_amount_inventory = DB::select("SELECT * FROM (
                SELECT brand_name, model_name, cost, AVG(sold) average, cost * AVG(sold) totalamount FROM (
                SELECT b.brand_name, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, 0 AS stock, COUNT(o.frame_model_id) sold
                FROM frame_models m
                JOIN order_head o ON o.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
                GROUP BY m.model_name , year(o.`date`), month(o.`date`)
                ) S
                GROUP BY brand_name, model_name
                ) X
                ORDER BY totalamount DESC");
                $count_rows = count($cycle_amount_inventory);
               // dd($count_rows);
                return view('CycleInventory.cycle_inventory',compact('cycle_amount_inventory','count_rows'));
        }
}
