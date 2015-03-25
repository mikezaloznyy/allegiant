<?php

class Customer extends \Eloquent {
    protected $fillable = [];
    
    protected $hidden = ['created_at', 'updated_at'];
    
    public static $rules = array(
        'first_name'    => array('required', 'string'),
        'last_name'    => array('required', 'string'),
        'ip'    => array('required', 'ip'),
        'latitude'    => array('required', 'numeric'),
        'longitude'    => array('required', 'numeric'),
        'email'    => array('required', 'email', 'unique:customers,email')
    );
    
    public static $update_rules = array(
        'first_name'    => array('required', 'string'),
        'last_name'    => array('required', 'string'),
        'ip'    => array('required', 'ip'),
        'latitude'    => array('required', 'numeric'),
        'longitude'    => array('required', 'numeric'),
        'email'    => array('required', 'email')
    );
}