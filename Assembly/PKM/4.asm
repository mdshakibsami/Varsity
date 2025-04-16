.model small
.stack 100h

.code
main proc
    
    mov ah,2
    mov cx,256
    mov dl,0
    
print_loop:
    int 21h
    inc dl
    dec cx   
    
           
            
    JNZ print_loop

    ; Exit
    mov ah, 4ch
    int 21h
main endp
end main


; This program will work on emu8086