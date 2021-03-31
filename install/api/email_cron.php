<?php
use App\Config;
use Dibi\Connection;

require_once __DIR__ . '/vendor/autoload.php';

$config = new Config(__DIR__ . '/config.json');
$db = new Connection((array) $config->db);

$db->update('emails_for_send', ['is_sent' => 0])->where('send_at < now() AND is_sent = -1')->execute();
$emails = $db->select('*')->from('emails_for_send')->where('is_sent = 0')->fetchAll();
foreach ($emails as $email) {
    $settings = $config->email;
    if (mail($email->email, $email->subject, $email->message, '') && $settings->send) {
        $db->update('emails_for_send', ['is_sent' => 1])->where('id = %u', $email->id)->execute();
    } else {
        echo "E-mail číslo {$email->id} nebyl odeslán.\n";
    }
}