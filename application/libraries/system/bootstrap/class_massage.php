<?php

class class_massage{

    public static function success($title = null , $massage = null){


        return "'<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\"></button><h4>'+data['$title']+'</h4><strong>'+data['$massage']+'</strong></div>'";

    }

    public static function danger($title = null , $massage = null){


        return "'<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\"></button><h4>'+data['$title']+'</h4><strong>'+data['$massage']+'</strong></div>'";

    }

    public static function warning($title = null , $massage = null){


        return "'<div class=\"alert alert-warning alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\"></button><h4>'+data['$title']+'</h4><strong>'+data['$massage']+'</strong></div>'";

    }

    public static function info($title = null , $massage = null){


        return "'<div class=\"alert alert-info alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\"></button><h4>'+data['$title']+'</h4><strong>'+data['$massage']+'</strong></div>'";

    }

}