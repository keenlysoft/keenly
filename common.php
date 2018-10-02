<?php
namespace keenly;

trait common
{
    
    
    public static  $funMet = [
        'logs' =>'debuglogs'
    ];
    
    
    public static  function __callstatic($obj,$fun){
        $isObj = self::$funMet[$obj];
        self::$isObj($fun);
    }
    
    
    
    
    static function logs($arg, $logName = 'debug')
    {
        $url  ='../logs/' . $logName . '.log.' . date('Ymd');
        $fp = fopen($url, 'a');
        $traces = debug_backtrace();
        $logMsg = 'FILE:' . basename($traces[0]['file']) . PHP_EOL;
        $logMsg .= 'FUNC:' . $traces[1]['function'] . PHP_EOL;
        $logMsg .= 'LINE:' . $traces[0]['line'] . PHP_EOL;
        if (is_string($arg)) {
            $logMsg .= 'ARGS:' . $arg . PHP_EOL;
        } else {
            $logMsg .= 'ARGS:' . var_export($arg, true) . PHP_EOL;
        }
        $logMsg .= 'DATETIME:' . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL;
        fwrite($fp, $logMsg);
        fclose($fp);
    }
    
    
    
    public static function lectionClass($class,$classargs = null){
        $class = new \ReflectionClass($class);
        $args = empty($classargs)?$class->newInstanceArgs():$class->newInstanceArgs([$classargs]);
        return $args;
    }
    
    
    
    
    //Openssl Encryption
    public static function OpensslEncryption($plaintext,$key){    
        $ivlen = openssl_cipher_iv_length($cipher="BF-CBC");//openssl_get_cipher_methods ()
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        return  base64_encode($iv.$hmac.$ciphertext_raw);
    }
    
    
    //openssl decrypt
    public static function OpensslDecrypt($ciphertext,$key){
        $c = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher="BF-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        if (hash_equals($hmac, $calcmac))//PHP 5.6+
        {
            return $original_plaintext;
        }
    }
    
    
    
    /**
     * session decrypt AES 256
     *
     * @param data $edata
     * @param string $password
     * @return decrypted data
     */
    function decrypt($data, $password) {
        $data = base64_decode($data);
        $salt = substr($data, 0, 16);
        $ct = substr($data, 16);
        $rounds = 3; // depends on key length
        $data00 = $password.$salt;
        $hash = array();
        $hash[0] = hash('sha256', $data00, true);
        $result = $hash[0];
        for ($i = 1; $i < $rounds; $i++) {
            $hash[$i] = hash('sha256', $hash[$i - 1].$data00, true);
            $result .= $hash[$i];
        }
        $key = substr($result, 0, 32);
        $iv  = substr($result, 32,16);
    
        return openssl_decrypt($ct, 'AES-256-CBC', $key, true, $iv);
    }
    
    /**
     * session crypt AES 256
     *
     * @param data $data
     * @param string $password
     * @return base64 encrypted data
     */
    function encrypt($data, $password) {
        // Set a random salt
        $salt = openssl_random_pseudo_bytes(16);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = hash('sha256', $dx.$password.$salt, true);
            $salted .= $dx;
        }
    
        $key = substr($salted, 0, 32);
        $iv  = substr($salted, 32,16);
    
        $encrypted_data = openssl_encrypt($data, 'AES-256-CBC', $key, true, $iv);
        return base64_encode($salt . $encrypted_data);
    }
    
    
    
    
}

?>