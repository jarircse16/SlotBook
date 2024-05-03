<?php

if (! function_exists('flash')) {
    /**
     * Create a flash message.
     *
     * @param  string  $message  The message content.
     * @param  string  $type  The type of message ('info', 'success', 'error').
     * @return void
     */
    function flash($message, $type = 'info')
    {
        session()->flash('flash_message', $message);
        session()->flash('flash_message_type', $type);
    }
}
