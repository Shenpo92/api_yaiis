<?php

require 'vendor/autoload.php';
include 'bootstrap.php';
use Todos\Models\Message;
use Todos\Models\Courses;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Todos\Middleware\Logging as TodoLogging;
use Todos\Middleware\Authentication as TodoAuth;
use Todos\Models\User;

$app = new Silex\Application();
// $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
//     'db.options' => array(
//         'driver'   => 'pdo_sqlite',
//         'path'     => __DIR__.'/app.db',
//         'dbname'   => 'inscription-compta',
//         'host'     => '10.80.5.1',
//         'user'     => 'yaiis',
//         'password' => 'Yaiis42sh@'
//     ),
// ));
$app['debug'] = true;

$app->before(function($request, $app) {
        TodoLogging::log($request, $app);
        TodoAuth::authenticate($request, $app);
});

$app->get('/courses', function(Request $request) use ($app) {
  $courses = new Courses;
  $courses = $courses->getCourses();
  $payload = [];
  $i = 0;

  foreach ($courses as $course){
    $payload[$i++] =
        [
          'id' => $course->id,
          'name' => $course->name,
          'detail' => $course->details,
          'info' => $course->info,
          'created' => $course->created,
          'modified' => $course->modified
        ];
  }
  return json_encode($payload, JSON_UNESCAPED_SLASHES);
 });

 // $app->get('/message/{message_id}', function($message_id) use ($app) {
 //
 //   $message = Message::where('id', $message_id)->get();
 //
 //   $payload = [];
 //
 //   foreach ($message as $msg){
 //           $payload[$msg->id] =
 //           [
 //                   'body' => $msg->body,
 //                   'user_id' => $msg->user_id,
 //                   'created_at' => $msg->created_at
 //           ];
 //    }
 //     return json_encode($payload, JSON_UNESCAPED_SLASHES);
 // });
 //
 // $app->post('/message', function(Request $request) use ($app) {
 //     $_message = $request->get('msg');
 //     $message = new Message();
 //     $message->body = $_message;
 //     $message->user_id = $request->attributes->get('userid');
 //     $message->save();
 //
 //     if ($message->id) {
 //         $payload = ['message_id' => $message->id, 'message_uri' => '/messages/' . $message->id, 'message' => $message->body];
 //         $code = 201;
 //     } else {
 //         $code = 400;
 //         $payload = [];
 //     }
 //
 //     return $app->json($payload, $code);
 // });
 //
 // $app->post('/message/{id}', function(Request $request, $id) use ($app) {
 //     $_message = $request->get('msg');
 //     $message = Message::find($id);
 //     $message->body = $_message;
 //     $message->save();
 //
 //     if ($message->id) {
 //         $payload = ['message_id' => $message->id, 'message_uri' => '/messages/' . $message->id, 'message' => $message->body];
 //         $code = 201;
 //     } else {
 //         $code = 400;
 //         $payload = [];
 //     }
 //
 //     return $app->json($payload, $code);
 // });
 //
 // $app->delete('/message/{id}', function(Request $request, $id) use ($app) {
 //     $_message = $request->get('msg');
 //     $message = Message::find($id);
 //     $message->delete();
 //
 //     if ($message->id) {
 //         $payload = ['message_id' => $message->id, 'message_uri' => '/messages/' . $message->id, 'message' => $message->body];
 //         $code = 201;
 //     } else {
 //         $code = 400;
 //         $payload = [];
 //     }
 //
 //     return $app->json($payload, $code);
 // });

$app->run();


?>
