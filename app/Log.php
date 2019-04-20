<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    /**
     * Valid "type" column
     *
     * Type Reference:
     *      admin           - By user role admin
     *      business_owner  - By user role business_owner
     *      employee        - By user role employee
     *      customer        - registered users
     *      public          - unregistered users
     *      system          - logs generated by the system
     *      generic         - generic logs
     */
    const TYPE_ADMIN = "admin";
    const TYPE_BUSINESS_OWNER = "business_owner";
    const TYPE_EMPLOYEE = "employee";
    const TYPE_CUSTOMER = "customer";
    const TYPE_PUBLIC = "public";
    const TYPE_SYSTEM = "system";
    const TYPE_GENERIC = "generic";


    /**
     * Insert a log
     *
     * @param string $message Actual message from calling function
     * @param string $ipAddress IP Address
     * @param string $type One of valid types on constants
     * @param array $logParams Saved as json - string of any other log meta data
     * @param User|null $user User id of caller
     *
     * @return bool
     *
     * @throws \InvalidArgumentException
     * @throws \ErrorException Thrown On failure in saving the database entry
     *
     */
    public static function insertLog(string $message, string $ipAddress, string $type, array $logParams = [], User $user = null): bool
    {

        if (!in_array($type, [
            self::TYPE_ADMIN,
            self::TYPE_BUSINESS_OWNER,
            self::TYPE_EMPLOYEE,
            self::TYPE_CUSTOMER,
            self::TYPE_PUBLIC,
            self::TYPE_SYSTEM,
            self::TYPE_GENERIC
        ])) {
            throw new \InvalidArgumentException("Invalid Type passed: $type ");
        }

        if (!empty($user) && !isset($user->id)) {
            throw new \InvalidArgumentException("Invalid User passed");
        }

        if (empty($logParams)) {
            /**
             * Just save the log params as null if
             * an empty array is passed - To save space :)
             */
            $logParams = null;
        }

        /**
         * Validation passed save the log
         */
        $log = new self();

        $log->user_id = $user->id ?? null; // if user id is empty store just null
        $log->type = $type;
        $log->ip = $ipAddress;
        $log->message = $message;
        $log->log_params = json_encode($logParams);


        if (!$log->save()) {
            throw new \ErrorException("There was an error in saving the log entry");
        }

        return true;


    }

}
