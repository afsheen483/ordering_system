<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrameModel;
use App\Models\FrameOrderModel;
use DB;
use App\Models\InventoryAdjustmentModel;


class StockItem extends Controller
{
    public function index($id)
    {
        $frame = FrameModel::where('id','=',$id)->first();
        $available_stock = DB::select("SELECT IFNULL(SUM(stock),0) as avl_stock FROM ( 
    
            SELECT CASE adjustment_type_id WHEN 1 THEN  -SUM(qty) WHEN 2 THEN SUM(qty) END as stock FROM inventory_adjustment WHERE frame_model_id = '".$id."' GROUP BY adjustment_type_id
    
    		
            UNION ALL 
    
            SELECT SUM(quantity) AS stock FROM frame_order WHERE frame_model_id = '".$id."' AND status_id = 2 
			
    		  UNION ALL
            	SELECT -COUNT(id) AS stock FROM order_head WHERE frame_model_id = '".$id."' AND order_status = 'Received'
			) AS s
            
          
            ");
        $order_status = "PICK FROM STOCK";
        if($available_stock[0]->avl_stock == 0){
            $order_status = "NEED TO ORDER";
        }
       
        if($frame->is_stocked_item == 1)
        {
            // $recieved_count = FrameOrderModel::selectRaw("SUM(quantity) as stock")->groupBy('frame_model_id')->where('frame_model_id','=',$id)->get();
            // $adjustment_count = InventoryAdjustmentModel::selectRaw("CASE adjustment_type_id WHEN 1 THEN  -SUM(qty) WHEN 2 THEN SUM(qty) END as stock")->where('frame_model_id','=',$id)->groupBy('frame_model_id','adjustment_type_id')->get();
            // $union_query = $recieved_count->union($adjustment_count)->select("SUM(stock) as stock")->pluck('stock');
            // dd($union_query);
            return response()->json(['INV: '.$available_stock[0]->avl_stock ,  'Stocked Item!  '.$order_status ]);
           // echo "&nbsp;&nbsp;&nbsp;&nbsp;";
           // echo '';
        }
        elseif($frame->is_stocked_item == 0)
        {
            $recieved_count = FrameModel::count();
            return response()->json(['INV: '.$available_stock[0]->avl_stock ,  'Non Stocked Item!  '.$order_status ]);
            // echo 'INV:'.' '.$count;
            // echo "&nbsp;&nbsp;&nbsp;&nbsp;";
            // echo '';
        }
        
    }
}
