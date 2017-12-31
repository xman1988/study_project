<?php
//// 1. Одинаковые имена классов?
//class Worker{
//    public static $workerCount = 0;
//
//    function __construct(){
//        ++self::$workerCount;
//    }
//    static function show(){
//        echo self::$workerCount;
//    }
//}
//$obj1 = new Worker();
//$obj1 = new Worker();
//$obj1 = new Worker();
//$obj1 = new Worker();
//$obj1 = new Worker();
//$obj1 = new Worker();
//Worker::show();

// //2. Почему не работает вывод на экран?
//class Worker{
//    public $workerCount = 0;
//
//    function __construct(){
//        ++$this->workerCount;
//    }
//     function show(){
//       $this->workerCount;
//    }
//}
//$obj1 = new Worker();
//$obj1 = new Worker();
//$obj1 = new Worker();
//$obj1 = new Worker();
//$obj1 = new Worker();
//$obj1 = new Worker();
//$obj1->show();