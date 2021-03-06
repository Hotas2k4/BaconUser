<?php
/**
 * BaconUser
 *
 * @link      http://github.com/Bacon/BaconUser For the canonical source repository
 * @copyright 2013 Ben Scholzen 'DASPRiD'
 * @license   http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace BaconUser\Options;

interface UserServiceOptionsInterface
{
    /**
     * @return string
     */
    public function getUserEntityClass();

    /**
     * @param  string $userEntityClass
     * @return UserServiceOptionsInterface
     */
    public function setUserEntityClass($userEntityClass);
}
