<?php

namespace App\Traits;

trait HasAccountNumber
{

    /**
     * Has order number
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (
                !$model->account_nr // null value
            ) {
                $orderNrRule = 5;
                if ($max = $model->whereNotNull('account_nr')->orderBy('account_nr', 'DESC')
                    ->latest('account_nr')->skip(0)->value('account_nr')) {
                    $model->account_nr = preg_replace_callback('/(\d+)$/', function ($matches) use ($orderNrRule) {
                        return str_pad($matches[1] + 1, $orderNrRule, "0", STR_PAD_RIGHT);
                    }, $max);
                } else {
                    $model->account_nr = str_pad(1, $orderNrRule, "0", STR_PAD_RIGHT);
                }
            }
        });

    }
}
