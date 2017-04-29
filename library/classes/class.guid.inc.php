<?php
/**
 * Class guid
 * @package backend
 *
 * @see http://guid.us/GUID/PHP
 */
class guid
{
    public function NewGuid()
    {
        /**
         * Optional for php 4.2.0 and up.
         */
        mt_srand((double)microtime()*10000);

        $characters = strtoupper(md5(uniqid(rand(), true).date("HisYmd")));

        $uuid = implode("-", array(
            substr($characters,  0,  8),
            substr($characters,  8,  4),
            substr($characters, 12,  4),
            substr($characters, 16,  4),
            substr($characters, 20, 12)
        ));

        return $uuid;
    }
}
