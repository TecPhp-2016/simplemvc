<?php
phpinfo();
$path = '/usr/local/pear';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

 /*** include the controller class ***/
 include __SITE_PATH . '/application/' . 'controller_base.class.php';

 include __SITE_PATH . '/application/' . 'AbstractModel.class.php';

 /*** include the registry class ***/
 include __SITE_PATH . '/application/' . 'registry.class.php';

 /*** include the router class ***/
 include __SITE_PATH . '/application/' . 'router.class.php';

 /*** include the template class ***/
 include __SITE_PATH . '/application/' . 'template.class.php';

require_once(__SITE_PATH . '/application/' .'Events.php');

 /*** auto load model classes ***/
function __autoload($class_name) {
    $filename = strtolower($class_name) . '.class.php';
    $file = __SITE_PATH . '/model/' . $filename;

    if (file_exists($file) == false)
    {
        return false;
    }
  include ($file);
}

 /*** a new registry object ***/
 $registry = new registry;

 /*** create the database registry object ***/

$registry->db = new MysqliDb ('localhost', 'root', 'root', 'test');




// Pear Mail Library
// require_once "Mail.php";

// $from = 'sandinosaso@gmail.com';
// $to = 'sandinosaso@gmail.com';
// $subject = 'Hi!';
// $body = "Hi,\n\nHow are you?";

// $headers = array(
//     'From' => $from,
//     'To' => $to,
//     'Subject' => $subject
// );

// $smtp = Mail::factory('smtp', array(
//         'host' => 'ssl://smtp.gmail.com',
//         'port' => '465',
//         'auth' => true,
//         'username' => 'sandinoprueba@gmail.com',
//         'password' => 'pruebasandino22'
//     ));



  // Register an event for every time a user is created
  \simple_event_dispatcher\Events::register('user', 'create', function($namespace, $event, &$parameters) { 
    //Enviar un mail de registro exitoso

    // $body .= $parameters['username'];

    // $mail = $smtp->send($to, $headers, $body);

    // if (PEAR::isError($mail)) {
    //     echo('<p>' . $mail->getMessage() . '</p>');
    // } else {
    //     echo('<p>Message successfully sent!</p>');
    // }

  });



?>
