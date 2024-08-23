<?php
include "db/connection.php";
$item_id = $_GET['item_id'];
$price = $_GET['price'];
$user_id = $_GET['user_id'];

$obj = new database();

$data = [
    'item_id' => $item_id,
    'amount' => $price,
    'user_id' => $user_id,
    'created_datetime' => date('Y-m-d H:i:s')
];

if ($sale_id = $obj->insert_data('sales', $data)) {
    $_SESSION['user']['slale']['alert-class']="success";
    $_SESSION['user']['slale']['sale-msg']="Sale recorded successfully!";


    $user_level = $obj->select_column_by_id('level','users', $user_id);

    if ($user_level >= 6) {

        $referrals = $obj->select_all_by_column('users', 'id',$user_id);
        
        echo "<pre>"; print_r($referrals); echo "</pre>"; exit;
        $commission_structure = [
            1 => 10, 
            2 => 5,
            3 => 3,
            4 => 2,
            5 => 1 
        ];

        foreach ($referrals as $referral) {
            $referral_id = $referral['id'];
            $referral_level = $referral['level'];

            if ($referral_level <= 5) {
                $commission = ($price * $commission_structure[$referral_level]) / 100;

                // Insert the payout
                $payout_data = [
                    'user_id' => $referral_id,
                    'amount' => $commission,
                    'sale_id' => $sale_id,
                    'created_datetime' => date('Y-m-d H:i:s')
                ];
                $obj->insert_data('payouts', $payout_data);
                $update_data['commission_paid']=1;
                $where['id']=$sale_id;
                $result = $obj->update_data('sales', $update_data, $where);
            }
        }
        // // Function to fetch referrals up to a certain level
        // function get_referrals_up_to_level($user_id, $max_level, $current_level = 1, $obj) {
        //     $all_referrals = [];

        //     if ($current_level > $max_level) return $all_referrals;

        //     $referrals = $obj->select_all_by_column('users','id', $user_id);
        //     echo "<pre>"; print_r($referrals); echo "</pre>"; exit;
        //     foreach ($referrals as $referral) {
        //         $referral_id = $referral['id'];
        //         $referral_level = $referral['level'];

        //         if ($referral_level <= $max_level) {
        //             $all_referrals[] = $referral;
        //             $all_referrals = array_merge($all_referrals, get_referrals_up_to_level($referral_id, $max_level, $current_level + 1, $obj));
        //         }
        //     }
        //     return $all_referrals;
        // }

        // $referrals = get_referrals_up_to_level($user_id, 5, 1, $obj);
        // echo "<pre>"; print_r($referrals); echo "</pre>"; exit;
        // foreach ($referrals as $referral) {
        //     $referral_id = $referral['id'];
        //     $referral_level = $referral['level'];

        //     if ($referral_level <= 5) {
        //         $commission = ($price * $commission_structure[$referral_level]) / 100;

        //         $payout_data = [
        //             'user_id' => $referral_id,
        //             'amount' => $commission,
        //             'sale_id' => $sale_id,
        //             'created_datetime' => date('Y-m-d H:i:s')
        //         ];
        //         $obj->insert_data('payouts', $payout_data);
        //         $update_data['commission_paid']=1;
        //         $where['id']=$sale_id;
        //         $result = $obj->update_data('sales', $update_data, $where);
        //     }
        // }
    }

    header('location:dashboard.php');
    exit;
} 
?>
