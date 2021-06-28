:START
REM To start your server you need to use START and assign a window title as follows. Add your java start up parameters appropiately
REM Example: START "MYMCSERVER" /WAIT /ABOVENORMAL java -server -Xms512m -Xmx4096M -XX:PermSize=256m -d64 -XX:+UseParNewGC -XX:+CMSIncrementalPacing -XX:+CMSClassUnloadingEnabled -XX:ParallelGCThreads=2 -XX:MinHeapFreeRatio=5 -XX:MaxHeapFreeRatio=10 -jar FTBServer-1.7.10-1291.jar nogui
START "MYMCSERVER" /WAIT java -Xmx1024M -Xms1024M -jar spigot-1.16.5.jar nogui
REM Timeout just pauses the batch for 20 seconds when the server is shut down before restarting the batch. 
REM The timeout is not really needed but I personally use it for forced PC reboots, so the PC reboots before 
REM starting up the server again. As to not corrupt the MC world.
TIMEOUT 20
GOTO START

