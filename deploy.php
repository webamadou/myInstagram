<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'https://github.com/webamadou/myInstagram.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('files170.hostinger.com')
    ->set('deploy_path', '/domains/amfrontdev.tech/public_html');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});
task('pwd', function () {
    $result = run('pwd');
    writeln("Current dir: $result");
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

