.model small
.stack 100h

.code
main proc
    ; input first digit
    mov ah, 1
    int 21h         
    sub al, 30h      ; convert ASCII to integer
    mov bl, al       ; store in bl

    ; newline
    mov ah, 2
    mov dl, 10
    int 21h
    mov dl, 13
    int 21h

    ; input second digit
    mov ah, 1
    int 21h
    sub al, 30h      ; convert ASCII to integer
    mov bh, al       ; store in bh    
    
              
              
              
              

    ; perform addition
    add bl, bh       ; bl = bl + bh

    ; convert result to ASCII
    add bl, 30h        
    
    
    
    
    
    

    ; newline
    mov ah, 2
    mov dl, 10
    int 21h
    mov dl, 13
    int 21h

    ; print result
    mov ah, 2
    mov dl, bl
    int 21h

    ; exit
    mov ah, 4ch
    int 21h
main endp
end main
