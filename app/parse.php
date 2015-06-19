<?php
	error_reporting(E_ALL);

	require_once '../vendor/autoload.php';

	$path = glob('/data/mail/new/*');
	echo "Parsing: $path\n";

	$Parser = new PhpMimeMailParser\Parser();
foreach($path as $mail) {
	$Parser->setPath($mail); 

	$to = $Parser->getHeader('to');
	$from = $Parser->getHeader('from');
	$subject = $Parser->getHeader('subject');

	$text = $Parser->getMessageBody('text');
	$html = $Parser->getMessageBody('html');
	$htmlEmbedded = $Parser->getMessageBody('htmlEmbedded'); //HTML Body included data

	$attach_dir = __DIR__;
	$Parser->saveAttachments($attach_dir);

	echo "
From: $from
TO: $to
SUBJECT: $subject
------------------------------------------------------------------------------
$text";

	$attachments = $Parser->getAttachments();
	if (count($attachments) > 0) {
		foreach ($attachments as $attachment) {
			    echo 'Filename : '.$attachment->getFilename()."\n"; // logo.jpg
			    echo 'Filesize : '.filesize($attach_dir.$attachment->getFilename())."\n"; // 1000
			    echo 'Filetype : '.$attachment->getContentType()."\n"; // image/jpeg
		}
	}

};
