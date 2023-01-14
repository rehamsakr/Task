<?php


namespace App\Constant;


class ConstantGeneral
{
    const PAGINATION_ITEMS_COUNT = 15;

    const WITH_TRASHED = 'with';

    const ONLY_TRASHED = 'only';

    const TRASHED = [
        self::WITH_TRASHED,
        self::ONLY_TRASHED,
    ];

}
