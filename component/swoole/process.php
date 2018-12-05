<?php
namespace keenly\component\swoole;
use swoole_process;
use keenly\base\Singleton;
use models\User;
use keenly\component\Box;
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2018年8月27日
 * For the full copyright and license information, please view the LICENSE
 */
class process {
    
    use Singleton;
    
    private $process;
    
    public  $works = [];
    
    private $pro = [];
    
    private $index = 0;
    /**
     * @name 添加进程
     * 进程检测和自动回收僵尸进程
     * @param 进程名称 $name
     * @param 唯一标识 $key
     * @param callb $fun
     * @param 执行参数 ...$arg
     * @author brain_yang <qiaopi520@qq.com>
     * @time 2018年10月6日 15:52:04
     * This file is part of keenly from.
     */
    public function addprocess($name,$key,callable $fun,...$arg){
        Box::I()->add($key, $fun,...$arg);
        $this->setName($name);
        $this->process = new \swoole_process(function(swoole_process $worker)use($key){
            $this->pro[$this->index]['obj'] = $worker;
            $this->pro[$this->index]['key'] = $key;
            $this->index++;
            Box::I()->call($key);
        }, true, false);
        return $this;
    }
    
    
    private function setName($name){
        return \swoole_set_process_name($name);
    }
    
    /**
     * @name 开启进程
     * @param 为true表示不要切换当前目录到根目录              $nochdir
     * @param 为true表示不要关闭标准输入输出文件描述符   $noclose
     * @desc 
     * 此函数在1.7.5版本后可用
     * 1.9.1或更高版本修改了默认值，现在默认nochir和noclose均为true
     * 蜕变为守护进程时，该进程的PID将发生变化，可以使用getmypid()来获取当前的PID
     *  
     */
    
    public function start($nochdir = TRUE,$noclose = TRUE){
        //\swoole_process::daemon($nochdir,$noclose);
        $this->works[$this->index] = $this->process->start();
        $this->processWait();
    }
    
    /**
     * 获取Index 
     * 也是表示进程次数;
     * 进程和worke对象属性中
     * $this->pro[$this->getIndex()]['obj']->exec() 执行进程 或者 进程写 write(string $data) or read();
     *  or $this->works;
     * @author brain_yang <qiaopi520@qq.com>
     * @return number
     */
    public function getIndex(){
        return $this->index;
    }
    
    
    public function processWait(){
        while(1) {
            if(count($this->works)){
                $ret = \swoole_process::wait();
                var_dump($this->works);
                sleep(1);
                if ($ret) {
                    $this->rebootProcess($ret);
                }
            }else{
                break;
            }
        }
    }
    
    
    
    public function rebootProcess($ret){
        $pid = $ret['pid'];
        var_dump($this->works);
        $index = array_search($pid, $this->works);
        if($index !== false){
            $index = intval($index);
            $new_pid = $this->CreateProcess($index);
            return;
        }
        throw new \Exception('rebootProcess Error: no pid');
    }
    
    
    
    public function CreateProcess($index = null){
        $process = new \swoole_process(function(swoole_process $worker)use($index){
            if(is_null($index)){
                $index = $this->index;
                $this->index++;
            }
            \swoole_set_process_name(sprintf('keenly:%s',$index));
            var_dump($this->pro);
            if(isset($this->pro[$index])){
                Box::I()->call($this->pro[$index]['key']);
            }
        }, false, false);
        $pid = $process->start();
        $this->works[$index] = $pid;
        return $pid;
    }
  
    
    /**
     * $pid 进程ID
     * 默认的信号为SIGTERM，表示终止进程
     * $signo=0，可以检测进程是否存在，不会发送信号
     */
    public static function kill($pid, $signo = SIGTERM){
        return parent::kill($pid, $signo);
   }
    
  
}
    
    
    
    
