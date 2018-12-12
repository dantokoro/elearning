<?php
    function is_multiple_array(array $arr) 
    {
        foreach ($arr as $rows) {
            if(!is_array($rows)) 
                return false;
        }
        return true;
    }

    function check_valid_values($fields, $values) 
    {
        $numFields = count($fields);
        foreach($values as $rows) {
            if(count($rows) != $numFields) {
                return false;
            }
        } 
        return true;
    }

    function round_half_integer(float $float) 
    {
        return floor($float * 2) / 2;
    }

    function upload_image($image) 
    {
        $filename = $image['tmp_name'];
        $client_id = "3d396ef6747fb6b";
        $handle = fopen($filename, "r");
        $data = fread($handle, filesize($filename));
        $pvars   = array(
            'image' => base64_encode($data)
          );
        $timeout = 30;
        
        // khởi tạo tiến trình upload
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
        
        // thực thi tiến trình upload ảnh
        $out = curl_exec($curl);
        curl_close($curl);

        $pms = json_decode($out, true);
        $url = $pms['data']['link'];
        if($url != "") {
            return $url;
        }
        else return false;
    }
?>