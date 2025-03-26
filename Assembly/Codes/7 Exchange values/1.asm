.model small
.stack 100h

.code
main proc
    ; input first char
         mov  ah,1
         int  21h
         mov  bl,al
    ; input second char
         mov  ah,1
         int  21h
         mov  bh,al
    
    ; exchange values
         xchg bl,bh

    ; new line
         mov  ah,2
         mov  dl,10
         int  21h
         mov  dl,13
         int  21h
    
    ; print first char
         mov  ah,2
         mov  dl,bl
         int  21h
    
    ; print second char
         mov  ah,2
         mov  dl,bh
         int  21h
      
    ;exit
    exit:
main endp
end main 