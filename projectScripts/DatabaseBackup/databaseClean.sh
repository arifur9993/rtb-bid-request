# !bin/bash

#============================================================
#   Delete Database Backup
#============================================================

find /home/databaseBackup/prod -type f -mtime +15 -exec rm -f {} ';'
