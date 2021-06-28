SetKeyDelay, 1
Loop
{
    FileReadLine, commandline, command.txt, 1
    if (commandline != "")
    {	
        FileRead, text_list, command.txt
        text_list := RegExReplace(text_list, ".+?\v`n", "", "", 1)
        FileDelete, command.txt
        FileAppend, 
(
%text_list%
), command.txt
        if (commandline == "stop")
        {
            ControlSend,, say Initiating restart in 30 seconds.{Enter}, MYMCSERVER
            sleep 25000
            ControlSend,, say Initiating restart in 5 seconds.{Enter}, MYMCSERVER
            ControlSend,, save-all{Enter}, MYMCSERVER
            sleep 5000
            ControlSend,, stop{Enter}, MYMCSERVER
            sleep 70000
        }
        if (commandline != "stop")
        {
            ControlSendRaw,, %commandline%, MYMCSERVER
            ControlSend,, {Enter}, MYMCSERVER
        }
        commandline := ""
    }
        sleep 100
}