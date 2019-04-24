<?php
/**
 * This file is part of keenly from.
 * @author brain_yang<qiaopi520@qq.com>
 * (c) brain_yang
 * github: https://github.com/keenlysoft/
 * @time 2019年3月25日 20:54:42
 * For the full copyright and license information, please view the LICENSE
 */
namespace keenly\base;

use keenly\session\session;

class security{
    
    protected $session;
    
    protected $fontsize = 6;
    
    protected $number = 5;
    
    protected $captcha_code;
    
    public $image;
    
    public function __construct()
    {
        $this->session =  new session();
    }
    
    private function createImage(){
        $this->image = imagecreate(120, 40);
        return $this;
    }
    
    /**
     * @name 设置数字
     * 
     */
    private function createCode()
    {
        $fontsize = 140;
        for($i=0;$i < $this->number;$i++){
            //设置字体大小  
            //设置字体颜色，随机颜色
            $fontcolor = imagecolorallocate($this->image, rand(0,120),rand(0,120), rand(0,120));      //0-120深颜色
            //设置数字
            $fontcontent = $this->createNumber();
            //10>.=连续定义变量
            $this->captcha_code .= $fontcontent;
            //设置坐标
            $x = ($i*100/4)+rand(5,10);
            $y = rand(5,10);
            imagestring($this->image,$fontsize,$x,$y,$fontcontent,$fontcolor);
        }
        $this->setSession()->disturb();
    }
    
    /**
     * @name 生成数字保留Session
     * @author brain_yang
     * @time 2019年3月25日 21:08:18
     * 
     */
    private function setSession()
    {
        
        $this->session['authcode'] = $this->captcha_code;
        return $this;
    }
    
    /**
     * @name 设置数字或者字母
     * @author brain_yang 
     * @todo 增加字母
     * @return number
     */
    private function createNumber()
    {
        return rand(0,9);
        
    }
    
    /**
     * @name 扰乱正常字符串
     * @author brain_yang
     * @time 2019年3月25日 21:44:18
     * @desc 对验证码渲染干扰像素
     */
    private function disturb()
    {
       
        for($i=0;$i < $this->number;$i++)
        {
            //设置线的颜色
            $linecolor = imagecolorallocate($this->image,rand(80,220), rand(80,220),rand(80,220));
            //设置线，两点一线
            imageline($this->image,rand(10,99), rand(10,29),rand(10,99), rand(10,29),$linecolor);
        }
    }
    
    
    public function image()
    {
        // 建立一幅 100X30 的图像
        $im = imagecreate(200, 300);
        
        // 白色背景和蓝色文本
        $bg = imagecolorallocate($im, 255, 255, 255);
        $textcolor = imagecolorallocate($im, 0, 0, 255);
        
        // 把字符串写在图像左上角
        imagestring($im, 40, 30, 150, "Hello world!", $textcolor);
        
        // 输出图像
        header("Content-type: image/png");
        imagepng($im);
        exit;
        header('Content-Type: image/png');
        $this->createImage()->createCode();
        imagepng($this->image);
        imagedestroy($this->image);
        $this->image;
    }
    
    
}

