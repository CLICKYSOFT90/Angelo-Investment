<?php


function getUserWallet($user_id)
{
    $user_wallet = \App\Models\UserWallets::whereuser_id($user_id)->first();
    return $user_wallet->amount;
}

function getUserDeposits($user_id)
{
    $user_wallet = \App\Models\Transaction::where(['user_id' => $user_id, 'type' => 'deposit'])->sum('amount');
    return $user_wallet;
}

function getUserWithdrawls($user_id)
{
    $user_wallet = \App\Models\Transaction::where(['user_id' => $user_id, 'type' => 'withdrawal', 'status' => 1])->sum('amount');
    return $user_wallet;
}

function getUserInvestments($user_id)
{
    $user_wallet = \App\Models\Transaction::where(['user_id' => $user_id, 'type' => 'investment', 'status' => 1])->sum('amount');
    return $user_wallet;
}

function getUserProfit($user_id)
{
    $user_wallet = \App\Models\Transaction::where(['user_id' => $user_id, 'type' => 'disbursement/profit', 'status' => 1])->sum('amount');
    return $user_wallet;
}
