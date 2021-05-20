<?php
/**
 * @author shuxhan <shuxhan@163.com>
 */


interface ServiceInterface
{
    public function __handler($active, $comment, $plugin);

    public function logger($object, $context, $result, $error);
}