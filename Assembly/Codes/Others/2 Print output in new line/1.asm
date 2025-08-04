.model small
.stack 100h
.code

main proc
    ;take a char input
    mov ah,1  
    int 21h
    mov bl,al
    
    ;show new line
    mov ah,2
    mov dl,10
    int 21h
    ;also you have to return cret
    ; mov ah,2
    ; mov dl,13
    ; int 21h

    ;show char output
    mov ah,2
    mov dl,bl
    int 21h
    
    ;exit
    exit:
    mov ah, 4ch
    int 21h
    main endp
end main
    

; with out the cret return output will show like 
; 5
;    5 
; cret return will remove the extra space and show output in new line properly