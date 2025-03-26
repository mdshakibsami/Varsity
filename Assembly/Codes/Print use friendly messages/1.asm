.model small
.stack 100h

.data
    a    db "Enter a number: $"
    b    db "Your number is: $"
    x    db ?

.code
main proc
    ; data segment initialization
         mov ax,@data
         mov ds,ax
    
    ; print msg
         mov ah,9
         lea dx,a
         int 21h
    
    ; take input a number
         mov ah,1
         int 21h
         mov x,al
    
    ; new line
         mov ah,2
         mov dl,10
         int 21h
         mov dl,13
         int 21h
    
    ; print msg
         mov ah,9
         lea dx,b
         int 21h
    
    ; print the number
         mov ah,2
         mov dl,x
         int 21h
      
    ;exit
    exit:
main endp
end main
    