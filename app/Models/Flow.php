<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{

    /**
     * 统计单日流量
     * @param $userID
     * @return array
     */
    public function getFlow($userID)
    {
        $flowsLog = [];
        $endDay = null;
        $flows = Flow::where('user_id', $userID)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($flows as $flow) {
            if (is_null($endDay)) {
                $endDay = $flow;
                continue;
            }
            $tmp_flow = clone $flow;
            $flow->flow = $endDay->flow - $flow->flow;
            $flowsLog[] = $flow;
            $endDay = $tmp_flow;
        }
        return $flowsLog;
    }
}
