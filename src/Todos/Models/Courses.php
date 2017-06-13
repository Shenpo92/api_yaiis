<?php
namespace Todos\Models;

Class Courses extends \Illuminate\Database\Eloquent\Model
{
  public function getCourses() {
    $courses = Courses::findOrFail(1)->get();
    return ($courses);
  }
}

?>
