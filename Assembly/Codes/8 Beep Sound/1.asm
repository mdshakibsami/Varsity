.model small
.stack 100h

.code
main proc
         mov ah,2
         mov dl,07
         int 21h
             
         mov ah,2
         mov dl,07
         int 21h
             
         mov ah,2
         mov dl,07
         int 21h

    ;exit
exit:
main endp
end main 