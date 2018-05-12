<?php

namespace App\Modules\Core\Helpers;

/**
 * @author Yuana <andhikayuana@gmail.com>
 * @since Sun, 31 Dec 2017
 */

class ErrorCode
{
    /**
     * Token
     */
    const TOKEN_EXPIRED = 1000;
    const TOKEN_INVALID = 1001;
    const TOKEN_BLACKLISTED = 1002;
    const TOKEN_NOT_PROVIDED = 1003;

    /**
     * Privilege
     */
    const PRIVILEGE_ACTION_UNAUTHORIZED = 2000;
}
