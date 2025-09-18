<?php
// include class files
require_once __DIR__ . '/layouts/layouts.php';     // layouts class
require_once __DIR__ . '/forms/form.php'; // form class

// Configuration
$conf = [
    "site_name" => "My Awesome API"
];

// Create objects (notice the correct class names)
$layouts = new layouts();  // ✅ matches "class layouts"
$form    = new form();     // ✅ matches "class form"

// Call the methods
$layouts->heading($conf);
$form->signup();           // ✅ object now exists so signup() works
$layouts->footer($conf);
?>