<?php
/**
 * Network
 */

/** 仅可以在命令行下运行 */
if(substr(php_sapi_name(),0 , 3) != 'cli')
{
    exit("该工具仅可在命令行下运行!");
}
$pid = posix_getpid();
$user = posix_getlogin();

//while (true) {
//
//    $prompt = "\n{$user}$ ";
////    $input  = readline($prompt);
//
////    readline_add_history($input);
////    if ($input == 'quit') {
////        break;
////    }
//
//    $input = function (){
//        for ($i=0;$i<100;$i++)
//        {
//            echo $i;
//            sleep(0.1);
//        }
//    };
//
//    process_execute($input);
//    process_execute($input);
//}
$input = function (){
    for ($i=0;$i<100;$i++)
    {
        echo $i;
//        sleep(0.1);
    }
};
echo 'start';
process_execute($input);
echo '1';
process_execute($input);
echo '2';


exit(0);

function process_execute($input) {
    $pid = pcntl_fork(); //创建子进程
    if ($pid == 0) {//子进程
        $pid = posix_getpid();
        echo "* 进程{$pid}被创建\n\n";
        $input();
    }
    else
    {//主进程
        $pid = pcntl_wait($status, WUNTRACED); //取得子进程结束状态
        if (pcntl_wifexited($status))
        {
            echo "\n\n*子进程: {$pid}with {$status}";
        }
    }
}
