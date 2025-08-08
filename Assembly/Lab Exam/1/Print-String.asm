.model small           ; Memory model: Code and Data are separate, but Data is small (< 64 KB)
.stack 100h            ; Reserve 256 bytes for the program stack

.data                              ; Start of the Data Segment
    msg  db "Hello Assembly !$"    ; String to print, terminated with '$' (required by DOS function 09h)

.code                     ; Start of the Code Segment
main proc                 ; Define the main procedure (program entry point)

         mov ax, @data    ; Load the address of the Data Segment into AX
         mov ds, ax       ; Copy AX into DS to set DS to our program's data segment

         mov ah, 9        ; DOS interrupt 21h, function 09h ? Display a string
         lea dx, msg      ; Load the address of 'msg' into DX
         int 21h          ; Call DOS service to print the string until '$'

         mov ah, 4Ch      ; DOS interrupt 21h, function 4Ch ? Terminate program
         int 21h          ; Return control to DOS

main endp                 ; End of the main procedure
end main               ; End of the program, set 'main' as the entry point
