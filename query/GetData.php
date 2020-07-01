<?php
// require_once('config/Database.php');
require_once('models.php');

class GetData extends Models{
  public $courseId, $shortname, $ullname, $summary,$amount;

  public function getCourses()
  {
    $models = new Models();
    $courses= $models->getAll('courses_information', 'id', 'ASC', ['amount', 'fullname', 'summary', 'shortname','course_id', 'course_image']);
    return $courses;
  }
  public function getCoursesForIndex()
  {
    $models = new Models();
    $courses= $models->getAll('test_courses_information', 'id', 'ASC', ['amount', 'fullname', 'summary', 'shortname','course_id', 'course_image']);
    return $courses;
  }
}
