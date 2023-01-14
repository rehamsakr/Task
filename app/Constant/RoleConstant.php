<?php


namespace App\Constant;


class RoleConstant
{
    const ADMIN_ROLE = 'admin';
    const USER_ROLE = 'user';

    const ALL_ROLES = [
        self::ADMIN_ROLE,
        self::USER_ROLE,
    ];

    const ROLE_ID = [
        self::ADMIN_ROLE => 1,
        self::USER_ROLE => 2,
    ];
}
