<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoload dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Database connection
require_once __DIR__ . '/../db.php';

// Load models
require_once __DIR__ . '/../app/models/Student.php';

// Load controllers
require_once __DIR__ . '/../app/controllers/StudentController.php';

// Set up Blade
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

// Define paths
$viewsPath = __DIR__ . '/../app/views';
$cachePath = __DIR__ . '/../cache/views';

// Create necessary directories if they don't exist
if (! file_exists($cachePath)) {
    mkdir($cachePath, 0755, true);
}

// Set up Blade
$filesystem      = new Filesystem;
$eventDispatcher = new \Illuminate\Events\Dispatcher;

// Create the Blade compiler
$bladeCompiler = new BladeCompiler($filesystem, $cachePath);

// Create the engine resolver
$resolver = new EngineResolver;
$resolver->register('blade', function () use ($bladeCompiler) {
    return new CompilerEngine($bladeCompiler);
});

// Create the view finder
$finder = new FileViewFinder($filesystem, [$viewsPath]);
$finder->addExtension('blade.php');

// Create the view factory
$factory = new Factory($resolver, $finder, $eventDispatcher);
$factory->addExtension('blade.php', 'blade');

// Dependency injection
$student    = new Student($conn);
$controller = new StudentController($student, $factory);

// Simple routing system
$page   = $_GET['page'] ?? 'students';
$action = $_GET['action'] ?? 'index';
$id     = $_GET['id'] ?? null;

// Route to appropriate controller method
switch ($page) {
    case 'students':
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'create':
                $controller->create();
                break;
            case 'store':
                $controller->store();
                break;
            case 'edit':
                if ($id) {
                    $controller->edit($id);
                } else {
                    echo "Student ID required";
                }
                break;
            case 'update':
                if ($id) {
                    $controller->update($id);
                } else {
                    echo "Student ID required";
                }
                break;
            case 'delete':
                if ($id) {
                    $controller->delete($id);
                } else {
                    echo "Student ID required";
                }
                break;
            default:
                $controller->index();
                break;
        }
        break;
    default:
        $controller->index();
        break;
}
