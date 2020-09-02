<?php

use Modules\Feedback;

// routes for modules
$feedback = new Feedback\FeedbackController();

$di->get('router')->mount($feedback->getRoutes());
