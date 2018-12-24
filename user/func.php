<?php
function one_course($id){													//HÀM IN RA 1 KHÓA HỌC (dùng trong file index_login) 
					require('login/db.php');
	
					$query_info='SELECT * FROM "Course" WHERE course_id='.$id;
					$result_info= pg_query($con,$query_info) or die(pg_errormessage($con));
					$info = pg_fetch_assoc($result_info);					// info của course 
						
					$query_teacher = '	SELECT * 
										FROM "Teacher" 
										WHERE teacher_id IN( 
														SELECT teacher_id 
														FROM "AssignTeacher" 
														WHERE course_id='.$id.')';
					$result_teacher = pg_query($con,$query_teacher) or die(pg_errormessage($con));
					$teacher = pg_fetch_assoc($result_teacher);					// info teacher 
					
					$query= '	SELECT AVG(rate), COUNT(*)
								FROM "Vote"
								WHERE course_id='.$id ;						
					$result = pg_query($con,$query) or die(pg_errormessage($con)); // Lấy rating của course
					$rating = pg_fetch_assoc($result);					
					if (pg_num_rows($result) > 0) {
						$rate = $rating["avg"];
						$star=(int)$rate;
						
					} else {
							$star=0;
						}	
					
						
		echo	'<div class="col-12 col-md-6 col-lg-4 px-25">
                            <div class="course-content">
                                <figure class="course-thumbnail">
                                    <a href="single-courses.php?id='. $id .'"><img src="'.$info["avatar"]. '" alt=""></a>
                                </figure><!-- .course-thumbnail -->

                                <div class="course-content-wrap">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="single-courses.php?id='. $id .'">'.$info["name"].'</a></h2>
                                        <div class="entry-meta flex align-items-center">
                                            <div class="course-author"><a href="#">'.$teacher["name"].'</a></div>

                                            <div class="course-date">July 21, 2018</div>
                                        </div><!-- .course-date -->
                                    </header><!-- .entry-header -->

                                    <footer class="entry-footer flex justify-content-between align-items-center">
                                        <div class="course-cost">';
                                          if( $info["discount"]==100){
											  echo '<span class="free-cost">Free</span>';
										  }else{
											  echo $info["price"]*(100-$info["discount"])*0.01. '$';
										  }   
							 echo '<span class="price-drop">'.$info["price"].'$</span>
                                        </div><!-- .course-cost -->
                                        <div class="course-ratings flex justify-content-end align-items-center">';
											for($i=0;$i<$star;$i++){	
												echo '<i class="fa fa-star checked"></i>';
												}
											for($i=0;$i<(5-$star);$i++){ 
												echo '<span class="fa fa-star-o"></span>';
												}

             echo                          ' <span class="course-ratings-count">('.$rating["count"].' votes)</span>
                                        </div><!-- .course-ratings -->
                                    </footer><!-- .entry-footer -->
                                </div><!-- .course-content-wrap -->
                            </div><!-- .course-content -->
                        </div><!-- .col -->';
	return $info;
	}
	
function print_course($id){													//HÀM IN RA 1 KHÓA HỌC (dùng trong file course) 
					require('login/db.php');
	
					$query_info='SELECT * FROM "Course" WHERE course_id='.$id;
					$result_info= pg_query($con,$query_info) or die(pg_errormessage($con));
					$info = pg_fetch_assoc($result_info);					// info của course 
						
					$query_teacher = '	SELECT * 
										FROM "Teacher" 
										WHERE teacher_id IN( 
														SELECT teacher_id 
														FROM "AssignTeacher" 
														WHERE course_id='.$id.')';
					$result_teacher = pg_query($con,$query_teacher) or die(pg_errormessage($con));
					$teacher = pg_fetch_assoc($result_teacher);					// info teacher 
					
					$query= '	SELECT AVG(rate), COUNT(*)
								FROM "Vote"
								WHERE course_id='.$id ;						
					$result = pg_query($con,$query) or die(pg_errormessage($con)); // Lấy rating của course
					$rating = pg_fetch_assoc($result);					
					if (pg_num_rows($result) > 0) {
						$rate = $rating["avg"];
						$star=(int)$rate;
						
					} else {
							$star=0;
						}	
					
						
		echo	'<div class="col-12 col-md-6 px-25">
                            <div class="course-content">
                                <figure class="course-thumbnail">
                                    <a href="single-courses.php?id='. $id .'"><img src="'.$info["avatar"]. '" alt=""></a>
                                </figure><!-- .course-thumbnail -->

                                <div class="course-content-wrap">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="single-courses.php?id='. $id .'">'.$info["name"].'</a></h2>
                                        <div class="entry-meta flex flex-wrap align-items-center">
                                            <div class="course-author"><a href="#">'.$teacher["name"].'</a></div>

                                            <div class="course-date">July 21, 2018</div>
                                        </div><!-- .course-date -->
                                    </header><!-- .entry-header -->

                                    <footer class="entry-footer flex justify-content-between align-items-center">
                                        <div class="course-cost">';
                                          if( $info["discount"]==100){
											  echo '<span class="free-cost">Free</span>';
										  }else{
											  echo $info["price"]*(100-$info["discount"])*0.01. '$';
										  }   
							 echo '<span class="price-drop">'.$info["price"].'$</span>
                                        </div><!-- .course-cost -->
                                        <div class="course-ratings flex justify-content-end align-items-center">';
											for($i=0;$i<$star;$i++){	
												echo '<i class="fa fa-star checked"></i>';
												}
											for($i=0;$i<(5-$star);$i++){ 
												echo '<span class="fa fa-star-o"></span>';
												}

             echo                          ' <span class="course-ratings-count">('.$rating["count"].' votes)</span>
                                        </div><!-- .course-ratings -->
                                    </footer><!-- .entry-footer -->
                                </div><!-- .course-content-wrap -->
                            </div><!-- .course-content -->
                        </div><!-- .col -->';
	return $info;
	}
?>