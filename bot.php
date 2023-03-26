<?php

$bot_responses = [
    "Hello!",
    "How are you?",
    "What's your name?",
    "Nice to meet you!"
];

// Define a function to get the bot's response
function get_bot_response($user_input) {
    global $bot_responses;
    
    // Split the user input into an array of words
    $words = explode(" ", $user_input);
    
    // Check if the user input contains a greeting
    if (in_array("hi", $words) || in_array("hello", $words)) {
        return $bot_responses[0];
    }
    
    // Check if the user input contains a question about the bot
    if (in_array("you", $words)) {
        return $bot_responses[3];
    }
    
    // Check if the user input contains a question about the user
    if (in_array("name", $words)) {
        return "I'm sorry, I don't know your name. What is it?";
    }
    
    // Check if the bot has already asked for the user's name
    if (isset($_SESSION['name'])) {
        // If the bot knows the user's name, greet the user by name
        return "Nice to meet you, ".$_SESSION['name']."!";
    } else {
        // If the bot doesn't know the user's name, ask for it
        $_SESSION['name'] = $user_input;
        return "Hi, ".$_SESSION['name']."! How can I assist you?";
    }
    
    // If the bot doesn't know how to respond, return a generic response
    return $bot_responses[1];
}

// Start the session
session_start();

// Get the user input
$user_input = $_POST['user_input'];

// Get the bot's response
$bot_response = get_bot_response($user_input);

// Output the bot's response
echo $bot_response;

?>
