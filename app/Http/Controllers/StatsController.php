<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Auth;
use DB;
use App\Site;
use App\Zone;
use App\Browser;
use App\Platform;
use App\OperatingSystem;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getIndex()
    {

    }
    /**
     * @author Cary White
     * @returns View
     * @access public
     * returns stats view by site and range
     */
    public function getSiteStats($site_id, $range)
    {
        try{
           $user = Auth::getUser();
           $site = Site::where('id', $site_id)->first();
           if(!$user->is_admin){
               if(!$site->user_id == $user->id){
                   return false;
               }
           } 
           $zone_count = Zone::where('site_id', $site_id)->count();

            switch($range){
                case 1:
                    $start_date = date('Y-m-d', strtotime('-1 week'));
                    $range_desc = "Past Week";
                    break;
                case 2:
                    $start_date = date('Y-m-d', strtotime('-30 days'));
                    $range_desc = "Past 30 Days";
                    break;
                case 3:
                    $start_date = date('Y-m-d', strtotime('first day of this month'));
                    $range_desc = "Month to Date";
                    break;
                case 4:
                    $start_date = date('Y-m-d', strtotime('first day of this year'));
                    $range_desc = "Year to Date";
                    break;

            }
           $query = "SELECT * 
                     FROM stats
                     WHERE site_id = $site_id
                     AND `stat_date` BETWEEN '$start_date' AND '".date('Y-m-d')."'";
           $result = DB::select($query);
               $browsers = Browser::all();
               $platforms = Platform::all();
               $operating_systems = OperatingSystem::all();
               $sitedata = array();
               $zones = array();
               $big = array();
               $imps = 0;
               $clicks = 0;
            if(sizeof($result)){
               foreach($result as $row){
                  if(isset($sitedata[$row->stat_date][$row->country_id]['impressions'])){
                      $sitedata[$row->stat_date][$row->country_id]['impressions'] += $row->impressions;
                  }else{
                      $sitedata[$row->stat_date][$row->country_id]['impressions'] = $row->impressions;
                  }
                  if(isset($sitedata[$row->stat_date][$row->country_id]['clicks'])){
                      $sitedata[$row->stat_date][$row->country_id]['clicks'] += $row->clicks;
                  }else{
                      $sitedata[$row->stat_date][$row->country_id]['clicks'] = $row->clicks;
                  }
                  $clicks += $row->clicks;
                  $imps += $row->impressions;
                  if(isset($big['browsers'][$row->browser])){
                      $big['browsers'][$row->browser] += $row->impressions;
                  }else{
                      $big['browsers'][$row->browser] = $row->impressions;
                  }
                  if(isset($big['platforms'][$row->platform])){
                      $big['platforms'][$row->platform] += $row->impressions;
                  }else{
                      $big['platforms'][$row->platform] = $row->impressions;
                  }
                  if(isset($big['os'][$row->os])){
                      $big['os'][$row->os] += $row->impressions;
                  }else{
                      $big['os'][$row->os] = $row->impressions;
                  }
               }
             }
               return view('stats',['site' => $site, 'big' => $big, 'range' => $range_desc, 'zone_count' => $zone_count, 'browsers' => $browsers, 'platforms' => $platforms, 'operating_systems' => $operating_systems, 'sitedata' => $sitedata, 'zones' => $zones, 'imps' => $imps, 'clicks' => $clicks]);
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }
    /**
     * @author Cary White
     * @returns View
     * @access public
     * return data by zone id
     */
    public function getZoneStats($zone_id, $range)
    {
        try{
            $start_date = $this->getRange($range);

        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }
}