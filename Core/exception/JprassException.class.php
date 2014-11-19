<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	JprassException.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
/**
 * 导演异常处理基类
 */
class JprassException extends Exception
{

    public function __construct($message, $code = 500)
    {
        $this->message = $message;
        $this->code = $code;
    }
}
?>
