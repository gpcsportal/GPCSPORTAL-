<?php
use Illuminate\Support\Facades\Artisan;
Artisan::command('gpcs:health',function(){ $this->info('GPCS Portal console is operational.'); })->purpose('Verify Artisan command loading.');
