<?php
class redisDB extends Redis {
 
    private $hostRedis = '127.0.0.1';
    private $port = 6379;
    private $ttl = 604800; /* time to live = 1 minggu */
    private $db = 1; /* db redis */
 
    /* Koneksi ke redis */
 
    public function openRedis() {
        $this->connect($this->hostRedis, $this->port);
        try {
            $pingRedis = $this->ping();
        } catch (Throwable $e) {
            $e->getMessage();
        }
 
        if (isset($e)) {
            return false;
        } else {
            return true;
        }
    }
 
    /* tutup koneksi */
 
    public function closeRedis() {
        $this->close();
    }
 
    /* mencari key redis */
 
    public function FindRedis($keyredis) {
        try {
            $check = $this->openRedis();
            if ($check != false) {
                $this->SELECT($this->db);
                $resultRedis = $this->keys($keyredis);
                $this->closeRedis();
            }
 
            return $resultRedis;
        } catch (Throwable $e) {
            $e->getMessage();
        }
    }
 
    /* mendapatkan value dari redis key */
 
    public function GetDatafromKeys($keyredis) {
        $findRedis = $this->FindRedis($keyredis);
        if (count($findRedis) > 0) {
            $this->openRedis();
            $this->SELECT($this->db);
            $arrData = $this->get($keyredis);
            $this->closeRedis();
        } else {
            $arrData = null;
        }
        return $arrData;
    }
 
    /* menyimpan value ke redis */
 
    public function InsertDataToKey($keyredis, $value) {
        try {
            $check = $this->openRedis();
            if ($check != false) {
                $this->SELECT($this->db);
                $this->setex($keyredis, $this->ttl, $value);
                $this->closeRedis();
                return true;
            } else {
                return false;
            }
        } catch (Throwable $e) {
            throw $e;
            return false;
        }
    }
 
    /* menghapus value redis */
 
    public function RemoveRedis($keyredis) {
        try {
            $check = $this->openRedis();
            if ($check != false) {
                $this->SELECT($this->db);
                $this->del($keyredis);
                $this->closeRedis();
                $message = "success";
            }
        } catch (Throwable $e) {
            throw $e;
        }
 
        return $message;
    }
 
}