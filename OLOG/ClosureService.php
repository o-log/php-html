<?php
declare(strict_types=1);

/**
 * @author Oleg Loginov <olognv@gmail.com>
 */

namespace OLOG;

class ClosureService
{
    public static function is_closure($t) {
        return is_object($t) && ($t instanceof \Closure);
    }
}
