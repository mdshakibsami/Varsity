.model small
.stack 100h

.data
    x    db 6
    y    db ?

.code
main proc
    ;initialize the data segment (DS)
         mov ax,@data
         mov ds,ax       ; Since mov ds, @data is not allowed directly, we first move @data to AX and then assign it to DS.
    
    ; take input y
         mov ah,1
         int 21h
         mov y,al
    
    ; print new-line
         mov ah,2
         mov dl,10
         int 21h
         mov dl,13
         int 21h
    
    ; print x
         mov ah,2
    ; just because x = 6; here 6 is in ascii, to convert it to real number have to add 48
         add x,48
         mov dl,x
         int 21h
               
    ; print new-line
         mov ah,2
         mov dl,10
         int 21h
         mov dl,13
         int 21h
    
    
        
    ; print y
         mov ah,2
         mov dl,y
         int 21h
    
    ; exit
    exit:
         mov ah,4ch
         int 21h
main endp
end main
