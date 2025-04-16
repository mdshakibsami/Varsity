.model small
.stack 100h 

; this program will produce correct result only for a+b<=9
.code
main proc
    ; input first number
         mov ah,1
         int 21h
         mov bl,al
    
    ; input second number
         mov ah,1
         int 21h
         mov bh,al

         add bh,bl

    ;newline
         mov ah,2
         mov dl,10
         int 21h
         mov dl,13
         int 21h

    ;print the result
         mov ah,2
         mov dl,bh
    ;sub dl,48
         int 21h

    ;exit
    exit:
main endp
end main 