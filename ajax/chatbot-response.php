<?php
if(isset($_POST['message'])) {
    $message = strtolower($_POST['message']);

    if(strpos($message, 'hello') !== false) {
        echo 'Hello! How can I help you today?';
    }
    elseif(strpos($message, 'services') !== false) {
        echo 'We provide AI Chatbot, Web Development, and ML Solutions.';
    }
    else {
        echo 'Thank you for contacting AI-Solutions.';
    }
}
?>