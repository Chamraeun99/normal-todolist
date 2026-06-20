$ini = Join-Path $PSScriptRoot "php-local.ini"
$router = Join-Path $PSScriptRoot "vendor\laravel\framework\src\Illuminate\Foundation\resources\server.php"
$public = Join-Path $PSScriptRoot "public"
$listenHost = "127.0.0.1"
$listenPort = "8000"

Write-Host "Starting Todo List at http://${listenHost}:${listenPort}"
Set-Location $public
php -c "$ini" -S "${listenHost}:${listenPort}" $router
