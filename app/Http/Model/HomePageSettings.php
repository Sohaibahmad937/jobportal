<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class HomePageSettings extends Model
{
    protected $table = 'home_page_settings';
    protected $fillable = [
        'banner_1',
        'banner_2',
        'banner_3',
        'banner_4',
        'banner_1_link',
        'banner_2_link',
        'banner_3_link',
        'banner_4_link',
        'home_bottom_categories',
        'home_content',
        'shipping_charge',
        'referenced_person_reward_points',
        'using_person_reward_points',
        'minimum_qty_product'
    ];


    public function ReferalCodeRewardPoints($id,$referal_code){
        $id_obj = DB::table('front_users')->where('referal_code',$referal_code)->select('id')->first();
        $GetPointObj = HomePageSettings::first();
        $RewardPointsHistory = new RewardPointsHistory();

        if($GetPointObj->referenced_person_reward_points != ''){
            RewardPointsHistory::create([
                'user_id' =>$id_obj->id,
                'type' => 'Plus',
                'points' => $GetPointObj->referenced_person_reward_points,
                'notes' => 'Points Added against using referal code #'.$referal_code
            ]);
            $RewardPointsHistory->UpdateTotalUserRewardpoints($id_obj->id);
        }

        if($GetPointObj->using_person_reward_points != ''){
            RewardPointsHistory::create([
                'user_id' =>$id,
                'type' => 'Plus',
                'points' => $GetPointObj->using_person_reward_points,
                'notes' => 'Points Added against using referal code #'.$referal_code
            ]);
            $RewardPointsHistory->UpdateTotalUserRewardpoints($id);
        }
    }

    
}
