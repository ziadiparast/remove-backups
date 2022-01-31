<?php

/**
 * Configuration
 * 
 */

define('BACKUP_BATH','/home/xxxx/public_html/backup/');
define('PATTERN','backup-*.tar.gz');

define('BACKUPS_COUNT',2);


/**
 * Cronjob : /usr/local/bin/php /home/xxxx/public_html/bcron.php
 * 
 */

$Backups = [];

if(is_dir(BACKUP_BATH)){
    
    chdir(BACKUP_BATH);

    foreach(glob(PATTERN) as $fname){
        $Backups[$fname] = filectime(BACKUP_BATH.$fname);
        
    }

    asort($Backups);

    foreach($Backups as $fname => $modify_date){
        if( count($Backups) > BACKUPS_COUNT){
            unlink(BACKUP_BATH.$fname);
            array_pop($Backups);
        }else{
            break;
        }
    }
}
