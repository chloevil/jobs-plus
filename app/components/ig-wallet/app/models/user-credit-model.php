<?php

/**
 * @author:Hoang Ngo
 */
class User_Credit_Model
{
    public static function update_balance($credit, $user_id = '', $price = '', $append = false)
    {
        if (!is_user_logged_in() || empty($user_id)) {
            return;
        }

        if (empty($user_id)) {
            $user_id = get_current_user_id();
        }

        $balance = self::get_balance($user_id);
        $balance += $credit;
        update_user_meta($user_id, 'je_credits', $balance);
        self::log($credit, $price, 'buy');
    }

    public static function get_balance($user_id = '')
    {
        if (!is_user_logged_in() || empty($user_id)) {
            return;
        }

        if (empty($user_id)) {
            $user_id = get_current_user_id();
        }

        $balance = get_user_meta($user_id, 'je_credits', true);
        if (!$balance) {
            $balance = 0;
        }
        return $balance;
    }

    public static function log($credits, $price, $scenario = 'buy')
    {
        $data = array(
            'credits' => $credits,
            'date' => time(),
            'scenario' => $scenario,
            'price' => $price
        );
        $logs = get_user_meta(get_current_user_id(), 'je_credit_logs', true);
        if (!$logs) {
            $logs = array();
        }
        $logs[] = $data;
        update_user_meta(get_current_user_id(), 'je_credit_logs', $logs);
    }

    public static function get_logs()
    {
        if (!is_user_logged_in()) {
            return false;
        }
        $logs = get_user_meta(get_current_user_id(), 'je_credit_logs', true);
        if (!$logs) {
            $logs = array();
        }
        return $logs;
    }
}