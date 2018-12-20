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
    function course_list($courses) 
    {
        $output = "";
        $count = 0;
        if(is_array($courses)) {
            foreach($courses as $row) {
                if($count == 0) {
                    $output .= $row['course_id']; 
                    $count++;
                } else {
                    $output .= "," . $row['course_id'];
                }
            }
        } else {
            $output .= $courses[0];
        }
        return $output;
    } 

    function format_info($info)
    {
        $formated_info = array();
        
        if(is_array($info) || is_object($info)) {
            foreach($info as $row) {
                $num = $row['course_id'];
                $formated_info[$num] = $row;
            }
        }

        return $formated_info;
    }

    function all_course_printer($conn, $teacher_id) 
    {
        // get infomation about courses
        // get all courses
        $query = 'SELECT * FROM "Course" WHERE course_id IN (SELECT course_id FROM "AssignTeacher" WHERE teacher_id =' . "$teacher_id)";
        $result = pg_query($conn, $query);
        $courses = pg_fetch_all($result);
        
        // // get all courses info
        $query = 'SELECT * FROM "Course" WHERE course_id IN ('. course_list($courses) . ')';
        $result = pg_query($conn, $query);
        $info = pg_fetch_all($result);  
        $courses_info = format_info($info);

        // // get all courses rating
        $query = 'SELECT course_id, AVG(rate), count(rate) FROM "Vote" GROUP BY course_id HAVING course_id IN (' .course_list($courses) . ')';
        $info = pg_fetch_all(pg_query($conn, $query));
        $courses_rating = format_info($info);

        //if(!empty($courses_rating[1])) print_r($courses_rating[1]);

        // begin to print
        foreach($courses_info as $key => $value) {
            
            echo '<!-- .col -->
             <div class="course-content flex flex-wrap justify-content-between align-content-lg-stretch">
                 <figure class="course-thumbnail">
                     <a href="#"><img src='. $value['avatar'] .' alt=""></a>
                 </figure>
                 <!-- .course-thumbnail -->
                <div class="course-content-wrap">
                    <header class="entry-header"> 
                        <div class="course-ratings flex align-items-center">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="course-ratings-count">(3 votes)</span>
                        </div>
                        <!-- .course-ratings -->
                        <h2 class="entry-title"><a href="#">'.$value['name'].'</a></h2>
                        <div class="entry-meta flex flex-wrap align-items-center">
                        <div class="course-author"><a href="#"></a></div>
                        <div class="course-date">Aug 21, 2018</div>
                        </div>
                        <!-- .course-date -->
                    </header>
                    <!-- .entry-header -->
                    <footer class="entry-footer flex justify-content-between align-items-center">
                        <div class="course-cost">
                        $5 <span class="price-drop">$78</span>
                        </div>
                        <!-- .course-cost -->
                    </footer>
                    <!-- .entry-footer -->
                </div>
                <!-- .course-content-wrap -->
            </div>
            <!-- course content -->';
        }
    }
?>