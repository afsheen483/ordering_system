<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrameModel;
use DB;
class InventoryReport extends Controller
{
    public function index($filters)
    {
        $inventory_reports = new FrameModel();
        if ($filters == 'all') {
           $inventory_reports = DB::select('SELECT manufacturer_name,collection,brand_name, model_name, cost, sell_price, is_active, is_stocked_item, sum(stock) as stock, sum(sold) as sold FROM (

            SELECT man.manufacturer_name, b.brand_name,b.collection, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, SUM(CASE fo.status_id WHEN 2 THEN fo.quantity ELSE 0 END) AS stock, 0 AS sold
            FROM frame_models m
            LEFT JOIN frame_order fo ON fo.frame_model_id = m.id
            JOIN frame_brands b ON b.id = m.brand_id
    		JOIN manufacturer man ON man.id = b.manufacturer_id
            GROUP BY m.model_name
            
            UNION ALL
            SELECT man.manufacturer_name,b.brand_name,b.collection, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, SUM(CASE ia.adjustment_type_id WHEN 2 THEN ia.qty WHEN 1 THEN -ia.qty ELSE 0 END) AS stock, 0 AS sold
            FROM frame_models m
            LEFT JOIN inventory_adjustment ia ON ia.frame_model_id = m.id
            JOIN frame_brands b ON b.id = m.brand_id
    		JOIN manufacturer man ON man.id = b.manufacturer_id
            GROUP BY m.model_name
            
            UNION ALL
            SELECT man.manufacturer_name,b.brand_name, b.collection,m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, 0 AS stock, COUNT(o.frame_model_id) sold
            FROM frame_models m
            LEFT JOIN order_head o ON o.frame_model_id = m.id
            JOIN frame_brands b ON b.id = m.brand_id
    		JOIN manufacturer man ON man.id = b.manufacturer_id
            GROUP BY m.model_name
            ) s
            GROUP BY model_name');
        }
        elseif($filters == 'stocked_items'){
            $inventory_reports = DB::select('SELECT manufacturer_name,collection,brand_name, model_name, cost, sell_price, is_active, is_stocked_item, sum(stock) as stock, sum(sold) as sold FROM (

                SELECT man.manufacturer_name, b.brand_name,b.collection, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, SUM(CASE fo.status_id WHEN 2 THEN fo.quantity ELSE 0 END) AS stock, 0 AS sold
                FROM frame_models m
                LEFT JOIN frame_order fo ON fo.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
                JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name
                
                UNION ALL
                SELECT man.manufacturer_name,b.brand_name,b.collection, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, SUM(CASE ia.adjustment_type_id WHEN 2 THEN ia.qty WHEN 1 THEN -ia.qty ELSE 0 END) AS stock, 0 AS sold
                FROM frame_models m
                LEFT JOIN inventory_adjustment ia ON ia.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
                JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name
                
                UNION ALL
                SELECT man.manufacturer_name,b.brand_name, b.collection,m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, 0 AS stock, COUNT(o.frame_model_id) sold
                FROM frame_models m
                LEFT JOIN order_head o ON o.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
                JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name
                ) s
               
                WHERE is_stocked_item = 1  GROUP BY model_name');
        }
        elseif($filters == 'non_stocked_items'){
            $inventory_reports = DB::select('SELECT manufacturer_name,collection,brand_name, model_name, cost, sell_price, is_active, is_stocked_item, sum(stock) as stock, sum(sold) as sold FROM (

                SELECT man.manufacturer_name, b.brand_name,b.collection, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, SUM(CASE fo.status_id WHEN 2 THEN fo.quantity ELSE 0 END) AS stock, 0 AS sold
                FROM frame_models m
                LEFT JOIN frame_order fo ON fo.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
                JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name
                
                UNION ALL
                SELECT man.manufacturer_name,b.brand_name,b.collection, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, SUM(CASE ia.adjustment_type_id WHEN 2 THEN ia.qty WHEN 1 THEN -ia.qty ELSE 0 END) AS stock, 0 AS sold
                FROM frame_models m
                LEFT JOIN inventory_adjustment ia ON ia.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
                JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name
                
                UNION ALL
                SELECT man.manufacturer_name,b.brand_name, b.collection,m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, 0 AS stock, COUNT(o.frame_model_id) sold
                FROM frame_models m
                LEFT JOIN order_head o ON o.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
                JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name
                ) s
               
                WHERE is_stocked_item = 0  GROUP BY model_name' );
        }
        return view('InventoryReport.index',compact('inventory_reports'));

    }
    
    public function create(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        //dd($end_date);
        
        // $inventory_reports = DB::select('SELECT * FROM (
        //     SELECT b.brand_name, o.date, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, 0 AS stock, COUNT(o.frame_model_id) sold
        //     FROM frame_models m
        //     LEFT JOIN order_head o ON o.frame_model_id = m.id
        //     JOIN frame_brands b ON b.id = m.brand_id
        //     GROUP BY m.model_name
        //     ) sold
        //     WHERE date >= '.$start_date.' AND date<= '.$end_date.'');
            
            $inventory_reports = DB::select("SELECT manufacturer_name,collection,brand_name, model_name, cost, sell_price, is_active, is_stocked_item, sum(stock) as stock, sum(sold) as sold, sum(min) min, sum(max) max FROM (

                SELECT man.manufacturer_name,b.collection, b.brand_name, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, SUM(CASE fo.status_id WHEN 2 THEN fo.quantity ELSE 0 END) AS stock, 0 AS sold, 0 as min, 0 as max
                FROM frame_models m
                LEFT JOIN frame_order fo ON fo.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
    			JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name
                
                UNION ALL
                SELECT man.manufacturer_name,b.collection, b.brand_name, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, SUM(CASE ia.adjustment_type_id WHEN 2 THEN ia.qty WHEN 1 THEN -ia.qty ELSE 0 END) AS stock, 0 AS sold, 0 as min, 0 as max
                FROM frame_models m
                LEFT JOIN inventory_adjustment ia ON ia.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
    			JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name
                
                UNION ALL
                SELECT man.manufacturer_name,b.collection, b.brand_name, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, 0 AS stock, COUNT(o.frame_model_id) sold, 0 as min, 0 as max
                FROM frame_models m
                LEFT JOIN order_head o ON o.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
    			JOIN manufacturer man ON man.id = b.manufacturer_id		
                GROUP BY m.model_name
                
                UNION ALL
                SELECT manufacturer_name,collection, brand_name, model_name,cost,sell_price,is_active,is_stocked_item, stock, sold, min, 0 AS max FROM (
                SELECT manufacturer_name,collection,brand_name,date,model_name,cost,sell_price,is_active,is_stocked_item, stock,sold, MIN(sold) min FROM (
                SELECT man.manufacturer_name,b.collection, b.brand_name, o.date, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, 0 AS stock, COUNT(o.frame_model_id) sold
                FROM frame_models m
                LEFT JOIN order_head o ON o.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
                    JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name , year(o.date),month(o.date)
                ) sold
                WHERE date >= '".$start_date."' AND date <= '".$end_date."'
                GROUP by model_name) b
                
                UNION ALL
                SELECT manufacturer_name,collection, brand_name, model_name,cost,sell_price,is_active,is_stocked_item, stock,sold,0 AS min, max FROM (
                SELECT manufacturer_name,collection,brand_name,date,model_name,cost,sell_price,is_active,is_stocked_item, stock,sold,MAX(sold) max FROM (
                SELECT man.manufacturer_name,b.collection, b.brand_name, o.date, m.model_name, m.cost, m.sell_price, is_active, m.is_stocked_item, 0 AS stock, COUNT(o.frame_model_id) sold
                FROM frame_models m
                LEFT JOIN order_head o ON o.frame_model_id = m.id
                JOIN frame_brands b ON b.id = m.brand_id
                 JOIN manufacturer man ON man.id = b.manufacturer_id
                GROUP BY m.model_name , year(o.`date`),month(o.`date`)
                ) sold
                WHERE date >= '".$start_date."' AND date <= '".$end_date."'
                GROUP by model_name) b
                
                ) s
                GROUP BY model_name");
              
            
             return view('InventoryReport.index',compact('inventory_reports'));
        
    }
}
